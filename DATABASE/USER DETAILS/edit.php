<?php
include "db.php";

$id = intval($_GET['id']);
$email_query = "SELECT email FROM form WHERE id = $id";
$result = mysqli_query($con, $email_query);
$row = mysqli_fetch_assoc($result);
$semail = $row['email'];

if (isset($_POST["submit"])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $status = $_POST['status'];
if($email == $semail){
  $sql = "UPDATE `form` SET `name`='$name', `email`='$email', `status`='$status' WHERE id = $id";
  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: data.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}else{
  $email_query = "SELECT * FROM form WHERE email='$email'";
  $query = mysqli_query($con, $email_query) or die(mysqli_error($con));

  $email_count = mysqli_num_rows($query);

  if($email_count > 0) {
      echo "Email already exists";
  } else {
    $sql = "UPDATE `form` SET `name`='$name', `email`='$email' ,`status`='$status' WHERE id = '$id'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: data.php?msg=Data updated successfully");
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="script.js"></script>


  <title>Edit User Details</title>
</head>

<body>
<div class="container my-5">
        <h2>Update Client</h2>
        <form id="form" method="post" onsubmit="return update()">
            <div class="row mb-3">
                <label class="col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email-field" name="email" value="<?php echo $semail; ?>" onkeyup="validation()" >
                    <span id="email-error"></span>
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
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
               </div>
                <div class="offset-sm-1 col-sm-2 d-grid">
                   <a class="btn btn-outline-primary" href="data.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>