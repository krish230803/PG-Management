
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>List Of PGs</h2>
        <a class="btn btn-primary" href="create.php" role="button">Add New PG</a>
        <br>
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>PG Name</th>
                <th>Facility</th>
                <th>Gender</th>
                
                <th>Sharing</th>
                <th>Food</th>
                <th>Price</th>
                <th>Image</th>
                <th>Discription</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include '../db.php';
        $sql = "SELECT * FROM pginfo ";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['pg_name'] ?></td>
                <td><?php echo $row['facility'] ?></td>
                <td><?php echo $row['gender'] ?></td>

                <td><?php echo $row['share'] ?></td>
                <td><?php echo $row['food'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td><img src="<?php echo $row['image']; ?>" height="100px" width="100px"></td>
                <td><?php echo $row['disc'] ?></td>
                <td>
                    <a class="link-dark" href="edit.php?id=<?php echo $row['id']; ?>p"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <a class="link-dark" href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash fs-5"></i></a>
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