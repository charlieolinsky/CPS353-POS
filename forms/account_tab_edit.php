<!DOCTYPE html>

<?php

session_start();
include_once("../classes/User.php");
include_once("../classes/roles.php");
include_once("../sql/connect.php");

// calling method from user class to reset firstname
if (isset($_POST['fn'])) {
    $fName = ucfirst($_POST["newName"]);
    $id = $_SESSION['user_id'];

    //$user = new User($_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['pword']); 
    //$user -> setFirstName($name, $id);
    //User::setFirstName($name, $id);
    $_SESSION["fname"] = $fName;
    User::setFirstName($fName, $id);
}

// calling method from user class to reset lastname
if (isset($_POST['ln'])) {
  $lName = ucfirst($_POST["newLname"]);
  $id = $_SESSION['user_id'];
  $_SESSION["lname"] = $lName;
  //$user = new User($_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['pword']); 
  //$user -> setFirstName($name, $id);
  //User::setFirstName($name, $id);
    User::setLastName($lName, $id);
}
// calling method from user class to reset address
if (isset($_POST['add'])) {
  $address = $_POST["newAddress"];
  $id = $_SESSION['user_id'];

  //$user = new User($_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['pword']); 
  //$user -> setFirstName($name, $id);
  //User::setFirstName($name, $id);
    User::setFirstName($address, $id);
}
// calling method from user class to reset password
if (isset($_POST['pass'])) {
  if (strlen($_POST["newPassword"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["newPassword"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["newPassword"])) {
    die("Password must contain at least one number");
}
  if ($_POST["newPassword"] !== $_POST["vPass"]) {
    die("Passwords must match");
}
  $pass = $_POST["newPassword"];
  $id = $_SESSION['user_id'];

  //$user = new User($_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['pword']); 
  //$user -> setFirstName($name, $id);
  //User::setFirstName($name, $id);
    User::setPassword($pass, $id);
}

if (isset($_POST['remove_user']))
{
  $id = $_SESSION['user_id'];
  User::removeUser($id);
}

?>

<html>
  <head>
    <title>My Account Tab</title>
  </head>
<body>
<main> 
<h1>My Account</h1>
<div class = "account-info">
    <dl>
        <dt>First Name: 
        <?php
          echo $_SESSION['fname'];
        ?>
           <!-- The form -->
      <div class="form-popup" id="myForm">
      <form action="../forms/account_tab_edit.php" method="POST">   
            <label for="newName"><b>Edit First Name</b></label>
            <input type="name" placeholder="Enter new first name" name="newName" required>
            <input type="submit" name = "fn" value = "Submit">
            <!-- <button type="submit" class="btn">Submit</button> -->
          </form>
      </div>
        </dt>

        <dt>
        <br>    
        Last Name: 
        <?php
          echo $_SESSION['lname'];
        ?>
           <!-- The form -->
      <div class="form-popup" id="myForm">
      <form action="../forms/account_tab_edit.php" method="POST">  
            <label for="newLname"><b>Edit Last Name</b></label>
            <input type="name" placeholder="Enter new last name" name="newLname" required>
            <input type="submit" name = "ln" value = "Submit">
          </form>
      </div>
        <br>    
           <!-- The form -->
      <div class="form-popup" id="myForm">
      <form action="../forms/account_tab_edit.php" method="POST">  
            <label for="newAddress"><b>Change Password</b></label>
            <input type="password" placeholder="Enter new password" name="newPassword" required>
            <input type="password" placeholder="Confirm password" name="vPass" required>

            <input type="submit" name = "pass" value = "Submit">
          </form>
      </div>
      <br>
      <!-- <button class="btn delete account">Delete Account</button> -->
      <form action="../forms/account_tab_edit.php" method="POST">  
      <input type="submit" name = "remove_user" value = "Delete Account">
      </dl>
      <a href="../ui/services.php#membership">Upgrade Membership</a>
</div>
</main>
</body>
</html>