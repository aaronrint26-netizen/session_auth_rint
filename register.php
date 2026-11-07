<?php
include 'db.php';

$alert = "";
$notice = "";

if(isset($_POST['btnregister'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $alert = "Username already exists!";
    } else {
        //hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password_hash, created_at) VALUES ('$username', '$email', '$password', NOW())";

        if($conn->query($sql) === TRUE){
            $notice = "Registration Successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container py-3 d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header border-0 bg-white">
                <h3 class="text-center">Hello!</h3>
                <p class="text-center">Registration Form</p>
            </div>
            <div class="card-body">
                <?php if($alert){?>
                    <p style="color: red;"><?php echo $alert?></p>
                <?php } ?>
                <?php if($notice){?>
                    <p style="color: blue;"><?php echo $notice?> You can now login</p>
                <?php } ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" name="btnregister" class="btn btn-primary ">Register</button>
                </form>
            </div>
            <div class="card-footer border-0 bg-white">
                <div>
                    <p class="text-center">Already have an account? <a href="index.php">Login here!</a></p>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>