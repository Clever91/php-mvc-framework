<?php

use app\core\Application;
use app\core\Migration;

class m0001_initial extends Migration
{
    public function up(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            username VARCHAR(255) NOT NULL UNIQUE,
            state TINYINT(1) NOT NULL DEFAULT 1,
            created_at TIMESTAMP NOT NULL DEFAULT current_timestamp
        )";
        $this->execute($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS users";
        $this->execute($sql);
    }
}
