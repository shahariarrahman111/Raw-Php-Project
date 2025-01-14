<?php

    include 'database.php';

    $product = "SELECT id FROM products ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $product);

    // var_dump($result);
    // exit()

    if($result && $result->num_rows > 0){
        $rows = mysqli_fetch_assoc($result);
        // var_dump($rows['id']);
        // exit();
        $last_product_id = $rows['id'];


        // Check if files are upload

        if(isset($_FILES['main_img']) && count($_FILES['main_img']['name']) > 0) {
            $upload_sub_img_dir = 'upload/';


            // Loop upload image

            for($i = 0; $i < count($_FILES['main_img']['name']); $i++){
                $img_name = basename($_FILES['main_img']['name'][$i]);
                $img_temp = $_FILES['main_img']['tmp_name'][$i];
                $img_upload_path = $upload_sub_img_dir . $img_name;



                // Moved Uploaded file Upload directory

                if(move_uploaded_file($img_temp, $img_upload_path)){
                    
                    $insert_sub_img_product = "INSERT INTO sub_images (product_id, sub_img)
                    VALUES ('$last_product_id', '$img_upload_p')";

                    if(!mysqli_query($conn, $insert_sub_img_product)){
                        echo "Error savings sub_img:" . $mysqli->error($conn);
                        // exit();
                    }
                }else{
                    echo "Failed to upload image:" . $img_name;
                }
    
            }
           
        }
        
    }
    

?>