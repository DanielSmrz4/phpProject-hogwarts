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
                        VALUES (:first_name, :second_name, :email, :password)";

        $stmt = $connection->prepare($sql);
   
        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("User creation has failed.");
            }
            
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function createUser. User creation has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
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
                WHERE email = :email";
        
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":email", $log_email, PDO::PARAM_STR);

        try {
            if($stmt->execute()) {
                if ($user = $stmt->fetch()) {
                    return password_verify($log_password, $user[0]);
                }              
            } else {
                throw new Exception("Authentication has failed.");
            }
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function authentication. Authentication has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
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
                WHERE email = :email";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                $user_id = $result[0];
                return $user_id;
            } else {
                throw new Exception("Getting user ID has failed. ");
            }
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function getUserId. Getting user ID has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
        }
    }
}