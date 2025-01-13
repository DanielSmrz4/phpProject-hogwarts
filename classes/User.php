<?php

class User {

    /**
     * 
     * Adds user to the database
     * 
     * @param object $connection - napojení na databázi
     * @param string $first_name - křestní jméno uživatele
     * @param string $second_name - příjmení uživatele
     * @param string $email - email uživatele
     * @param string $password - heslo uživatele
     * 
     * @return integer $id - id uživatele
     * 
     */
    public static function createUser($connection, $first_name, $second_name, $email, $password) {
        $sql = "INSERT INTO user (first_name, second_name, email, password)
                        VALUES (?, ?, ?, ?)";

        $statement = mysqli_prepare($connection, $sql);

        if (!$statement) {
            echo mysqli_error($connection);
        } else {    
            mysqli_stmt_bind_param($statement, "ssss", $first_name, $second_name, $email, $password);

            mysqli_stmt_execute($statement);
            $id = mysqli_insert_id($connection);
            return $id;
        }
    }


    /**
     * 
     * Authentication of user when logging in with email and password
     * 
     * @param object $connection - connection to database
     * @param string $log_email - email from login form
     * @param string $log_password - password from login form
     * 
     * @return boolean True - if login is successful, False - if login is not successful
     * 
     */
    public static function authentication($connection, $log_email, $log_password) {
        $sql = "SELECT password
                FROM user
                WHERE email = ?";
        
        $stmt = mysqli_prepare($connection, $sql);

        if($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $log_email);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if($result->num_rows != 0) {
                    $password_database = mysqli_fetch_row($result); // zde je v proměnné pole
                    $user_password_databe = $password_database[0]; // zde je v proměnné string

                    if($user_password_databe) {
                        return password_verify($log_password, $user_password_databe);
                    }   
                } else {
                    // echo "Špatně zadaný email";
                }           
            }
        } else {
            echo mysqli_error($connection);
        }
    }


    /**
     * 
     * Gets user id from database
     * 
     * @param object $connection - connection to database
     * @param string $email - user's email
     * 
     * @return int - $user_id - users's ID
     * 
     */
    public static function getUserId($connection, $email) {

        $sql = "SELECT id
                FROM user
                WHERE email = ?";

        $stmt = mysqli_prepare($connection, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                $id_database = mysqli_fetch_row($result); // pole
                $user_id = $id_database[0];

                return $user_id;
            }

        } else {
            echo mysqli_error($connection);
        }
    }
}