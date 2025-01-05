<?php    
    require "../assets/database.php";
    require "../assets/student.php";
    require "../assets/auth.php";

    session_start();

    if ( !isLoggedIn() ) {
        die("Nepovolený přístup!");
    }

    $connection = connectionDB(); 

    if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
        $student = getStudent($connection, $_GET["id"]);
    } else {
        $student = null;
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

    <title>One student</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Více informací o žákovi</h1>
        </section>

        <section>           
            <?php if($student === null): ?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2><?php echo htmlspecialchars($student["first_name"]). " ".htmlspecialchars($student["second_name"]) ?></h2>
                <p>Věk: <?= htmlspecialchars($student["age"]) ?> let</p>
                <p>Studijní přehled: <?= htmlspecialchars($student["life"]) ?></p>
                <p>Kolej: <?= htmlspecialchars($student["colledge"]) ?></p>
            <?php endif ?>
        </section>

        <section class="buttons">
                <a href="./edit-student.php?id=<?= $student['id'] ?>">Editovat</a>
                <a href="./delete-student.php?id=<?= $student['id'] ?>">Vymazat</a>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>