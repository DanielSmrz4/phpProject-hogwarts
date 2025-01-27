<?php 

require "../classes/Database.php";
require "../classes/Student.php";
require "../classes/Auth.php";
require "../classes/Url.php";

session_start();

if ( !Auth::isLoggedIn() ) {
    die("Nepovolený přístup!");
}

$role = $_SESSION["role"];

// $connection = connectionDB();
$database = new Database();
$connection = $database->connectionDB();

$one_student = Student::getStudent($connection, $_GET["id"], "id, first_name, second_name");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (Student::deleteStudent($connection, $_GET["id"])) {
        Url::redirectUrl("/hogwarts-project/admin/students.php");
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

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Delete student</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>

        <?php if($role === "admin"): ?>
            <section class="delete-from">
                <form method="POST">
                    <a href="./one-student.php?id=<?=$one_student['id']?>">Zpět</a>
                    <p>Do you really wish to delete student <?= $one_student["first_name"] ." ". $one_student["second_name"]?>?</p>
                    <button>Delete</button>               
                </form>
            </section>
        <?php else: ?>
            <section>
                <p>This page is for admin only, get out</p>
            </section>
        <?php endif; ?>

    </main>
    
    <?php require "../assets/footer.php" ?>
    <script src="../js/header.js"></script>
</body>
</html>
