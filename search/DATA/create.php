<?php
    include '../db.php';
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $facility = $_POST['facility'];
    $gender = $_POST['gender'];
    $share = $_POST['share'];
    $food = $_POST['food'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $disc = $_POST['disc'];
   
    $folder = "pics/";
    $filename = $_FILES["image"]["name"]; 
    $tempname =$_FILES["image"]["tmp_name"];
    $folder1 = $folder . $filename;
    
   if (move_uploaded_file( $tempname, $folder1 )){
    $sql = "INSERT INTO `pginfo`(`id`, `pg_name`, `facility` , `gender` , `share` ,`food`, `price` , `status`, `image` , `disc`) VALUES (NULL,'$name','$facility','$gender' , ' $share' , '$food', '$price', '$status' , '$folder1' , '$disc')";
    $result = mysqli_query($con, $sql);
 
    if ($result) {
       header("Location: data.php?msg=New record created successfully");
    } else {
       echo "Failed: " . mysqli_error($con);
    }
 } else { 
    echo "Failed to upload image ";
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

    <title>Add New PG</title>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <form id="form" method="post" onsubmit="return fun()" enctype="multipart/form-data">

            <div class="row mb-3">
                <label class="col-form-label">PG Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Facility</label>
                <div class="col-sm-6">
                <select class="form-control" name="facility" >
                        <option value="AC">AC</option>
                        <option value="NonAC">NonAC</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label">Gender</label>
                <div class="col-sm-6">
                <select class="form-control" name="gender" >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label">Sharing</label>
                <div class="col-sm-6">
                <select class="form-control" name="share" >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-form-label">Food</label>
                <div class="col-sm-6">
                <select class="form-control" name="food" >
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="price" required>
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
            <input type="file" name="image" style="border:0;  padding-top:20px;">
            </div>     
            </div>
            <div class="row mb-3">
                <label class="col-form-label" >Discription</label>
                <div class="col-sm-6">
                <input type="textarea" class="form-control"  name="disc" required >
                </div>
            <br>
            <br>
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