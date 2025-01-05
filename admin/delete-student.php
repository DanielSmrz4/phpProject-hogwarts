<?php 

require "../assets/database.php";
require "../assets/student.php";
require "../assets/auth.php";
require "../assets/url.php";

session_start();

if ( !isLoggedIn() ) {
    die("Nepovolený přístup!");
}

$connection = connectionDB();

$one_student = getStudent($connection, $_GET["id"], "id, first_name, second_name");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (deleteStudent($connection, $_GET["id"])) {
        redirectUrl("/www2databaze/admin/students.php");
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
