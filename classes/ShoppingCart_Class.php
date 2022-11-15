<?php
//start session 
if(!session_id()){ 
    session_start(); 
}


class ShoppingCart {
    protected $cart_contents = array();

    public function __ShoppingCart()
    {
        // get the shopping cart array from the session 
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL; 
        if ($this->cart_contents === NULL){ 
            $this->cart_contents = array('cart_total' => 0, 'totalItems' => 0); 
        }
    }

    // returns the entire cart array
    
    public function contents()
    {
        // rearrange the newest first 
        $cart = array_reverse($this->cart_contents); 
 
        // remove these so they don't create a problem when showing the cart table 
        unset($cart['total_items']); 
        unset($cart['cart_total']); 
 
        return $cart; 
    }

    public function getItem($row_id)
    {
        return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id])) 
            ? FALSE 
            : $this->cart_contents[$row_id]; 
    }
    
    //return total item count 
    public function totalItems()
    {
        return $this->cart_contents['totalItems']; 
    }

    // total price
    public function total()
    {
        return $this->cart_contents['cart_total'];
    }

    // Insert items into the cart and save it to the session 
    public function insert($item = array())
    {
        if(!is_array($item) OR count($item) === 0){ 
            return FALSE; 
        }else{ 
            if(!isset($item['PROD_ID'], $item['prod_name'], $item['prod_price'], $item['qty'])){ 
                return FALSE; 
            }else{ 
                /* 
                 * Insert Item 
                 */ 
                // prep the quantity 
                $item['qty'] = (float) $item['qty']; 
                if($item['qty'] == 0){ 
                    return FALSE; 
                } 
                // prep the price 
                $item['prod_price'] = (float) $item['prod_price']; 
                // create a unique identifier for the item being inserted into the cart 
                $rowid = $item['PROD_ID']; 
                // get quantity if it's already there and add it on 
                $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0; 
                // re-create the entry with unique identifier and updated quantity 
                $item['rowid'] = $rowid; 
                $item['qty'] += $old_qty; 
                $this->cart_contents[$rowid] = $item; 
                 
                // save Cart Item 
                if($this->save_cart()){ 
                    return isset($rowid) ? $rowid : TRUE; 
                }else{ 
                    return FALSE; 
                } 
            } 
        } 
    }

    //update the cart
    public function update($item = array())
    {
        if (!is_array($item) OR count($item) === 0){ 
            return FALSE; 
        }else{ 
            if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){ 
                return FALSE; 
            }else{ 
                // prep the quantity 
                if(isset($item['qty'])){ 
                    $item['qty'] = (float) $item['qty']; 
                    // remove the item from the cart, if quantity is zero 
                    if ($item['qty'] == 0){ 
                        unset($this->cart_contents[$item['rowid']]); 
                        return TRUE; 
                    } 
                } 
                 
                // find updatable keys 
                $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item)); 
                // prep the price 
                if(isset($item['price'])){ 
                    $item['price'] = (float) $item['price']; 
                } 
                // product id & name shouldn't be changed 
                foreach(array_diff($keys, array('id', 'name')) as $key){ 
                    $this->cart_contents[$item['rowid']][$key] = $item[$key]; 
                } 
                // save cart data 
                $this->save_cart(); 
                return TRUE; 
            } 
        } 
    }

    //save the cart array to the session
    protected function save_cart()
    {
        $this->cart_contents['totalItems'] = $this->cart_contents['cart_total'] = 0; 
        foreach ($this->cart_contents as $key => $val){ 
            // make sure the array contains the proper indexes 
            if(!is_array($val) OR !isset($val['prod_price'], $val['qty'])){ 
                continue; 
            } 
      
            $this->cart_contents['cart_total'] += ($val['prod_price'] * $val['qty']); 
            $this->cart_contents['totalItems'] += $val['qty']; 
            $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['prod_price'] * $this->cart_contents[$key]['prod_quantity']); 
        } 
         
        // if cart empty, delete it from the session 
        if(count($this->cart_contents) <= 2){ 
            unset($_SESSION['cart_contents']); 
            return FALSE; 
        }else{ 
            $_SESSION['cart_contents'] = $this->cart_contents; 
            return TRUE; 
        } 
    }

    //remove items from the cart
    public function remove($row_id)
    {
        unset($this->cart_contents[$row_id]); 
        $this->save_cart(); 
        return TRUE; 
    }

    //empty the cart and destroy the session
    public function destroy()
    {
        $this->cart_contents = array('cart_total' => 0, 'totalItems' => 0); 
        unset($_SESSION['cart_contents']); 
    }


}

?>