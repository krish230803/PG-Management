<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'email';

$con = mysqli_connect($server, $user, $password, $db);

if($con){
    echo "";
}else{
  echo "Not Connected";
}
?>
