<?php

// THIS INCLUDES ERROR HANDLING- password requirements, verify match, checks if a field was left empty 

class User {
//properties
private $id;
private $firstName; 
private $lastName;
private $address; // mailing/billing address ?
private $email;
private $phoneNumber;
private $password; //username will be email
private $lockerNumber; // default null -------------> table for locker # and combo pairs?
private $lockerCombo; // deafult null
private $membershipLevel; // default 1 (free member)

//methods
public function _User($n, $ln, $em, $pass)
{
    $this->firstName = $n;
    $this->lastName = $ln;
    $this->email = $em;
    $this->password = $pass;
}

public function createUser(){
    
    /********************Check Fields ***************/
    if (empty($_POST["fname"])) {
        die("Name is required");
    }
    if (empty($_POST["lname"])) {
        die("Name is required");
    }
    if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Valid email is required");
    }
    
    if (strlen($_POST["pword"]) < 8) {
        die("Password must be at least 8 characters");
    }
    
    if ( ! preg_match("/[a-z]/i", $_POST["pword"])) {
        die("Password must contain at least one letter");
    }
    
    if ( ! preg_match("/[0-9]/", $_POST["pword"])) {
        die("Password must contain at least one number");
    }
    
    if ($_POST["pword"] !== $_POST["vpword"]) {
        die("Passwords must match");
    }


    /******Include Security Class*********************/
    
    include_once("../classes/SecurityService.php");
    $password_hash = SecurityService::hp($_POST['pword']);

    
    /***********Begin Query ************************/
    include_once("../sql/connect.php");  
    $stmt = $dbconn -> prepare("INSERT INTO user_table (email, passcode, fname, lname)
            VALUES (?,?,?,?)");
    
    if (!$stmt){   
        die("SQL error: " . $dbconn->error);
    }
    $fname = ucfirst($_POST["fname"]);
    $lname = ucfirst($_POST["lname"]);

    $stmt->bind_param("ssss",
                      $_POST["email"],
                      $password_hash,
                      $fname,
                      $lname); // upper case first letter 
     
                      try {
                        $stmt->execute();
                        header("Location: ../UI/loginUI.php");
                        exit;
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1062) {
                            die("The email you entered is already in use");
                            //header("Location: register.php"); 
                        }
                    }                  
}

public static function removeUser($id)
{
    include("../sql/connect.php");

    //Disable foreign key checks to allow for user deletion 
    $DB_EDIT_1 = $dbconn->query("SET FOREIGN_KEY_CHECKS=0");
    if(!$DB_EDIT_1){echo "DB_EDIT_1 Failed: Foreign Key Error";}

    //Query
    $sql = "DELETE FROM user_table WHERE USER_ID = $id;"."DELETE FROM user_address WHERE USER_ID = $id";
    if ($dbconn->multi_query($sql) === TRUE) {
        //echo "Record updated successfully";
        header("Location: ../UI/loginUI.php"); //ui/index.php
    } else {
        echo "Error updating record: " . $dbconn->error;
    }
    
    //Re-enable foriegn key checks 
    $DB_EDIT_2 = $dbconn->query("SET FOREIGN_KEY_CHECKS=1");
    if(!$DB_EDIT_2){echo "DB_EDIT_2 Failed: Foreign Key Error";}

    die();
}
public static function setFirstName($fn, $id)
{  
    include("../sql/connect.php");

    $sql = "UPDATE user_table SET fname = '$fn' WHERE USER_ID = '$id'";
        if ($dbconn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: ../forms/account_tab.php"); //ui/index.php
            exit;
        } else {
            echo "Error updating record: " . $dbconn->error;
        }              
}
public static function setLastName($ln, $id)
{ 
    include("../sql/connect.php");

    $sql = "UPDATE user_table SET lname = '$ln' WHERE USER_ID = '$id'";
        if ($dbconn->query($sql) === TRUE) {
            echo "Record updated successfully";
           // header("Location: ../forms/login.php"); //ui/index.php
            exit;
        } else {
            echo "Error updating record: " . $dbconn->error;
        }
}
public static function setPassword($pass, $id)
{      

    include("../sql/connect.php");

    $password_hash = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE user_table SET passcode = '$password_hash' WHERE USER_ID = '$id'";
        if ($dbconn->query($sql) === TRUE) {
            echo "Record updated successfully";
            //header("Location: ../forms/login.php"); //ui/index.php
            exit;
        } else {
            echo "Error updating record: " . $dbconn->error;
        } 
}
public static function setMembershipLevel($role, $id)
{    
    include("../sql/connect.php");

    $sql = "UPDATE user_table SET roles = '$role' WHERE USER_ID = '$id'";
        if ($dbconn->query($sql) === TRUE) {
            echo "Record updated successfully";
            //header("Location: ../forms/login.php"); //ui/index.php
            exit;
        } else {
            echo "Error updating record: " . $dbconn->error;
        }
}
// 
public static function setAddress()
{   
    //NOT DONE 
    include("../sql/connect.php");

    $sql = "UPDATE user_table SET fname = '$fn' WHERE USER_ID = '$id'";
        if ($dbconn->query($sql) === TRUE) {
            //echo "Record updated successfully";
            header("Location: ../forms/login.php"); //ui/index.php
            exit;
        } else {
            echo "Error updating record: " . $dbconn->error;
        } 
}
}
?>