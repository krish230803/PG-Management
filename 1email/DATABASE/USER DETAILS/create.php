<?php
    include 'db.php';
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password_confirm = $_POST['cpass'];
    $status = $_POST['status'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $hashedPassword1 = password_hash($password_confirm, PASSWORD_BCRYPT);
 
    $email_query = "SELECT * FROM form WHERE email='$email'";
    $query = mysqli_query($con, $email_query) or die(mysqli_error($con));

    $email_count = mysqli_num_rows($query);

    if($email_count > 0) {
        echo "Email already exists";
    } else {
        // Check if password and confirmation match
        if ($password !== $password_confirm) {
            echo "Passwords do not match";
        } else {
    $sql = "INSERT INTO `form`(`id`, `name`, `email` , `pass` , `cpass` , `status`) VALUES (NULL,'$name','$email','$hashedPassword' , ' $hashedPassword1' , '$status')";
 
    $result = mysqli_query($con, $sql);
 
    if ($result) {
       header("Location: data.php?msg=New record created successfully");
    } else {
       echo "Failed: " . mysqli_error($con);
    }
 }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="script.js"></script>

    <title>Create New User</title>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <form id="form" method="post" onsubmit="return fun()">
            <div class="row mb-3">
                <label class="col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email-field" name="email" onkeyup="validation()" required>
                    <span id="email-error"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="pass" onkeyup="passwordvalidation()" required>
                    <span id="password-error"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password1" name="cpass" onkeyup="password1validation()" required>
                    <span id="password1-error"></span>
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-form-label" >Status</label>
                <div class="col-sm-6">
                    <select class="form-control" name="status" >
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row mb-3">
               <div class="offset-sm-0 col-sm-3 4-grid">
                <button type="submit" class="btn btn-primary" name="submit">submit</button>
               </div>
                <div class="offset-sm-1 col-sm-2 d-grid">
                   <a class="btn btn-outline-primary" href="data.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>