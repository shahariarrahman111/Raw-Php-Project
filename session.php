<?php

session_start();

$_SESSION['user'] = 'John Doe';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Example logic for error and success
    if ($_POST['action'] == 'success') {
        $_SESSION['success'] = 'Action was successful!';
    } elseif ($_POST['action'] == 'error') {
        $_SESSION['error'] = 'An error occurred!';
    }

    // Redirect to the same page to display the message
    header('Location: final_example.php');
    exit();
}