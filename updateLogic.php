<?php

    include 'database.php';

    $category = "SELECT * FROM categories";
    $categoryResult = mysqli_query($conn, $category);

    
    $product_id = null ;

    // Check Product Id
    if(isset($_GET['product_id']) && !empty($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
       
    }else{
        // var_dump($_GET);
        echo "Cannot get product id";
        exit();
    }

        // if (!isset($product_id) || empty($product_id)) {
        //     var_dump($product_id);
        //     // echo "Product ID is missing or invalid.";
        //     exit();
        // }

    // Fetch product id

    if($product_id){
        $product_query = "SELECT * FROM products WHERE id = '$product_id'";
        $productResultQuery = mysqli_query($conn, $product_query);

        if($productResultQuery->num_rows > 0) {
            $product = mysqli_fetch_assoc($productResultQuery);
        }else{
            echo "Product Not Found";
            exit();
        }
    }


    // Save Product Update

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // var_dump($_POST);
        // exit();
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        

        // Check Validation of category Id

        if(empty($category_id)) {
            echo "Please select a category";
            exit();
        }


        // Image save directory
        $upload_dir = 'upload/';

        // Image save and move files
        if (isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0) {
            $main_img_name = basename($_FILES['main_img']['name']);
            $main_img_temp = $_FILES['main_img']['tmp_name'];
            $main_img_upload_path = $upload_dir . $main_img_name;


            if(move_uploaded_file($main_img_temp, $main_img_upload_path)){
                $update_product = "UPDATE products SET category_id = '$category_id', name = '$name', price = '$price',
                product_img = '$main_img_upload_path', description = '$description' WHERE id = '$product_id'";
            }else{
                echo "Failed to update image";
                exit();
            }
        } else{

            // If set new main image stay set old image
            $update_product = "UPDATE products SET category_id = '$category_id', name = '$name', price = '$price',
            description = '$description' WHERE id = '$product_id'";
        }  
        
        if(mysqli_query($conn, $update_product)) {
            // $last_id = $conn->insert_id;
            // echo "Error:" . mysqli_error($conn);
            // var_dump($update_product);
            // exit();

            // Loop for sub images
            if(isset($_FILES['sub_img']) && count($_FILES['sub_img']['name']) > 0){
                for($i = 0; $i < count($_FILES['sub_img']['name']); $i++){
                    if ($_FILES['sub_img']['error'][$i] === 0) {
                        $sub_img_name = basename($_FILES['sub_img']['name'][$i]);
                        $sub_img_temp = $_FILES['sub_img']['tmp_name'][$i];
                        $sub_img_upload_path = $upload_dir . $sub_img_name;


                        if(move_uploaded_file($sub_img_temp, $sub_img_upload_path)){
                            $insert_sub_img = "INSERT INTO sub_images (product_id, sub_img) VALUES ('$product_id', '$sub_img_upload_path')";

                            if(!mysqli_query($conn, $insert_sub_img)){
                                echo "Error saving sub image: " . mysqli_error($conn);

                            }
                        }
                    }
                }
            }
        }
        // Success message
        $_SESSION['update_message'] = "Product updated successfully.";
        header("Location: update.php?product_id=" . $product_id);
        exit();
    
    }


?>