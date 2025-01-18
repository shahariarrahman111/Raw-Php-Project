<?php

    session_start();
    include 'database.php';


    // Category Id and status get 
    if (isset($_GET['cat_id'])) {
        
        // $status = empty($_GET['status']) ? 'inactive' : 'active';
        if (empty($_GET['status'])){
            $status = 'inactive';
        }else {
            $status = 'active';
        }

        $category_id = $_GET['cat_id'];

            $categoryStatusUpdateQuery = "UPDATE categories SET  status= '$status' WHERE id = '$category_id'";

            if (mysqli_query($conn, $categoryStatusUpdateQuery)){
                $_SESSION['update_status'] = "Status Updated";
                header("Location: CategoryListShow.php");
                exit();
            }
        }

?>