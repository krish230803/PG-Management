<?php
session_start();
session_unset();
setcookie('emailcookie', $email, time() -86400);
setcookie('passwordcookie', $password, time() -86400);
header('location:welcome.php');
?>