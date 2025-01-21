<?php

    require "../classes/Auth.php";

    session_start();

    if (!Auth::isLoggedIn()) {
        die();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <?php require "../assets/admin-header.php" ?>

    <main>
        <section class="upload-photos">
            <h1>Images</h1>
            <form action="./upload-photos.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="image" required>
                <input type="submit" name="submit" value="Upload">
            </form>
        </section>
    </main>

    <?php require "../assets/footer.php" ?>
    <script src="../js/header.js"></script>
</body>
</html>