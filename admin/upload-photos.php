<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Url.php";
    require "../classes/Image.php";

    session_start();

    if (!Auth::isLoggedIn()) {
        die("unauthorized access");
    }

    $user_id = $_SESSION["logged_in_user_id"];

    if (isset($_POST["submit"]) and isset($_FILES["image"])) {

        $db = new Database();
        $connection = $db->connectionDB();

        $image_name = $_FILES["image"]["name"];
        $image_size = $_FILES["image"]["size"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];

        if ($error === 0) {
            if ($image_size > 9000000) {
                Url::redirectUrl("/hogwarts-project/errors/error-page.php?error_text=Image file size is too large");
            } else {
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_extension_lower_case = strtolower($image_extension);
                $allowed_extensions = ["jpg", "jpeg", "png"];

                if (in_array($image_extension_lower_case, $allowed_extensions)) {

                    // Creating unique image file name
                    $new_image_name = uniqid("IMG-", true) . "." . $image_extension;

                    // Create directory if it doesn't exist
                    if (!file_exists("../uploads/" . $user_id)) {
                        mkdir("../uploads/" . $user_id, 0777, true);
                    }

                    // Move the uploaded file to the directory
                    $image_upload_path = "../uploads/" . $user_id . "/$new_image_name";
                    move_uploaded_file($image_tmp_name, $image_upload_path);

                    // Insert image into the database
                    if (Image::insertImage($connection, $user_id, $new_image_name)) {
                        Url::redirectUrl("/hogwarts-project/admin/photos.php");
                    }
                    
                } else {
                    Url::redirectUrl("/hogwarts-project/errors/error-page.php?error_text=Unsupported type of file");
                }
            }
        } else {
            Url::redirectUrl("/hogwarts-project/errors/error-page.php?error_text=Could not upload the image file");
        }
    }

?>