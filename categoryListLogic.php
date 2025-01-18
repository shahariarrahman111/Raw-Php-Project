<?php

    // session_start();
    include 'database.php';


    // Fetch all category to show in  category list
    $categoriesQuery = "SELECT * FROM categories";
    $categoriesResult = mysqli_query($conn, $categoriesQuery);
    $categories = [];


    if ($categoriesResult->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($categoriesResult)){
            $categories[] = $row;
        }
    }


    // Category actice status  .
    // When a category active use can use that's category
    // When a category not active this category didn't use a user

    

    /* Category Delete Logical Operation */

    if (isset($_GET['delete_id'])) {
        $category_id = $_GET['delete_id'];

        
        $checkCategory = "SELECT id FROM categories WHERE id = '$category_id'";
        $checkCategoryResult = mysqli_query($conn, $checkCategory);

        if ($checkCategoryResult->num_rows > 0) {

            $deleteCategory  = "DELETE FROM categories WHERE id = '$category_id'";

            if (mysqli_query($conn, $deleteCategory)) {
                $_SESSION['delete_msg'] = "Delete category successfully!";
                header("Location: CategoryListShow.php");
                exit();
            }
        }
    }

?>