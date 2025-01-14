<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();

        header("Location: loginhtml.php");
        exit();
    }
    
?>