<?php

include("connect.php");
session_start();
// Set POST variables
$email=$_POST['email'];
$password=$_POST['password'];

$query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password' ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (count($row)>0){
    header('location:users.php');
    $_SESSION['user_id'] = 1;
}else{
    header("location: index.php?error=1");
}
