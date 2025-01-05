<?php

/**
 * Database connection
 * 
 * @return object - use to connect to database
 */
function connectionDB() {
    $db_host = "localhost";
    $db_user = "danielSmrz";
    $db_password = "admin.123";
    $db_name = "skola";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
    