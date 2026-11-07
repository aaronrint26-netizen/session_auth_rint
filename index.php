<?php
session_start();

include 'db.php';

$error = "";

if(isset($_POST['btnlogin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password_hash'])){
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header('Location: dashboard.php');
            exit();
        }else{
            $error = "Invalid username or password";
        }
    }else{
        $error = "Invalid username or password";
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
                <h3 class="text-center">Welcome!</h3>
                <h4 class="text-center">Login Form</h4>
            </div>
            <div class="card-body">
                <?php if($error){?>
                    <p style="color: red;"><?php echo $error?></p>
                <?php } ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="d-flex justify-content-center">
                     <button type="submit" name="btnlogin" class="btn btn-success">Login</button>
                    </div>
            </form>
            </div>
            <div class="card-footer border-0 bg-white">
                <div>
                    <p class="text-center">Dont have an account yet? <a href="register.php">Register here!</a></p>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>