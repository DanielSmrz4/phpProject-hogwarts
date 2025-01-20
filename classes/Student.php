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
                where id= :id";
        
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return $stmt->fetch();
            } else {
                throw new Exception("Getting data about a student has failed");
            }
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function getStudent. Getting data about a student has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
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
                    SET first_name = :first_name,
                        second_name = :second_name,
                        age = :age,
                        life = :life,
                        colledge = :colledge
                    WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":colledge", $colledge, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Student update has failed");
            }
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function updateStudent. Student update has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
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
                WHERE id = :id";
        
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Deletion of student has failed");
            }
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function deleteStudent. Deletion of student has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
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
    public static function getAllStudents($connection, $columns = "*") {
        $sql = "SELECT $columns 
                FROM student";

        $stmt = $connection->prepare($sql);

        try {
            if ($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Loading all students has failed.");
            }
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function deleteStudent. Loading all students has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
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
    public static function createStudent($connection, $first_name, $second_name, $age, $life, $colledge) {
        $sql = "INSERT INTO student (first_name, second_name, age, life, colledge)
                VALUES (:first_name, :second_name, :age, :life, :colledge)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":colledge", $colledge, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("Student creation has failed. ");
            }     
        } catch (Exception $e) {
            error_log(date("d.m.Y H:i ") . "Exception at function createStudent. Student creation has failed.\n" . $e->getFile() . " line: " . $e->getLine() . "\n\n", 3, "../errors/error.log");
            echo "Exception: " . $e->getMessage();
        }      
    }
}