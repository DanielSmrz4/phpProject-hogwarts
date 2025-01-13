<?php

class Student {

    /**
     * Gets one student from database based on ID
     * 
     * @param object $connection - connection to database
     * @param integer $id - ID of particular student
     * 
     * @return mixed assoc array with information about one student
     */
    public static function getStudent($connection, $id, $columns = "*") {
        $sql = "SELECT $columns
                FROM student
                where id= ?";
        
        $stmt = mysqli_prepare($connection, $sql);

        if (!$stmt) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                return mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
        }
    }


    /**
     * 
     * Updatuje informace o žákovi v databázi
     * 
     * @param object $connection - napojení na databázi
     * @param string $first_name - křestní jméno žáka
     * @param string $second_name - příjmení žáka
     * @param integer $age - věk žáka
     * @param string $life - informace o žákovi
     * @param string $colledge - kolej žáka
     * @param integer $id - id žáka
     * 
     * @return boolean True - if student update was successful
     * 
     */
    public static function updateStudent($connection, $first_name, $second_name, $age, $life, $colledge, $id) {

        $sql = "UPDATE student
                    SET first_name = ?,
                        second_name = ?,
                        age = ?,
                        life = ?,
                        colledge = ?
                    WHERE id = ?";

        $stmt = mysqli_prepare($connection, $sql);

        if (!$stmt) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, "ssissi", $first_name, $second_name, $age, $life, $colledge, $id);

            if (mysqli_stmt_execute($stmt)) {
                return True;
            }
        }
    }


    /**
     * 
     * Vymaže studenta z databáze
     * 
     * @param object $connection - propojení s databází
     * @param integer $id - ID daného žáka
     * 
     * @return boolean True - if deletion of student was successful
     * 
     */
    public static function deleteStudent($connection, $id) {
        $sql = "DELETE FROM student
                WHERE id = ?";
        
        $stmt = mysqli_prepare($connection, $sql);

        if (!$stmt) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);

            if(mysqli_stmt_execute($stmt)) {
                return True;
            }
        }
    }


    /**
     * 
     * Vrací všechny studetny v databázi
     * 
     * @param object $connection - propojení s databází
     * 
     * @return array pole objektů, kde každý objekt je jeden žák  
     * 
     */
    function getAllStudents($connection, $columns = "*") {
        $sql = "SELECT $columns 
                FROM student";

        $result = mysqli_query($connection, $sql);

        if(!$result) {
            mysqli_error($connection);
        } else {
            $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $students;
        }
    }


    /**
     * 
     * Adds student to the database
     * 
     * @param object $connection - napojení na databázi
     * @param string $first_name - křestní jméno žáka
     * @param string $second_name - příjmení žáka
     * @param integer $age - věk žáka
     * @param string $life - informace o žákovi
     * @param string $colledge - kolej žáka
     * 
     * @return int $id - ID of created student
     * 
     */
    function createStudent($connection, $first_name, $second_name, $age, $life, $colledge) {
        $sql = "INSERT INTO student (first_name, second_name, age, life, colledge)
                        VALUES (?, ?, ?, ?, ?)";

        $statement = mysqli_prepare($connection, $sql);

        if ($statement === false) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($statement, "ssiss", $first_name, $second_name, $age, $life, $colledge);

            // Provedení
            if (mysqli_stmt_execute($statement)) {
                $id = mysqli_insert_id($connection);

                return $id;

            } else {
                echo mysqli_stmt_error($statement);
            }
        }
    }
}