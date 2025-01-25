<?php

    $error_text = $_GET["error_text"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/general.css">

    <title>Error page</title>
</head>
<body>

    <main>
        <section class="errors">
            <p> <?=$error_text?> </p>
            <a href="../admin/students.php">Back</a>
        </section>
    </main>

</body>
</html>