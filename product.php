<?php
    include 'productlogic.php';
    // include 'subImages.php';
    include 'mainlayout.php';     
    include 'sideber.php';       
    include 'header.php';    
?>

<div class="d-flex">
    <div class="main-contents">
        <h2>Add Product</h2>

        <?php 
            if (isset($_SESSION['product_message'])) {
                echo "<div style='color:green; text-align: center;'>" . $_SESSION['product_message'] . "</div>";
                unset($_SESSION['product_message']);
            }
        ?>

        <form action="product.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <label for="category_id">Category Name</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    if (mysqli_num_rows($category_result) > 0) {
                        while ($category = mysqli_fetch_assoc($category_result)) {
                            echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No categories found</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="40" rows="4" required></textarea>
            </div>

            <div>
                <label for="main_img">Main Image:</label>
                <input type="file" id="main_img" name="main_img" accept="image/*" onchange="previewMainImage(event)">
                <div id="main_image_preview"></div>
            </div>

            <div>
                <label for="sub_img">Sub Image:</label>
                <input type="file" id="sub_img" name="sub_img[]" accept="image/*" multiple onchange="previewSubImages(event)">
                <div id="product_images_preview"></div>
            </div>

            <button type="submit" class="product_btn">Add Product</button>
        </form>
    </div>
</div>

<script>
    
    // JavaScript for Main Image Preview
    function previewMainImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const preview = document.getElementById('main_image_preview');
            preview.innerHTML = '';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '200px';
            preview.appendChild(img);
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // JavaScript for Sub-Thumbnail Images Preview
    function previewSubImages(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('product_images_preview');

        // Loop through the newly selected files
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';  
                img.style.margin = '5px';
                img.style.display = 'block';

                // Append the new image
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(files[i]);
        }
    }
</script>


<?php
    include 'footer.php';
?>
