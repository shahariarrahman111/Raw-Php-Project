<?php
    session_start();
    include 'database.php';

    // Get Current User
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn , $query);
    $user = mysqli_fetch_assoc($result);

    // Name, password, and image update
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
            echo "Password must be alphanumeric (letters and numbers only).";
            exit();
        }

        // Hash the password
        $password = password_hash($password, PASSWORD_BCRYPT);


        // Update user's information in the database
        $update_query = "UPDATE users SET name = '$name', password = '$password', email = '$email' WHERE id = '$user_id'";

        if(mysqli_query($conn , $update_query)){
            header("Location: home.php");
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
?>
