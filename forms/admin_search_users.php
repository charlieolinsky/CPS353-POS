<!DOCTYPE html>

<?php

// admin should be able to search a user by ID and edit their info or delete account

session_start();
include_once("../include/global_inc.php");

?>
<html>
  <head>
    <title>Find or Edit a User</title>
  </head>
<body>
<main> 
<h1>Account Info</h1>
<div class = "account-info">
    <dl>
    <form action="../forms/admin_edit_users.php" method="POST">   
            <h3>Find a user</h3>

            <label for="userID"><b>User ID</b></label>
            <input type="name" placeholder="Enter a user ID" name="userID" required>
            <input type="submit" name = "getID" value = "Submit">
            <!-- <button type="submit" class="btn">Submit</button> -->
          </form>
          <br>
</div>
</main>
</body>
</html>
