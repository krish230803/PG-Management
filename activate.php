<?php
session_start();
include 'db.php';
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $updatequery = " update form set status='active' where token='$token' ";

    $query = mysqli_query($con,$updatequery);
    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account Updated Successfully";
            $_SESSION['msg2'] = "";
            header('location: login.php');
        }else{
            $_SESSION['msg'] = "You Are Logged Out.";
            $_SESSION['msg2'] = "";
            header('location: login.php');
        }
    }else{
        $_SESSION['msg'] = "Account not Updated";
        $_SESSION['msg2'] = "";
        header('location: registration.php');
    }
}
?>