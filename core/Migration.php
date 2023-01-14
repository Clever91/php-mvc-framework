<?php

namespace app\core;

use app\core\interface\IMigration;
use PDO;
use PDOException;
use Throwable;

abstract class Migration implements IMigration
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function execute($sql): void
    {
        try {
            // $this->pdo->beginTransaction();
            $this->pdo->exec($sql);
            // $this->pdo->commit();
        } catch (PDOException $e) {
            // $this->pdo->rollBack();
            die($e->getMessage());
        }
    }
}
