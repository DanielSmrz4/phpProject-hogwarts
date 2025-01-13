<?php

class Database {

    /**
     * Database connection
     * 
     * @return object - use to connect to database
     */
    public function connectionDB() {
        $db_host = "localhost";
        $db_name = "skola";
        $db_user = "danielSmrz";
        $db_password = "admin.123";       

        $connection = "mysql:host=" . $db_host . ";dbname=" . $dbname . ";charset=utf8";

        try {
            $db = new PDO($connection, $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit; 
        }
    }
}
