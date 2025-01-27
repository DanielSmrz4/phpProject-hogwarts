<?php

    require "../classes/Database.php";
    require "../classes/Url.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if ( !Auth::isLoggedIn() ) {
        die("Nepovolený přístup!");
    }

    $role = $_SESSION["role"];

    $database = new Database();
    $connection = $database->connectionDB();

    if (isset($_GET["id"])) {
        $one_student = Student::getStudent($connection, $_GET["id"]);

        if ($one_student and is_numeric($_GET["id"])) {
            $first_name = $one_student["first_name"];
            $second_name = $one_student["second_name"];
            $age = $one_student["age"];
            $life = $one_student["life"];
            $colledge = $one_student["colledge"];
            $id = $one_student["id"];
        } else {
            die("Student nenalezen.");
        }

    } else {
        die("ID není zadáno, student nebyl nalezen.");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $colledge = $_POST["colledge"];

        if (Student::updateStudent($connection, $first_name, $second_name, $age, $life, $colledge, $id)) {
            Url::redirectUrl("/hogwarts-project/admin/one-student.php?id=$id");
        }
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
    <link rel="stylesheet" href="../css/admin-edit-student.css">

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Edit student</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <?php if($role === "admin"): ?>
            <div class="top-part">
                <h2>Edit student</h2>
                <a href="./one-student.php?id=<?= $_GET['id']; ?>">Back</a>
            </div>
            
            <?php require "../assets/form-student.php" ?>
        <?php else: ?>
            <p>This page is for admin only, get out</p>
        <?php endif; ?>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>