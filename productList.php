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

    if(isset($_GET['id'])){
        $product_id = $_GET['id'];

        // Featch Product Img from database

        $imgQuery = "SELECT product_img FROM products WHERE id = '$product_id'";
        $imgResult = mysqli_query($conn, $imgQuery);
        
        if($imgResult->num_rows > 0) {
            $product = mysqli_fetch_assoc($imgResult);
            $imagePath = $product['product_img'];
        }


        // Featch sub image 

        $subImgQuery = "SELECT sub_img FROM sub_images WHERE product_id = '$product_id'";
        $subImgQueryResult = mysqli_query($conn, $subImgQuery);

        if($subImgQueryResult->num_rows > 0){
            while($subImages = mysqli_fetch_assoc($subImgQueryResult)){
                $subImagePath = $subImages['sub_img'];

                if(file_exists($subImagePath) && !empty($subImagePath)){
                    unlink($subImagePath);
                }
            }


            // Delete Sub Images

            $deleteSubImages = "DELETE FROM sub_images WHERE product_id = '$product_id'";
            mysqli_query($conn, $deleteSubImages);
        }


        // Delete Product form database
        $deleteQuery = "DELETE FROM products WHERE id = '$product_id'";

        if(mysqli_query($conn, $deleteQuery)){

            if(file_exists($imagePath) && !empty($imagePath)){
                unlink($imagePath);
            }
            header("Location: productListShow.php");
            exit();
        }else{
            echo "Error deleting product:" . mysqli_error($conn);
        }

    }

   
?>
