<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="website icon" type="svg" href="log-in-outline.svg">
    <script src="script.js"></script>
    <title>Reset Password</title>
</head>
<body>

<?php
include('db.php');
echo "RESET PASSWORD FOR: " . $_SESSION['mail']; // Debugging statement

if(isset($_SESSION['mail']) && isset($_POST['pass']) && isset($_POST['cpass'])) {
    $email = $_SESSION['mail'];
    $password = mysqli_real_escape_string($con, $_POST['pass']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['cpass']);
    // Hash the passwords
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashedConfirmPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);

    $updatequery = "UPDATE form SET pass='$hashedPassword', cpass='$hashedConfirmPassword' WHERE email='$email'";
    $query = mysqli_query($con, $updatequery);

    if($query){
        
        header('location: login.php');
       
    } else {
       
        header('location: forgot.php');
        
    }
} else {

    // header('location: forgot.php');
}
?>


    <section>
    <div class="login-box">
        <form id="form"  method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <h2>Reset Password</h2>



<!-- ! create new password -->
            <div class="input-box">
                <span class="eye" onclick="pass()"><img src="eye-off.svg" class="pass-icon" id="pass-icon"></span>
                <span class="icon"><img src="lock-closed.svg"></span>
                <input type="password" id="password" name="pass" onkeyup="passwordvalidation()" required>
                <label for="password">Create New  Password</label>
                <span id="password-error"></span>
            </div>
<!-- !Confirm Password -->

<div class="input-box">
    <span class="eye" onclick="pass1()"><img src="eye-off.svg" class="pass-icon" id="pass-icon1"></span>
    <span class="icon"><img src="lock-closed.svg"></span>
    <input type="password" id="password1" name="cpass" onkeyup="password1validation()" required>
    <label for="password">Confirm Password</label>
    <span id="password1-error"></span>
</div>

<!--!Sign Up button  -->
            <button type="submit" onclick="fun()">Reset Password</button>
        </form>
    </div>
</section>
   
</body>
</html>