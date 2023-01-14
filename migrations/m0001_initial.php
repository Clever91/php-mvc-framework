<?php

use app\core\Application;

class m0001_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            username VARCHAR(255) NOT NULL UNIQUE,
            state TINYINT(1) NOT NULL DEFAULT 1,
            created_at TIMESTAMP NOT NULL DEFAULT current_timestamp
        )";
        try {
            $db->pdo->beginTransaction();
            $statement = $db->pdo->prepare($sql);
            $statement->execute();
            // $db->pdo->commit();
        } catch (PDOException $e) {
            // $db->pdo->rollBack();
            echo $e->getMessage() . PHP_EOL;
        }
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE IF EXISTS users";
        $db->pdo->beginTransaction();
        try {
            $statement = $db->pdo->prepare($sql);
            $statement->execute();
            $db->pdo->commit();
        } catch (PDOException $e) {
            $db->pdo->rollBack();
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
