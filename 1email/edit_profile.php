<?php
session_start();
error_reporting(0);

include('db.php');
$user=$_SESSION['uname'];
$email = $_SESSION['mail'];
$img0 = $_SESSION['img0'];
if($user == true){
    


if (isset($_POST['submit'])) {
    $dob = $_POST['dob'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    if (!empty($_FILES["photo"]["name"])) {
$folder = "/pics";
$filename = $_FILES["photo"]["name"]; 
$tempname =$_FILES["photo"]["tmp_name"];
$folder1 = "pics/".$filename;

move_uploaded_file( $tempname, $folder1 );
$img1 = "UPDATE `form` SET `img` = '$folder1' WHERE `email` = '$email'" ;
    
    $re = mysqli_query($con,$img1);
    if($re){
        $_SESSION['img0'] = $folder1;
    }
    }
$sql = "UPDATE `form` SET `name`='$name', `dob` = '$dob' , `gender` = '$gender'  WHERE `email` = '$email'";
$result = mysqli_query($con, $sql);
if ($result) {
    
    $_SESSION['uname'] = $name;
   

   
    echo "profile updated Successfully";
 
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}

$isql = "SELECT  img FROM `form` WHERE `email`='$email'";
$iresult = mysqli_query($con, $isql);
$image = mysqli_fetch_assoc($iresult);
$img = $image['img'];

}
else{
    header('location: welcome.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Profile</title>
</head>
<body>
<section>
    <div class="login-box1">
   
        <?php
        echo "<div>";
        echo "<img src='$img' height='200px' width='200px' style= 'border-radius: 50%'>";
        echo "</div>";
        echo "<br>";
        echo "<div>";
        echo "<span><h4>Name:</h4></span> <span>$user</span>";
        echo "<br>";
        $dob_sql = "SELECT dob FROM `form` WHERE `email`='$email'";
        $dob_result = mysqli_query($con, $dob_sql);
        $dob_row = mysqli_fetch_assoc($dob_result);
        $dob = $dob_row['dob'];
        echo "<span><h4>Date of Birth:</h4></span> <span>$dob</span>";
        echo "<br>";
        $gender_sql = "SELECT gender FROM `form` WHERE `email`='$email'";
        $gender_result = mysqli_query($con, $gender_sql);
        $gender_row = mysqli_fetch_assoc($gender_result);
        $gender = $gender_row['gender'];
        echo "<span><h4>Gender:</h4></span> <span>$gender</span>";
        echo "</div>";
        ?>
<style>
    .login-box1 {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .login-box1 > div {
        margin-bottom: 10px; 
        text-align: center;
    }

    .login-box1 img {
        height: 200px;
        width: 200px;
    }

    .login-box1 h4 {
        margin: 5px 0;
    }

    .login-box1 span {
        display: inline-block; 
    }
</style>

  
    </div>
    <div class="login-box" >
        <form id="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST"  enctype="multipart/form-data">
        <h2>Edit Profile</h2>
        <div class="input-box">
                <div id="inputBox">
                <span class="icon"><img src="mail.svg"></span>
                </div>
                <input type="email" spellcheck="false" id="email-field" name="email" value="<?php echo $email ?>" required readonly>
                <label for="email-label">Email</label>
                </div>
                <div class="input-box">
                    <input type="text" name="name" value="<?php echo $user; ?>">
                    <label for="Dob">Name</label>
                </div>
                <div class="input-box">
                    <input type="date" name="dob" >
                    <label for="Dob">Date Of Birth</label>
                </div>
                <div class="input-box" style="margin-bottom: 40px;">
                <label for="gender">Gender</label>
                </div>          
                <div class="input-box" style="margin-top: 20px;" >
                <select name="gender" id="gender" >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="input-box">
                    <input type="file" name="photo" style="border:0;  padding-top:20px;">
                    <label for="pp" >Profile Picture</label>
                </div>
                <button type="submit" name="submit" style="width:100px; margin-right: 50px;">Update</button>
                <button type="cancel" name="cancel" style="width:100px; margin-left:50px;"><a href="welcome.php" style="text-decoration: none; color: inherit;">Cancel</a></button>

        </form>
    </div>
</section>
   
</body>
</html>