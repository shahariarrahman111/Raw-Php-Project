<?php

    
    include 'database.php';

    $productQuery = "SELECT * FROM products";
    $result = mysqli_query($conn, $productQuery);

    // var_dump($result);

    // Product extract here
    $products = [];

    // Product table data view in list

   if ($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
            $products[] = $row;
        }
   }else{
        header("Location: product.php");
   }




    // Product Delete Option Start here

   if (isset($_GET['delete_id'])) {
    // Single product delete existing code
    $product_id = $_GET['delete_id'];

    // Fetch product image from the database
    $imgQuery = "SELECT product_img FROM products WHERE id = '$product_id'";
    $imgResult = mysqli_query($conn, $imgQuery);
    
        if ($imgResult->num_rows > 0) {
            $product = mysqli_fetch_assoc($imgResult);
            $imagePath = $product['product_img'];
        }

        // Fetch sub images
        $subImgQuery = "SELECT sub_img FROM sub_images WHERE product_id = '$product_id'";
        $subImgQueryResult = mysqli_query($conn, $subImgQuery);

        if ($subImgQueryResult->num_rows > 0) {
            while ($subImages = mysqli_fetch_assoc($subImgQueryResult)) {
                $subImagePath = $subImages['sub_img'];

                if (file_exists($subImagePath) && !empty($subImagePath)) {
                    unlink($subImagePath);
                }
            }

            // Delete sub images from the database
            $deleteSubImages = "DELETE FROM sub_images WHERE product_id = '$product_id'";
            mysqli_query($conn, $deleteSubImages);
        }

        // Delete the product from the database
        $deleteQuery = "DELETE FROM products WHERE id = '$product_id'";

        if (mysqli_query($conn, $deleteQuery)) {
            if (file_exists($imagePath) && !empty($imagePath)) {
                unlink($imagePath);
            }
            header("Location: productListShow.php");
            exit();
        } else {
            echo "Error deleting product:" . mysqli_error($conn);
        }
        
        
    }


    
    // Delete Multiple products


    if(isset($_POST['delete_products'])) {
        $deleteMultipleProducts = $_POST['delete_products'];
        // var_dump($deleteMultipleProducts);
        // die();


        // Delete Main Product Image and I use loop for multiple data delete and gets in a array

        foreach ($deleteMultipleProducts as $product_id) {
            
            $imageQuery = "SELECT product_img FROM products WHERE id = '$product_id'";
            $imageResult = mysqli_query($conn, $imageQuery);
            // var_dump($imageResult);
            // die();

            if($imageResult->num_rows > 0) {
                $products  = mysqli_fetch_assoc($imageResult);
                // var_dump($products);
                // die();
                $imagesPath = $products['product_img'];
            }

            // Fatch Sub Image For delete

            $subImageQuery = "SELECT sub_img FROM sub_images WHERE product_id = '$product_id'";
            $subImageResult = mysqli_query($conn, $subImageQuery);
            
            if ($subImageResult->num_rows > 0) {
                while ($subImagess = mysqli_fetch_assoc($subImageResult)){
                    $subImagesPaths = $subImagess['sub_img'];
                    if(file_exists($subImagesPaths) && !empty($subImagesPaths)){
                        unlink($subImagesPaths);
                    }
                }

                //  Delete SubImage From Database

                $deleteSubImage = "DELETE FROM sub_images WHERE product_id = '$product_id'";
                mysqli_query($conn, $deleteSubImage);
            }

            // Delete Product From Database

            $deleteProducts = "DELETE FROM products WHERE id = '$product_id'";
            if(mysqli_query($conn, $deleteProducts)){
                if(file_exists($imagesPath) && !empty($imagesPath)){
                    unlink($imagesPath);
                }
            }

        }

        header("Location: productListShow.php");
        exit();


    }

   
?>
