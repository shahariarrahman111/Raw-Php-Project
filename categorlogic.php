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
        $status = $_POST['status'];


        $add_sql = "INSERT INTO categories (user_id, name, status) VALUES ('$user_id', '$name', '$status')";

        // Query 
        if (mysqli_query($conn, $add_sql)) {
            $_SESSION['category_message'] = "Category added successfully!";
            header("Location: CategoryListShow.php");
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
?>
