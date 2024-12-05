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
    <script src="script.js"></script>
    <title>Login_Code</title>
</head>
<body>
    <?php 
    include 'db.php';

    if(isset($_POST['send'])) {
        $email = $_POST['email'];
    
        $email_search = "SELECT * FROM form WHERE email ='$email' and status= 'active' ";
        $query = mysqli_query($con, $email_search);
        $email_count = mysqli_num_rows($query);
        setcookie('emailcookie', $email, time() +86400);
    
        if ($email_count) {
            $otp = mt_rand(100000, 999999);
    
            $email_otp = mysqli_fetch_assoc($query);
            $email1 = $email_otp['email'];
            $otpTime = time() + (5 * 60);
    
            $insert_otp_query = "UPDATE form SET otp='$otp', otptime='$otpTime' WHERE email='$email1' ";
            $iquery = mysqli_query($con, $insert_otp_query);
           
            if($iquery) {     
                $subject = "Your 6-Digit OTP";
                $body = "Hi, $email ,\n \n We've received your request for a OTP to use with your Account.\n \nYour OTP  is $otp.  OTP is Valid Only 5 Minutes.\n\n If you didn't request this code, you can safely ignore this email. Someone else might have typed your email address by mistake.\n\n Thanks, \n The PG Management System";
                $headers = "From: PG Management System pgmanagementsystem33@gmail.com";
                if (mail($email, $subject, $body, $headers)) {
                    echo "OTP successfully sent";
                } else {
                    echo "OTP sending failed...";
                }
            } else {
                echo "Error adding data: " . mysqli_error($con);
            }
        } else {
            echo "Invalid email or inactive account";
        }
    } else if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $otp_entered = $_POST['code'];
    
        $email_search = "SELECT * FROM form WHERE email ='$email' and status= 'active' ";
        $query = mysqli_query($con, $email_search);
        $email_count = mysqli_num_rows($query);
    
        if ($email_count) {
            $user_data = mysqli_fetch_assoc($query);
            $otp_stored = $user_data['otp'];
            $otp_time = $user_data['otptime'];
    
            if($otp_entered == $otp_stored && time() <= $otp_time) {
                $email_name= $user_data['name'];
                $_SESSION['uname']=$email_name;
               
                // Correct OTP, redirect user to welcome page or perform login action
                header('location:welcome.php');
                exit();
            } else {
                // Incorrect or expired OTP
                echo "OTP Incorrect or Expired. Please try again.";
            }
        } else {
            // Email not found or account inactive
            echo "Invalid email or inactive account";
        }
    }
    ?>
    <section>
        <div class="forgot-box">
            <form id="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <h2>Login</h2>

                <!-- Email -->
                <div class="input-box">
                    <div id="inputBox">
                        <span class="icon"><img src="mail.svg"></span>
                    </div>
                    <input type="email" spellcheck="false" id="email-field" name="email" value="<?php if(isset($_COOKIE['emailcookie'])) { echo $_COOKIE['emailcookie'];} ?>" required>
                    <label for="email-label">Email</label>
                    <span id="email-error"></span>
                </div>

                <!-- Enter Verification Code -->
                <div class="input-box">
                    <div id="inputBox">
                        <button id="send" name="send">Send</button>
                    </div>
                    <input type="number" id="password" name="code" spellcheck="false">
                    <label for="email-label">Enter Verification Code</label>
                </div>
                <div class="remember-forgot">
            
            <a href="login.php" >Login with Password</a>
        </div>

                <!-- Login button -->
                <button id="code" type="submit" name="submit">Login</button>
            </form>
        </div>
    </section>
</body>
</html>
