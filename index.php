<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
$conn = new mysqli("localhost", "root", "", "php_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['save_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($query)) {
        
        echo "<script>window.location.href='index.php';</script>";
    }
}
?>
<div class="container">
    
    
    <h2 class="text-center mb-5">User Management System</h2>

    <div class="row">
        
        
        <div class="col-md-4">
            <h4>Add New User</h4>
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Enter Full Name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="Enter Email Address">
                </div>
                <button type="submit" name="save_user" style= "background-color: #007bff; color: white; border: none; padding: 10px 20 px; border-radius: width: 100%;" >Submit</button>
            
            </form>
        </div>

        
        <div class="col-md-8">
            <h4>Registered Users</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM users ORDER BY id DESC";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="background-color: #158606; color: white; border: none; padding: 10px 20 px; border-radius: width: 100%;" >Edit</a>
                                
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" style= "background-color: #f12517; color: white; border: none; padding: 10px 20 px; border-radius: width: 100%;">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                       
                        echo "<tr><td colspan='4' class='text-center text-muted'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>