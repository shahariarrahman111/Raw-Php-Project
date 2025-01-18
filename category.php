<?php
    include 'categorlogic.php';
    include 'mainlayout.php';
    include 'sideber.php';
    include 'header.php';

?>

<div class="d-flex">
    <div class="main-contents">
        <h2>Add Category</h2>
        
        <form action="category.php" method="POST">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="category_btn">Add Category</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>