<?php
session_start();
    include 'updateLogic.php';
    include 'mainlayout.php';
    include 'sideber.php';
    include 'header.php';
?>

<div class="d-flex">
    <div class="main-contents">
        <h2>Update Product</h2>

        <?php 
            if (isset($_SESSION['update_message'])) {
                echo "<div style='color:green; text-align: center;'>" . $_SESSION['update_message'] . "</div>";
                unset($_SESSION['update_message']);
            }
        ?>

        <form action="update.php?product_id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" value="<?php echo isset($product) ? $product['name'] : ''; ?>" required>
            </div>

            <div>
                <label for="category_id">Category Name</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    $category_query = "SELECT * FROM categories";
                    $category_result = mysqli_query($conn, $category_query);
                    if (mysqli_num_rows($category_result) > 0) {
                        while ($category = mysqli_fetch_assoc($category_result)) {
                            $selected = (isset($product) && $category['id'] == $product['category_id']) ? 'selected' : '';
                            echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No categories found</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value="<?php echo isset($product) ? $product['price'] : ''; ?>" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="40" rows="4" required><?php echo isset($product) ? $product['description'] : ''; ?></textarea>
            </div>

            <div>
                <label for="main_img">Main Image:</label>
                <input type="file" id="main_img" name="main_img" accept="image/*" onchange="previewMainImage(event)">
            <div id="main_image_preview">
                <?php if (isset($product) && $product['product_img']) : ?>
                    <img src="<?php echo $product['product_img']; ?>" style="width: 200px;">
                <?php endif; ?>
            </div>
            </div>

            <div>
                <label for="sub_img">Sub Images:</label>
                <input type="file" id="sub_img" name="sub_img[]" accept="image/*" multiple onchange="previewSubImages(event)">
            <div id="product_images_preview">
                <?php
                if (isset($product_id)) {
                    $sub_images_query = "SELECT * FROM sub_images WHERE product_id = '$product_id'";
                    $sub_images_result = mysqli_query($conn, $sub_images_query);
                    while ($sub_img = mysqli_fetch_assoc($sub_images_result)) {
                        echo "<img src='" . $sub_img['sub_img'] . "' style='width: 100px; margin: 5px;'>";
                    }
                }
                ?>
            </div>
            </div>


            <button type="submit" class="product_btn">Update Product</button>
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