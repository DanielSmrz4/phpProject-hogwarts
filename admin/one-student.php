<?php    

    require "../classes/Database.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if ( !Auth::isLoggedIn() ) {
        die("Nepovolený přístup!");
    }

    // $connection = connectionDB(); 
    $database = new Database();
    $connection = $database->connectionDB();

    if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
        $student = Student::getStudent($connection, $_GET["id"]);
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
            <h1>More information</h1>
        </section>

        <section>           
            <?php if($student === null or $student === false): ?>
                <p>Student not found</p>
            <?php else: ?>
                <h2><?php echo htmlspecialchars($student["first_name"]). " ".htmlspecialchars($student["second_name"]) ?></h2>
                <p>Age: <?= htmlspecialchars($student["age"]) ?> let</p>
                <p>Student records: <?= htmlspecialchars($student["life"]) ?></p>
                <p>Collegde: <?= htmlspecialchars($student["colledge"]) ?></p>
            <?php endif ?>
        </section>

        <section class="buttons">
                <a href="./edit-student.php?id=<?= $student['id'] ?>">Edit</a>
                <a href="./delete-student.php?id=<?= $student['id'] ?>">Delete</a>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>