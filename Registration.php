<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Sign Up</title>
</head>
<body>

<?php
include 'db.php';

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['fname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['cpass']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $hashedPassword1 = password_hash($confirmPassword, PASSWORD_BCRYPT);

    $token = bin2hex(random_bytes(15));

    $email_query = "SELECT * FROM form WHERE email='$email'";
    $query = mysqli_query($con, $email_query) or die(mysqli_error($con));

    $email_count = mysqli_num_rows($query);

    if($email_count > 0) {
        echo "Email already exists";
    } else {
        // Check if password and confirmation match
        if ($password !== $confirmPassword) {
            echo "Passwords do not match";
        } else {
            // Insert user into the database
            $insert_query = "INSERT INTO form (name, email, pass, cpass, token, status ) VALUES ('$name', '$email', '$hashedPassword', '$hashedPassword1', '$token','inactive' )";
            $iquery = mysqli_query($con, $insert_query) or die(mysqli_error($con));
            
            if($iquery) {
                                
               
                $subject = "Email Activation";
                $body = "Hi, $name. Thank You For Creating Account On PG Management System Website. Click Here to Activate your Account http://localhost/1email/activate.php?token=$token \n\n Thanks, \n The PG Management System";
                $headers = "From: PG Management System pgmanagementsystem33@gmail.com";

                if (mail($email, $subject, $body, $headers)) {
                    $_SESSION['msg'] = "check your mail to activate your account";
                    $_SESSION['msg2'] = " $email";
                    header("Location: login.php");
                } else {
                    echo "Email sending failed...";
                }
            
            } else {
                echo "Error adding data: " . mysqli_error($con);
            }
        }
    }
}
?>



    <section>
    <div class="reg-box">
        <form id="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" onsubmit="return fun()">
            <h2>Sign up</h2>

<!-- !Full Name  -->

            <div class="input-box">
                <span class="icon"><img src="text.svg"></span>
                <input type="text" id="name" name="fname" required>
                <label for="name">Full Name</label>
            </div>
<!-- !Email -->
           
            <div class="input-box">
                <div id="inputBox">
                <span class="icon"><img src="mail.svg"></span>
                </div>
                <input type="email" spellcheck="false" id="email-field" name="email" onkeyup="validation()" required>
                <label for="email-label" id="email-label">Email</label>
                <span id="email-error"></span>
            </div>
           
<!-- !password -->
            <div class="input-box">
                <span class="eye" onclick="pass()"><img src="eye-off.svg" class="pass-icon" id="pass-icon"></span>
                <span class="icon"><img src="lock-closed.svg"></span>
                <input type="password" id="password" name="pass" onkeyup="passwordvalidation()" required>
                <label for="password">Password</label>
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
            <button type="submit" name="submit">Sign up</button>
<!-- !Login-link -->
            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
           
        </form>
    </div>
</section>
   
</body>
</html>