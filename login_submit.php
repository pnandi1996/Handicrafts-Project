<?php

require("includes/common.php");

$myemail = mysqli_real_escape_string($con, $_POST['e-mail']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$mypassword = MD5($password);
// Query checks if the email and password are present in the database.
$query = "SELECT id, email FROM users WHERE email='" . $myemail . "' AND password='" . $mypassword . "'";
$result = mysqli_query($con, $query)or die($mysqli_error($con));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$num = mysqli_num_rows($result);
// If the email and password are not present in the database, the mysqli_num_rows returns 0, it is assigned to $num.
if ($num == 1) {
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['id'];
    header('location: products.php');
} else {
   // header('location: login.php?error='."Invalid Login Credentials.");
   // $error = "Wrong Credentials";
    //header('location: login.php');
    $_SESSION['errMsg'] = "Invalid Credentials!";
    header("location: login.php?error=".$_SESSION['errMsg']);
    
}


