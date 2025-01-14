<?php
    session_start();


// Include database connection
//   include 'config.php';
  include "database.php";
  


   if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email  = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        
        if(password_verify($password, $user["password"])){
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["message"] = "Login successful";
            header("Location: home.php");
            exit;
        }else{
            $_SESSION["error"] = "Passsword is incorrect";
            header("Location: loginhtml.php");
            exit;
        }
    }else{
        $_SESSION["error"] = "Email is incorrect";
        header("Location: loginhtml.php");
        exit;
    }

   }

    $conn->close();
?>
