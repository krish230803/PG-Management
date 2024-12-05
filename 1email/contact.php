<?php
    include 'db.php';
if (isset($_POST["send"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $disc = $_POST['disc'];
   
   
    $sql = "INSERT INTO `contactinfo`(`id`, `name`, `email` , `discription`) VALUES (NULL,'$name','$email','$disc')";
 
    $result = mysqli_query($con, $sql);
 
    if ($result) {
        $subject = "Thank You";
                            $body = "Hi, $name. Thank You For Contact Us.\n For More Details Please Visit Our Website. http://localhost/1email/welcome.php \n\n Thanks, \n The PG Management System";
                            $headers = "From: PG Management System pgmanagementsystem33@gmail.com";

                            if (mail($email, $subject, $body, $headers)) {
                             header("Location: welcome.php?");
                            }
                            else {
                                echo "Email sending failed...";
                            }
      
    } else {
       echo "Failed: " . mysqli_error($con);
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <script>
    function validation() {
    var email = document.getElementById("email-field");
    var pattern = /^[a-z\._\-0-9]*[@][a-z]*[\.][a-z]{2,4}$/;
    var form = document.getElementById("form");
    var emailError = document.getElementById("email-error");

    if (email.value.match(pattern)) {
        form.classList.add("valid");
        form.classList.remove("invalid");
        emailError.innerHTML = "valid email";
        email.style.border = "2px solid green"; // Change border color to green
        emailError.style.color = "green";
    } else {
        form.classList.remove("valid");
        form.classList.add("invalid");
        emailError.innerHTML = "Please Enter a valid email";
        email.style.border = "2px solid red"; // Change border color to red
        emailError.style.color = "red";
    }  
}
function contact() {
    var name = document.getElementById("name");
    var email = document.getElementById("email-field");
    var pattern = /^[a-z\._\-0-9]*[@][a-z]*[\.][a-z]{2,4}$/;
    if (email.value.match(pattern)  && name.value !== '') {
        alert('sent Successfully');
        return true;
    } else {
        // Prevent form submission and show alert
        alert('Please Fill valid Details!');
        return false;
    }
}

   </script>
    <style>
        button {
            padding: 10px 20px;
            background-color: #70351f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #865b4b;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <br>
<h2 style="text-align:center; color: #70351f;">PG Management System</h2>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h4 style="text-align:left; color: #70351f;">Contact Us</h4>
                <form id="form" action="" method="POST"  onsubmit="return contact()" >
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                    <label class="col-form-label">Email</label>
                
                    <input type="text" class="form-control" id="email-field" name="email" onkeyup="validation()" required>
                    <span id="email-error"></span>
             
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="disc" rows="5"></textarea>
                    </div>
                    <button type="submit" name="send" >Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
