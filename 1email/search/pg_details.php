<?php

include('database_connection.php');

session_start();
error_reporting(0);

include('db.php');
$user=$_SESSION['uname'];
$email = $_SESSION['mail'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>PG Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 100%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #70351f;
            margin-bottom: 20px;
        }
        .pg-details {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .pg-details img {
            width: 100%;
            height: 80vh;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .pg-details p {
            margin: 5px 0;
        }
        .pg-details button {
            padding: 10px 20px;
            background-color: #70351f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .pg-details button:hover {
            background-color: #865b4b;
        }
    </style>
</head>
<body>
    
    <div class="container">

    <?php
        
        if (isset($_SESSION['enquiry_success']) && $_SESSION['enquiry_success']) {
            echo '<script>alert("Enquiry Sent successfully");</script>';
            unset($_SESSION['enquiry_success']);
        }
        ?>

        <?php
            include('fetch_data.php');

            if(isset($_GET['id'])) {
                $pg_id = $_GET['id'];
                $query = "SELECT * FROM pginfo WHERE id = :id";
                $statement = $connect->prepare($query);
                $statement->execute(array(':id' => $pg_id));
                $pg_details = $statement->fetch();

                $pgName = $pg_details['pg_name'];
                $imageSrc = 'DATA/' . $pg_details['image'];
                $price = $pg_details['price'];
                $facility = $pg_details['facility'];
                $gender = $pg_details['gender'];
                $share = $pg_details['share'];
                $food = $pg_details['food'];
                $disc = $pg_details['disc'];

                if($user == true){
                    if (isset($_POST['submit'])) {

                        if($user == false){
                            header('location: ../login.php');
                        }
                        $user=$_SESSION['uname'];
                        $email = $_SESSION['mail'];
                        $pg_name = $pg_details['pg_name'];
                        $facility = $_POST['facility'];
                        $gender = $_POST['gender'];
                        $sharing = $_POST['share'];
                        $food = $_POST['food'];
                
                        $sql = "INSERT INTO `enquiry`(`id`, `name`, `email` , `pg_name` , `facility` , `gender`, `sharing`, `food`) VALUES (NULL,'$user','$email','$pg_name' , ' $facility' , '$gender', '$sharing', '$food')";
                        $result = mysqli_query($con, $sql);
                        
                        if ($result) {
                            

                            $subject = "Recieved Request";
                            $body = "Hi, $user. Thank You For sent Enquiry On PG Management System Website for Booking of $pg_name. \n\n Thanks, \n The PG Management System";
                            $headers = "From: PG Management System pgmanagementsystem33@gmail.com";

                            if (mail($email, $subject, $body, $headers)) {
                                $_SESSION['enquiry_success'] = true;
                            header("Location: pg_details.php?id=$pg_id&msg=enquiry sent successfully");
                            }
                            else {
                                echo "Email sending failed...";
                            }
                        } else {
                            echo "Failed: " . mysqli_error($con);
                         }
                      }
                
                    }
        ?>
        <div class="pg-details">  
            <img src="<?php echo $imageSrc; ?>" alt="<?php echo $pgName; ?>">
            <h2><?php echo $pgName; ?></h2>
            <p><strong>Price:</strong> ₹<?php echo $price; ?></p>
            <p><strong>Facility:</strong> <?php echo $facility; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Sharing:</strong> Upto <?php echo $share; ?> Person</p>
            <p><strong>Food:</strong> <?php echo $food; ?></p>
            <br><br>
            <h5 style="color: #70351f;">Discription</h5>

            <p><?php echo $disc; ?></p>
            <div class="mini-form">
                <br>
            <h4 style="text-align:left; color: #70351f;">For Booking Enquiry</h4>
            <form action="<?php echo isset($_GET['id']) ? 'pg_details.php?id=' . $_GET['id'] : 'pg_details.php'; ?>" method="POST">
            <div class="row mb-3">
            <label class="col-form-label">Facility</label>
            <div class="col-sm-6">
                <select class="form-control" name="facility">
                    <?php 
                    if($facility == 'AC'){
               echo "<option value='AC' >AC</option>"; }
               else{}
               if($facility == 'NonAC'){
                    echo "<option value='NonAC'>Non AC</option>";}
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label">Gender</label>
            <div class="col-sm-6">
                <select class="form-control" name="gender">
                <?php 
                    if($gender == 'Male'){
               echo "<option value='Male' >Male</option>"; }
               else{}
               if($gender == 'Female'){
                    echo "<option value='Female'>Female</option>";}
                    ?>
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
                        <option value="Yes">With Food</option>
                        <option value="No">Without Food</option>
                    </select>
                </div>
            </div>
                <button name="submit">Send Enquiry</button>
            </form>
        </div>
            
        </div>
        <?php
            } else {
                echo '<p>No PG details found.</p>';
            }
        ?>
    </div>
</body>
</html>
