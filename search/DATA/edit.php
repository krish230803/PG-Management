<?php
include "../db.php";

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $sql = "SELECT * FROM pginfo WHERE id = $id";
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $name = $row['pg_name'];
        $facility = $row['facility'];
        $gender = $row['gender'];
        $share = $row['share'];
        $food = $row['food'];
        $price = $row['price'];
        $disc = $row['disc'];
       
    } else {
        echo "<h3>No data found for the specified ID</h3>";
        exit; 
    }

if (isset($_POST["submit"])) {
  $name = $_POST['name'];
    $facility = $_POST['facility'];
    $gender = $_POST['gender'];
    $share = $_POST['share'];
    $food = $_POST['food'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $disc = $_POST['disc'];
    if (!empty($_FILES["image"]["name"])) {
    $folder = "pics/";
    $filename = $_FILES["image"]["name"]; 
    $tempname =$_FILES["image"]["tmp_name"];
    $folder1 = $folder . $filename;

    move_uploaded_file( $tempname, $folder1 );
    $img = "UPDATE `pginfo` SET `image` = '$folder1' WHERE id = $id" ;
    
    $re = mysqli_query($con,$img);
    }
    $sql = "UPDATE `pginfo` SET `pg_name`='$name', `facility`='$facility', `gender`='$gender', `share`='$share', `food`='$food', `price`='$price', `status`='$status',  `disc`='$disc' WHERE id = $id";
      $result = mysqli_query($con, $sql);
  if ($result) {
    header("Location: data.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}
} else {
  echo "<h3>Invalid request!</h3>";
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


  <title>Edit PG Details</title>
</head>

<body>
<div class="container my-5">
        <h2>Update Details</h2>
        <form id="form" method="post" onsubmit="return fun()" enctype="multipart/form-data">

            <div class="row mb-3">
                <label class="col-form-label">PG Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Facility</label>
                <div class="col-sm-6">
                <select class="form-control" name="facility" >
                        <option value="AC"<?php if ($facility == 'AC') echo 'selected'; ?> >AC</option>
                        <option value="NonAC"  <?php if ($facility == 'NonAC') echo 'selected'; ?>>NonAC</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Gender</label>
                <div class="col-sm-6">
                <select class="form-control" name="gender" >
                        <option value="Male"  <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female"  <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label">Sharing</label>
                <div class="col-sm-6">
                <select class="form-control" name="share" >
                        <option value="1"  <?php if ($share == '1') echo 'selected'; ?>>1</option>
                        <option value="2"  <?php if ($share == '2') echo 'selected'; ?>>2</option>
                        <option value="3"  <?php if ($share == '3') echo 'selected'; ?>>3</option>
                        <option value="4"  <?php if ($share == '4') echo 'selected'; ?>>4</option>
                        <option value="5"  <?php if ($share == '5') echo 'selected'; ?>>5</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-form-label">Food</label>
                <div class="col-sm-6">
                <select class="form-control" name="food" >
                        <option value="Yes"  <?php if ($food == 'Yes') echo 'selected'; ?>>Yes</option>
                        <option value="No"  <?php if ($food == 'No') echo 'selected'; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="price" value="<?php echo $price; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label" >Status</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" value="1" name="status" required readonly>
                </div>
            </div>
            <div class="row mb-3">
            <label for="img" >Image</label>
            <div class="col-sm-6">
        
        <input type="file" name="image" style="border:0;  padding-top:20px;" >
    </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label" >Discription</label>
                <div class="col-sm-6">
                <input type="textarea" class="form-control"  name="disc" value="<?php echo $disc; ?>" required >
                </div>
            <br>
            <br>
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