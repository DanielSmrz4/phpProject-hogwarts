<?php
    require "../assets/database.php";
    require "../assets/student.php";
    require "../assets/auth.php";
    require "../assets/url.php";

    session_start();

    if ( !isLoggedIn() ) {
        die("Nepovolený přístup!");
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

        $connection = connectionDB();
        
        // Kontrola aby nebyla žádná pole prázdná
        if ($_POST["first_name"] === "") {
            $errors[] = "Křestní jméno je povinné";
        }
        
        if ($_POST["second_name"] === "") {
            $errors[] = "Příjmení je povinné";
        }

        if ($_POST["age"] === "") {
            $errors[] = "Věk je povinný";
        }

        if ($_POST["life"] === "") {
            $errors[] = "Studijní přehled je povinný";
        }

        if ($_POST["colledge"] === "") {
            $errors[] = "Kolej je povinná";
        }

        // Když jsou všechna pole vyplněna, přidáme studenta do databáze
        if (empty($errors)) {
            $id = createStudent($connection, $first_name, $second_name, $age, $life, $colledge);

            if ($id) {
                redirectUrl("/www2databaze/admin/one-student.php?id=$id");
            } else {
                echo "Student was not created";
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

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Add student</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="add-form">
            <?php if($errors): ?>
            <?php foreach($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach ?>
            <?php endif ?>
            <?php require "../assets/form-student.php"; ?>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>