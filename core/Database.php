<?php

namespace app\core;

use PDO;

class Database
{
    public PDO $pdo;
    private string $path;

    public function __construct(array $config)
    {
        $this->pdo = new PDO($config["dsn"], $config["user"], $config["password"]);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->path = Application::$ROOT_DIR . "/migrations";
    }

    public function prepare(string $sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $newMigrations = [];
        $appliedMigrations = $this->getAppliedMigrations();
        $toApplyingMigrations = $this->getFileMigrations();
        $applyingMigrations = array_diff($toApplyingMigrations, $appliedMigrations);
        foreach ($applyingMigrations as $migration) {
            $this->consoleLog("Applying migration {$migration}");
            require_once $this->path . "/" . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            call_user_func([new $className(), "up"]);
            $this->consoleLog("Applied migration {$migration}");
            array_push($newMigrations, $migration);
        }
        if (empty($newMigrations)) {
            $this->consoleLog("No migrations files");
        } else {
            $this->saveMigrations($newMigrations);
            $this->consoleLog("All migrations are applied");
        }
    }

    private function createMigrationsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY, 
            migration VARCHAR(200) NOT NULL, 
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
        $this->pdo->exec($sql);
    }

    private function getAppliedMigrations(): mixed
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigrations($migrations): void
    {
        $values = implode(",", array_map(fn ($m) => "('{$m}')", $migrations));
        $sql = "INSERT INTO migrations (migration) VALUES $values";
        $this->pdo->exec($sql);
    }

    private function getFileMigrations(): array
    {
        return array_filter(scandir($this->path), function ($file) {
            if ($file === "." || $file === "..")
                return false;
            return true;
        });
    }

    private function consoleLog($message): void
    {
        echo "[" . date("Y-m-d H:i:s") . "]: {$message}" . PHP_EOL;
    }
}
