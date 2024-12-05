<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="website icon" type="svg" href="log-in-outline.svg">
    <script src="script.js"></script>
    <title>Login</title>
</head>
<body>

<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = "SELECT * FROM form WHERE email ='$email' and status='active' ";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if ($email_count) {
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass['pass']; // Fetching hashed password from database
        $pass_decode = password_verify($password, $db_pass);

        if ($pass_decode) {
            if(isset($_POST['rememberme'])){
                $email_name= $email_pass['name'];
                $email_email= $email_pass['email'];
                $email_img= $email_pass['img'];
                $_SESSION['uname']=$email_name;
                $_SESSION['mail'] = $email_email;
                $_SESSION['img0'] = $email_img;
                echo 'login successful';
                setcookie('emailcookie', $email, time() +86400);
                setcookie('passwordcookie', $password, time() +86400);
                header('location:welcome.php');
            }else{
                $email_name= $email_pass['name'];
                $_SESSION['uname']=$email_name;
                $email_email= $email_pass['email'];
                $_SESSION['mail'] = $email_email;
                $email_img= $email_pass['img'];
                $_SESSION['img0'] = $email_img;
                echo 'login successful';
                header('location:welcome.php');
            }
           
            // Perform further actions here, such as setting session variables
        } else {
            echo 'password Incorrect';
        }
    } else {
        echo "invalid email";
    }
}


?>
    <section>
    <div class="login-box">
        <form id="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <h2>Login</h2>
           
            <div class="register-link1">
            <p> <?php
                if(isset($_SESSION['msg'])){
                     echo $_SESSION['msg'];
                 }else{
                    echo $_SESSION['msg'] = "You Are Logged Out.";
                 } 
                 ?></p>
            <p> <?php
              if(isset($_SESSION['msg2'])){
                 echo $_SESSION['msg2'];
               }else{
                echo $_SESSION['msg2'] = "Please Login Again.";
                } ?></p>
            </div>
<!-- !Email -->
            <div class="input-box">
                <div id="inputBox">
                <span class="icon"><img src="mail.svg"></span>
                </div>
                <input type="email" spellcheck="false" id="email-field" name="email" value="<?php if(isset($_COOKIE['emailcookie'])) { echo $_COOKIE['emailcookie'];} ?>" required>
                <label for="email-label">Email</label>
                <span id="email-error"></span>
            </div>
<!-- !password -->
            <div class="input-box">
                <span class="eye" onclick="pass()"><img src="eye-off.svg" class="pass-icon" id="pass-icon"></span>
                <span class="icon"><img src="lock-closed.svg"></span>
                <input type="password" id="password" name="password" value="<?php if(isset($_COOKIE['passwordcookie'])) { echo $_COOKIE['passwordcookie'];} ?>" required >
                <label for="password">Password</label>
                <span id="password-error"></span>
            </div>

<!-- !remember-forgetpass. -->
<div class="remember-forgot">
                <label><input type="checkbox" name="rememberme">
                Remember me</label>
            </div>
            <!-- <div> <br></div> -->
            <div class="remember-forgot">
            
                <a href="login_code.php" >Login with code</a>
                <a href="forgot.php">Forgot Password?</a>
            </div>
          
<!--!Login button  -->
            <button type="submit" name="submit">Login</button>

<!-- !Register-link -->
            <div class="register-link">
           
                <p>Don't have an account? <a href="Registration.php">Sign up</a></p>
            </div>
           
        </form>
    </div>
</section>
   
</body>
</html>