<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
        <div class="form">
            <h2 class="register">Log in</h2>
            <?php
        if(isset($_SESSION['error'])){
            echo "<div style='color: red; text-align:center;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }

    ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" id="btn">Log in</button>
            </form>
            <p>If you are not registered? <a href="signup.php">Sign up</a></p>
        </div>
    </div>


    
</body>
</html>