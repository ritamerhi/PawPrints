<?php
try {
    // Establish a database connection using PDO
    $pdo = new PDO('mysql:host=localhost; dbname=paw_prints_db', 'root', '');

    // Create a new Table object using the PDO instance
    $table = new Table($pdo);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Table {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findSql($sql, $params = array()) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($table, $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByIds($table, $ids = array()) {
        if (empty($ids)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($ids), '?')); // Create placeholders
        $sql = "SELECT * FROM $table WHERE petID IN ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($tableName, array $data): bool {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
    
        $statement = $this->pdo->prepare("INSERT INTO $tableName ($columns) VALUES ($values)");
    
        return $statement->execute(array_values($data));
    }

    public function update($tableName, $data, $conditions, $params) {
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "$key = ?";
        }
        $updates = implode(', ', $updates);
        $sql = "UPDATE $tableName SET $updates WHERE $conditions";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute(array_merge(array_values($data), $params));
    }

}


?>