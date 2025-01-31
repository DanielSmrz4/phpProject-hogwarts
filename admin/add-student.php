<?php

    require "../classes/Database.php";
    require "../classes/Url.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if ( !Auth::isLoggedIn() ) {
        die("unauthorized access");
    }
    

    $first_name = null;
    $second_name = null;
    $age = null;
    $life = null;
    $colledge = null;

    $errors = [];

    // Aby se provádělo napojení na databázi až ve chvíli, když se odešlou data a ne hned při vkročení na stránku
    if($_SERVER["REQUEST_METHOD"] === "POST") { 

        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $colledge = $_POST["colledge"];

        $database = new Database();
        $connection = $database->connectionDB();
        
        // Kontrola aby nebyla žádná pole prázdná
        if ($_POST["first_name"] === "") {
            $errors[] = "First name is mandatory";
        }
        
        if ($_POST["second_name"] === "") {
            $errors[] = "Second name is mandatory";
        }

        if ($_POST["age"] === "") {
            $errors[] = "Age is mandatory";
        }

        if ($_POST["life"] === "") {
            $errors[] = "Student records is mandatory";
        }

        if ($_POST["colledge"] === "") {
            $errors[] = "Collegde is mandatory";
        }

        // Když jsou všechna pole vyplněna, přidáme studenta do databáze
        if (empty($errors)) {
            $id = Student::createStudent($connection, $first_name, $second_name, $age, $life, $colledge);

            if ($id) {
                Url::redirectUrl("/hogwarts-project/admin/one-student.php?id=$id");
            } else {
                echo "Student was not created.";
            }          
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
    <link rel="stylesheet" href="../css/admin-add-student.css">

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Add student</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="add-form">
            <div class="main-heading">
                <h1>Add new</h1>
            </div>
            <div class="errors">
                <?php if($errors): ?>
                <?php foreach($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
                <?php endif ?>                
            </div>
            <?php require "../assets/form-student.php"; ?>         
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>