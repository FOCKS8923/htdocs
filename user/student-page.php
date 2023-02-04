<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: no-login.htm");
  exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
    <p>
        This is user page
    </p>
    <a href="logout.php">LOGOUT</a>
</body>
</html>