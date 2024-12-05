<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include "db.php";
    $sql = "DELETE FROM `enquiry` WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result) {
   
        header("Location: data.php?msg=Data deleted successfully");
        exit;
    } else {
        die("Failed to delete data: " . mysqli_error($con));
    }
}
?>
