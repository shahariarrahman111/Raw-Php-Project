<?php
    include 'categorlogic.php';
    include 'mainlayout.php';
    include 'sideber.php';
    include 'header.php';

?>

<div class="d-flex">
    <div class="main-contents">
        <h2>Add Category</h2>

        <?php 
            if(isset($_SESSION['message'])){
                echo "<div style= 'color:green; text-align: center;'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
        
        ?>

        <form action="category.php" method="POST">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="40" rows="4" required></textarea>
            </div>
            <button type="submit" class="category_btn">Add Category</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>