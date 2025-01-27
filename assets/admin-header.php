<?php

    $role_for_header = $_SESSION["role"];

?>


<header>
    <div class="logo">
        <a href="./students.php">
            <img src="../img/hogwarts-logo.png" alt="">
        </a>
    </div>          
    <nav>
        <ul>
            <li><a href="./students.php">Students list</a></li>
            <li><a href="./add-student.php">Add student</a></li>
            <?php if($role_for_header === "admin"): ?>
                <li><a href="./photos.php">Images</a></li>
            <?php endif; ?>           
            <li><a href="./log-out.php">Log out</a></li>
        </ul>
    </nav>

    <div class="menu-icon">
        <i class="fa-solid fa-bars"></i>
        <!-- <i class="fa-solid fa-xmark"></i> -->
    </div>
</header>