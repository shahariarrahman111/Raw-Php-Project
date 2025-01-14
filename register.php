<?php

    session_start();

    // Include database connection
    // include "config.php";
    include "database.php";


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql_email = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql_email);

        if ($result->num_rows > 0){
            $_SESSION['message'] = "This email already exists ";
            header("Location: signup.php");
            exit();

            // Password validation only A-Z, a-z, 0-9, and special characters
        }else{
            if(!preg_match("/^[a-zA-Z0-9!@#$%^&*]$/", $_POST["password"])){

                // Password validation , hash it

                $passwordhash = password_hash($password, PASSWORD_BCRYPT);
            

                $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$passwordhash')";
                if($conn->query($sql) === TRUE){
                    echo "Registration successful";
                }else{
                    echo "Error:" . $sql . "<br>" . $conn->error;
                }
            }else{
                echo "Password must be 8-16 characters long and contain only A-Z, a-z, 0-9, and special characters";
            } 
        }    
    }

    $conn->close();

    header("Location: loginhtml.php");
    exit();
?>
