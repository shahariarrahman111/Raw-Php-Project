<?php
    // session_start();
    include 'profileupdate.php';
    include 'mainlayout.php';
    include 'sideber.php';
    include 'header.php';
?>



<!-- Main Content -->
<!-- <div class="main-content">
    <h2>Edit Profile</h2>
</div> -->
    <div class="main-contents">
        <h2>Edit Profile</h2>
        <?php
             if (isset($_SESSION['profile_message'])) {
                echo "<div style='color:green; text-align: center;'>" . $_SESSION['profile_message'] . "</div>";
                unset($_SESSION['profile_message']);
            }
        ?>

        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" required>
            </div>
            <button type="submit" class="update_btn">Update Profile</button>
        </form>
    </div>
    


<?php include 'footer.php'; ?>