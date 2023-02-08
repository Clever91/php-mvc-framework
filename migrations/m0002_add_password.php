<?php

use cleveruz\phpmvc\Migration;

class m0002_add_password extends Migration
{
    public function up(): void
    {
        $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL AFTER username";
        $this->execute($sql);
    }

    public function down(): void
    {
        $sql = "ALTER TABLE users DROP COLUMN password";
        $this->execute($sql);
    }
}
