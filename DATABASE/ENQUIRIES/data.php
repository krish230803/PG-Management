
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>List Of Enquiries</h2>
       
        <br>
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>PG Name</th>
                <th>Facility</th>
                <th>Gender</th>
                <th>Sharing</th>
                <th>Food</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include 'db.php';
        $sql = "SELECT * FROM enquiry";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['pg_name'] ?></td>
                <td><?php echo $row['facility'] ?></td>
                <td><?php echo $row['gender'] ?></td>
                <td><?php echo $row['sharing'] ?></td>
                <td><?php echo $row['food'] ?></td>
                <td>
                
                    <a class="link-dark" href="del.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash fs-5"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        
        </tbody>
        </table>
    </div>
</body>
</html>