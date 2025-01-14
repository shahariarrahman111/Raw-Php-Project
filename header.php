<?php
    
    include 'logout.php';

    if(!isset($_SESSION['user_id'])){
        header("Location: loginhtml.php");
        exit();
    }
?>


<div class="d-flex">
    <div class="header">
        <div class="brand">
            <a href="#">Shahariar</a>
        </div>

        <div class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="home.php">Home</a></li>
                <li class="nav-item"><a href="#">About</a></li>
                <li class="nav-item"><a href="#">Contact</a></li>
            </ul>
        </div>

        <?php ?>
            <form action="logout.php" method="POST">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            
    </div>
</div>