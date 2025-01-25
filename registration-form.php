<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/footer.css">

    <link rel="stylesheet" href="./css/registration-form.css">

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <?php require "./assets/header.php"; ?>

    <main>
        <section class="registration-form">
            <h1>Registration</h1>
            <form action="admin/after-registration.php" method="POST">
                <input type="text" name="first-name" placeholder="First name">
                <input type="text" name="second-name" placeholder="Second name">
                <input type="email" name="email" placeholder="Email">
                <input class="password-first" type="password" name="password" placeholder="Password">
                <input class="password-second" type="password" placeholder="Password again">
                <p class="result-text"></p>
                <input type="submit" value="Sign up">
            </form>
        </section>
    </main>

    <?php require "./assets/footer.php"; ?>
    <script src="./js/header.js"></script>
    <script src="./js/password-control.js"></script>
</body>
</html>