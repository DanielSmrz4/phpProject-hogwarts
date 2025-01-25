<?php    
    
    require "../classes/Database.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if ( !Auth::isLoggedIn() ) {
        die("unauthorized access");
    }

    // $connection = connectionDB();
    $database = new Database();
    $connection = $database->connectionDB();
    
    $students = Student::getAllStudents($connection, "id, first_name, second_name");
    
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

    <title>Students list</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Students list</h1>
        </section>

        <section class="student_list">       
            <?php if (empty($students)): ?>
                <p>List is empty</p>
            <?php else: ?>
                <ul>
                    <?php foreach($students as $one_student): ?>
                        <li>
                            <?= htmlspecialchars($one_student["first_name"])." ".htmlspecialchars($one_student["second_name"]) ?>
                            <a href="./one-student.php?id=<?=$one_student['id']?>">More information</a>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>     
</body>
</html>