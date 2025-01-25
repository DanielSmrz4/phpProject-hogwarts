<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    // $connection = connectionDB();
    $database = new Database();
    $connection = $database->connectionDB();

    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $id = User::createUser($connection, $first_name, $second_name, $email, $password);

    if(!empty($id)) {
        // Zabraňuje provedení tzv. fixation attack
        session_regenerate_id(true);

        // Nastavení, že je uživatel přihlášený
        $_SESSION["is_logged_in"] = true;
        // Nastavení ID uživatele
        $_SESSION["logged_in_user_id"] = $id;

        Url::redirectUrl("/hogwarts-project/admin/students.php");
        
    } else {       
        echo " User wasn't created.";
    }
} else {
    echo "unauthorized access";
}