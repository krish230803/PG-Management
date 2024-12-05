<?php
session_start();
include 'db.php';

// Function to check if the token is valid and not expired
function isTokenValid($token) {
    global $con;
    $current_time = time();
    $query = mysqli_query($con, "SELECT * FROM form WHERE rtoken ='$token' AND expire > '$current_time'");
    return mysqli_num_rows($query) > 0;
}

// Check if token is provided in the URL
if(isset($_GET['token'])){
    $token = $_GET['token'];
    // If token is provided, check if it's valid and not expired
    if($token && isTokenValid($token)){
        // If token is valid, redirect to the password reset page
        header('Location: reset.php?token=' . $token);
        exit();
    } else {
        // If token is invalid or expired, redirect to the forgot password page
        header('Location: forgot.php?error=invalid_token');
        exit();
    }
} else {
    // If token is not provided in the URL, redirect to the forgot password page
    header('Location: forgot.php');
    exit();
}
?>
