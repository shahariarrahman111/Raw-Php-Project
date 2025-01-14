<?php
    session_start();
    include 'database.php';

    // Get Current User
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn , $query);
    $user = mysqli_fetch_assoc($result);


    // Category post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];


        $add_sql = "INSERT INTO categories (user_id, name, description) VALUES ('$user_id', '$name', '$description')";

        // Query 
        if (mysqli_query($conn, $add_sql)) {
            $_SESSION['message'] = "Category added successfully!";
            header("Location: category.php");
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
?>
