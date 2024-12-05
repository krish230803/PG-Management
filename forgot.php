
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
    <title>Forgot Password</title>
</head>
<body>

<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $email_search = "SELECT * FROM form WHERE email ='$email' and status= 'active' ";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if ($email_count) {
        $token = bin2hex(random_bytes(15));

        function generateExpirationTime() {
            return time() + (5 * 60); 
        }
        $email_token = mysqli_fetch_assoc($query);
        $name = $email_token['name'];
       
        $expirationTime = generateExpirationTime();

        $insert_query = "UPDATE form SET rtoken='$token', expire='$expirationTime' WHERE name='$name' ";
        $iquery = mysqli_query($con, $insert_query) or die(mysqli_error($con));
        if($iquery){
        $_SESSION['mail'] = $email;

        $subject = "Password Reset";
        $body = "Hi, $name. Click Here to Reset your Password http://localhost/1email/reseting.php?token=$token \n
        This Link Valid Only 5 Minutes. \n\n Thanks, \n The PG Management System";
        $headers = "From: PG Management System pgmanagementsystem33@gmail.com";

        if (mail($email, $subject, $body, $headers)) {
            $_SESSION['msg3'] = "check your mail for link";
           
        } else {
            echo "Email sending failed...";
        }
    }
    }else{
        echo "Email not Registered!";
    }
}
 ?>   
    <section>
    <div class="forgot-box">
        <form id="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return fun()" >
            <h2>Forgot Password</h2>

            <div class="register-link1">
            <p> <?php
                if(isset($_SESSION['msg3'])){
                     echo $_SESSION['msg3'];
                 }else{
                    echo $_SESSION['msg3'] = "";
                 } 
                 ?></p>
<!-- !Email -->
           
            <div class="input-box">
                <div id="inputBox">
                <span class="icon"><img src="mail.svg"></span>
                </div>
                <input type="email" id="email-field" name="email" spellcheck="false"  required>
                <label for="email-label">Enter Your Email</label>
            </div>

<!--!Forgot Password button  -->
            <button type="submit" name="submit">Forgot Password</button>

        </form>
    </div>
</section>
   
</body>
</html>