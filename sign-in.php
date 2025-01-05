<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/footer.css">

    <link rel="stylesheet" href="./css/sign-in.css">

    <script src="https://kit.fontawesome.com/0f9ae4d401.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <?php require "./assets/header.php"; ?>

    <main>       
        <section class="form">
            <h1>Přihlášení</h1>
            <form action="./admin/log-in.php" method="POST">
                <input class="email" type="email" name="login-email" placeholder="Email">
                <input class="password" type="password" name="login-password" placeholder="Heslo">
                <input class="btn" type="submit" value="Přihlásit se">
            </form>
        </section>
    </main>

    <?php require "./assets/footer.php"; ?>
    <script src="./js/header.js"></script>
</body>
</html>