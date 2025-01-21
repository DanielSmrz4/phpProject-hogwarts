<?php 

require "../classes/Database.php";
require "../classes/Student.php";
require "../classes/Auth.php";
require "../classes/Url.php";

session_start();

if ( !Auth::isLoggedIn() ) {
    die("Nepovolený přístup!");
}

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
        <section class="delete-from">
            <form method="POST">
                <a href="./one-student.php?id=<?=$one_student['id']?>">Zpět</a>
                <p>Opravdu si přejete vymazat údaje o žákovi <?= $one_student["first_name"] ." ". $one_student["second_name"]?>?</p>
                <button>Smazat trvale</button>               
            </form>
        </section>
    </main>
    
    <?php require "../assets/footer.php" ?>
    <script src="../js/header.js"></script>
</body>
</html>
