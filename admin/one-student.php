<?php    

    require "../classes/Database.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if ( !Auth::isLoggedIn() ) {
        die("Nepovolený přístup!");
    }

    $role = $_SESSION["role"]; 

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
    <link rel="stylesheet" href="../css/admin-one-student.css">

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>One student</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>

        <section class="one-student">           
            <?php if($student === null or $student === false): ?>
                <p class="error-message">Student not found</p>
            <?php else: ?>
                <div class="top-part">
                    <h2><?php echo htmlspecialchars($student["first_name"]). " ".htmlspecialchars($student["second_name"]) ?></h2>
                    <a href="./students.php">Back</a>
                </div>
                
                <div class="description">
                    <p><span class="stand-out">Age:</span> <?= htmlspecialchars($student["age"]) ?> let</p>
                    <p><span class="stand-out">Student records:</span> <?= htmlspecialchars($student["life"]) ?></p>
                    <p><span class="stand-out">Collegde:</span> <?= htmlspecialchars($student["colledge"]) ?></p>
                </div>                                   
            <?php endif ?>
        </section>

        <?php if($role === "admin"): ?>
            <div class="buttons">
                <a class="edit-btn" href="./edit-student.php?id=<?= $student['id'] ?>">Edit</a>
                <a class="delete-btn" href="./delete-student.php?id=<?= $student['id'] ?>">Delete</a>         
            </div>
        <?php endif; ?>

    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>