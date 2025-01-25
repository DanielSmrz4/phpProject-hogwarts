<?php

    require "../classes/Database.php";
    require "../classes/Image.php";
    require "../classes/Auth.php";
    require "../classes/Url.php";

    session_start();

    if (!Auth::isLoggedIn()) {
        die("unauthorized access");
    }

    $db = new Database();
    $conn = $db->connectionDB();
    $user_id = $_GET["id"];
    $image_name = $_GET["image_name"];
    $image_path = "../uploads/". $user_id ."/". $image_name;
    
    if (Image::deletePhotoFromDirectory($image_path)) {
        Image::deletePhotoFromDatabase($conn, $image_name);
        Url::redirectUrl("/hogwarts-project/admin/photos.php");
    }
