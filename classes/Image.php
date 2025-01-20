<?php

class Image {

    public static function insertImage($conn, $user_id, $image_name) {
        $sql = "INSERT INTO 
                image (user_id, image_name)
                VALUES (:user_id, :image_name)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }

}