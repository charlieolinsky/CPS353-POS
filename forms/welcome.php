<!-- This is a test file designed to determine if redirections are successful -->
<?php

session_start();

include "../classes/roles.php";
access('freeMember');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
</head>
<body>
    <?php 
        if(isset($_SESSION['user_name']))
        {
            echo "Hi, " . $_SESSION['user_name'];
        }
    ?>
    <h1>Redirect Success!</h1>
</body>
</html >