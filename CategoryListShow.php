<?php
    // session_start();
    include 'mainlayout.php';
    include 'categoryListLogic.php';
    include 'CategoryStatusUpdate.php';
    include 'sideber.php';
    include 'header.php';
    // include ''

?>

<div class="flex">
    <div class="list">
        <h1>Category List</h1>
        <?php 
            if(isset($_SESSION['update_status'])){
                echo "<div style= 'color:green; text-align: center; margin-top: 10px;'>" . $_SESSION['update_status'] . "</div>";
                unset($_SESSION['update_status']);
            }
            
            if(isset($_SESSION['delete_msg'])){
                echo "<div style= 'color:green; text-align: center;'>" . $_SESSION['delete_msg'] . "</div>";
                unset($_SESSION['delete_msg']);
            }
            
            if(isset($_SESSION['category_message'])){
                echo "<div style= 'color:green; text-align: center; margin-top: 10px;'>" . $_SESSION['category_message'] . "</div>";
                unset($_SESSION['category_message']);
            }
        ?>
       
        <a href="category.php"><button class="add_category">Add Category</button></a>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <td>S.No</td>
                    <td>Category Name</td>
                    <td>Status</td>
                    <td>Operation</td>
                </tr>
            </thead>
            <tbody style="margin: 20px 0px;">
                <?php $counter = 1; ?>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td>
                        <?= $counter++ ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($category['name']) ?>
                    </td>
                    <td class="status-check">
                        <span class="status_text"><?= htmlspecialchars($category['status']) ?></span>
                        <form action="CategoryListShow.php" method="GET">
                            <input type="hidden" name="cat_id" value="<?= $category['id'] ?>">
                            <input type="checkbox" name="status" 
                                <?= $category['status'] == 'active' ? 'checked' : '' ?>
                                onchange="this.form.submit()"> 
                        </form>
                    </td>
                    <td>
                        <a href="CategoryListShow.php?delete_id=<?= $category['id'] ?>" class="delete_btn">Delete</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php' ?>