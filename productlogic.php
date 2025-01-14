<?php
include 'database.php';

// Fetch data
$categories = "SELECT * FROM categories";
$category_result = mysqli_query($conn, $categories);

// Save product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Check if Category is valid
    if (empty($category_id)) {
        echo "Please select a category.";
        exit();
    }

    // Image upload
    $upload_dir = 'upload/';
    $uploaded_images = [];

    // Main Single Image Upload
    if (isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0) {
        $main_img_name = basename($_FILES['main_img']['name']);
        $main_img_temp = $_FILES['main_img']['tmp_name'];
        $main_img_upload_path = $upload_dir . $main_img_name;

        if (move_uploaded_file($main_img_temp, $main_img_upload_path)) {
            // Store main image path
            $uploaded_images[] = $main_img_upload_path;
        } else {
            echo "Failed to upload main image";
            exit();
        }
    } else {
        echo "Please upload a main image.";
        exit();
    }

    // Insert product data in the database
    $insert_product = "INSERT INTO products (category_id, name, price, product_img, description) 
                       VALUES ('$category_id', '$name', '$price', '$main_img_upload_path', '$description')";

    if (mysqli_query($conn, $insert_product) === TRUE) {
        $last_id = $conn->insert_id;

        // Sub Images Upload (Multiple)
        if (isset($_FILES['sub_img']) && count($_FILES['sub_img']['name']) > 0) {
            for ($i = 0; $i < count($_FILES['sub_img']['name']); $i++) {
                
                // Sub image handling
                if ($_FILES['sub_img']['error'][$i] === 0) {
                    $sub_img_name = basename($_FILES['sub_img']['name'][$i]);
                    $sub_img_temp = $_FILES['sub_img']['tmp_name'][$i];
                    $sub_img_upload_path = $upload_dir . $sub_img_name;

                    if (move_uploaded_file($sub_img_temp, $sub_img_upload_path)) {
                        
                        // Insert sub image into sub_images table

                        $insert_sub_img = "INSERT INTO sub_images (product_id, sub_img) VALUES ('$last_id', '$sub_img_upload_path')";
                        if (!mysqli_query($conn, $insert_sub_img)) {
                            echo "Error saving sub image: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Failed to upload sub image";
                    }
                }
            }
        }
        
        // echo "Product added successfully!";
        // Optionally redirect after success
        // header("Location: product.php");
        // exit();
    } else {
        echo "Error inserting product: " . mysqli_error($conn);
    }
}


    //     // Loop through uploaded images
       
    //         // Image moving file
    //         if (move_uploaded_file($img_temp, $img_upload_path)) {
    //             $uploaded_images[] = $img_upload_path;
    //         } else {
    //             echo "Failed to upload image";
    //             exit();
    //         }
    //     }

    //     // Insert product data in the database
    //     $insert_product = "INSERT INTO products (category_id, name, price, product_img, description) 
    //                        VALUES ('$category_id', '$name', '$price', '$uploaded_images[0]', '$description')";

    //     if (mysqli_query($conn, $insert_product) === TRUE) {
    //         $last_id = $conn->insert_id;

    //         // Insert sub-images
    //         foreach ($uploaded_images as $img_path) {
    //             $insert_sub_img = "INSERT INTO sub_images (product_id, sub_img) VALUES ('$last_id', '$img_path')";

    //             if (!mysqli_query($conn, $insert_sub_img)) {
    //                 echo "Error saving image: " . mysqli_error($conn);
    //             }
    //         }
    //         // Redirect or success message can go here
    //         // $_SESSION['product_message'] = "Product added successfully!";
    //         // header("Location: product.php");
    //         // exit();
    //     } else {
    //         echo "Error inserting product: " . mysqli_error($conn);
    //     }
    // } else {
    //     echo "No images uploaded.";
    // }

?>
