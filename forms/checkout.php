<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Checkout</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <!-- <script src="https://kit.fontawesome.com/6c54e79b44.js" crossorigin="anonymous"></script> -->

        <link rel="stylesheet" href="../css/checkout.css">
    </head>


    

    <div class="col-75">
        <div class="container">
            <!-- <form action="placeorder.php"> -->

                
                <div class="col-50">
                    <h1>Checkout</h1>
                    <h3>Shipping Address</h3>
                    <label for="fname"> First Name </label>
                    <input type="text" id="fname" name="firstname" placeholder="First Name"><br><br>
                    <label for="lname"> Last Name </label>
                    <input type="text" id="lname" name="lastname" placeholder="Last Name"><br><br>
                    <label for="email"> Email </label>
                    <input type="text" id="email" name="email" placeholder="you@example.com"><br><br>
                    <label for="adr"> Address </label>
                    <input type="text" id="adr" name="address" placeholder="Address"><br><br>
                    <label for="city"> City </label>
                    <input type="text" id="city" name="city" placeholder="New Paltz"><br><br>
                    <label for="state"> State </label>
                    <input type="text" id="state" name="state" placeholder="New York">
                    <label for="zip"> Zip </label> 
                    <input type="text" id="zip" name="zip" placeholder="12561"><br><br>
                </div>
                

                
                <!-- <h3>Payment</h3>
                <label for="card">Accepted Cards</label> -->
                <!-- <div class="icon-container">
                    <i class="fa-brands fa-cc-visa" style="color:navy;"></i>
                    <i class="fa fa-cc-amex" style="color:gold;"></i>
                    <i class="fa-brands fa-cc-discover" style="color:brown"></i>
                    <i class="fa-brands fa-cc-mastercard" style="color:darkolivegreen"></i>
                    <i class="fa-brands fa-paypal" style="color:blue"></i>
                </div> -->

                <h3> Payment Information </h3>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="John M Doe"><br><br>
                <label for="cnum">Card number </label>
                <input type="text" id="cnum" name="cardnunmber" placeholder="1111-2222-3333-4444"><br><br>
                
                <div class="row">
                    <div class="col-50">
                        <label for="expdate">Exp Date</label>
                        <input type="text" id="expdate" name="expdate" placeholder="MM/YY"><br><br>
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123"><br><br>
                    </div>
                </div>
                

                <!-- <label>
                    <h3>Billing Address</h3>
                    <label for="billing-checkbox"> Shipping address same as Billing address: </label>
                    <input type="checkbox" id="billing-checkbox" checked="checked" />  <br><br>

                    <label for="fname"> First Name </label>
                    <input type="text" id="fname" name="firstname" placeholder="First Name" disabled>
                    <label for="lname"> Last Name </label>
                    <input type="text" id="lname" name="lastname" placeholder="Last Name" disabled><br><br>
                    <label for="adr"> Address </label>
                    <input type="text" id="adr" name="address" placeholder="Address" disabled><br><br>
                    <label for="city"> City </label>
                    <input type="text" id="city" name="city" placeholder="New Paltz"disabled><br><br>
                    <label for="state">State </label>
                    <input type="text" id="state" name="state" placeholder="New York" disabled>
                    <label for="zip"> Zip </label> 
                    <input type="text" id="zip" name="zip" placeholder="12561" disabled><br><br>
                </label><br><br> -->

                <form action="placeorder.php">
                    <input type="submit" value="Place Order" class="btn">
                </form>
                
               
            <!-- </form> -->
        </div>
    </div>
    <div class="col-25">
        <div class="cart-container">
            <h4>Cart 
                <!-- <span class="price" style="color:black">
                    <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                    <b>4</b> -->
                </span>
            </h4>
            <P><a href="#">Product 1</a> <span class="price">$15</span></P>
            <P><a href="#">Product 2</a> <span class="price">$5</span></P>

            <hr>
            <p>Subtotal <span class="price" style="color:black"><b>$x</b></span></p>
        </div>
    </div>

        

    
</html>