<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h2 class="register">Registration</h2>
            <?php 
                if(isset($_SESSION['message'])){
                    echo '<p style= "color:red; text-align:center;">' . $_SESSION["message"] . '</p>' ;
                    unset($_SESSION['message']);
                }
            ?>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" id="btn">Sign up</button>
            </form>
            <p>If you are registered?<a href="loginhtml.php">Login</a></p>
        </div>
    </div>
</body>
</html>
