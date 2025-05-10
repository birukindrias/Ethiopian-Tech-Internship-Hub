<?php

namespace App\config;

use PDO;
use PDOException;

class Database
{
    public PDO $pdo;
    public static $db;
    public array $migrationsArray = [];

    public function __construct()
    {
        
        self::$db = $this;
        $this->connect();

    }

    private function connect(): void
    {
        try {
            $user = $_ENV['DB_USERNAME'] ?? '';
            $pass = $_ENV['DB_PASSWORD'] ?? '';
            $type = $_ENV['DB_CONNECTION'] ?? '';
            $dsn = sprintf(
                '%s:host=%s;dbname=%s;port=%s',
                $_ENV['DB_CONNECTION'] ?? 'mysql',
                $_ENV['DB_HOST'] ?? 'localhost',
                $_ENV['DB_DATABASE'] ?? 'mvc',
                $_ENV['DB_PORT'] ?? '3306'
            );

            if ($type === 'sqlite') {
                $path = dirname(__DIR__). '/database/' . $_ENV['DB_DATABASE'] ?? '';
                if (!file_exists($path)) {
                    mkdir(dirname($path), 0777, true);
                    touch($path);
                }
                $this->pdo = new PDO("sqlite:$path");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } elseif ($type === 'pgsql') {
                $host = $_ENV['DB_HOST'] ?? '';
                $port = $_ENV['DB_PORT'] ?? '5432';
                $dbname = $_ENV['DB_DATABASE'] ?? '';
                $user = $_ENV['DB_USERNAME'] ?? '';
                $pass = $_ENV['DB_PASSWORD'] ?? '';     
                $this->pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } elseif ($type === 'mysql') {
                $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
                   
        } catch (PDOException $e) {
            echo '<div style="background-color:white; color:red">' . $e->getMessage() . '</div>';
        }
    }

    public static function applyMigrations(string $mode)
    {
        $self = new self();
        $path = dirname(__DIR__) . '/database/Migrations/';
        $writtenMigrations = array_filter(scandir($path), fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'php');
        $self->createMigrationsTable();
        $existing = $self->existingMigrations();
        
        $newMigrations = array_diff( $writtenMigrations,$existing);

        foreach ($newMigrations as $migrationName) {
         
        if ($migrationName === '.' || $migrationName === '..') {    
            continue; // Skip current and parent directory entries
        }
      
        $before = get_declared_classes();
            require_once $path . $migrationName ;
            $after = get_declared_classes();
            
            $newClasses = array_diff($after, $before);
            $className = reset($newClasses); // take the first one added
      
            $migrationInstance = new $className();
           
            $query = $migrationInstance->up();
            $self->pdo->exec($query );

            $self->migrationsArray[] = pathinfo($migrationName.'.php', PATHINFO_FILENAME) ;
        }

        if (!empty($self->migrationsArray)) {
            $self->saveMigrations($self->migrationsArray);
           return $self->log('MIGRATIONS APPLIED SUCCESSFULLY!');
        } else {
            return $self->log('NOTHING TO MIGRATE!');
        }

    }

    private function createMigrationsTable(): void
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration_name VARCHAR(255) NOT NULL
            ) ;
        SQL;

        $this->pdo->exec($sql);
    }

    private function existingMigrations(): array
    {
        $stmt = $this->pdo->prepare("SELECT migration_name FROM migrations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    private function saveMigrations(array $migrations): void
    {
        $values = implode(',', array_map(fn(string $m) => "('$m')", $migrations));
        $sql = "INSERT INTO migrations (migration_name) VALUES $values";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function prepare(string $sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    private function log(string $message): void
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }

    protected string $table = '';
    protected array $wheres = [];

    public static function table(string $table): static
    {
        $instance = new static();
        $instance->table = $table;
        return $instance;
    }

    public function where(string $column, $value): static
    {
        $this->wheres[] = [$column, '=', $value];
        return $this;
    }

    public function exists(): bool
    {
        /** @var PDO $pdo */
        $pdo = Database::$db->pdo;

        $sql = "SELECT 1 FROM {$this->table}";

        if (!empty($this->wheres)) {
            $conditions = array_map(fn($w) => "{$w[0]} {$w[1]} ?", $this->wheres);
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_column($this->wheres, 2));

        return (bool) $stmt->fetchColumn();
    }
}
