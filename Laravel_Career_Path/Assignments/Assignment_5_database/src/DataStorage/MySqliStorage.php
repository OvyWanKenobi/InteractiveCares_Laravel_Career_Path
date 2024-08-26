<?php

namespace App\DataStorage;

use mysqli;

class MySqliStorage implements DataStorageInterface
{
    private $conn;

    public function __construct($db_config)
    {
        $this->conn = new mysqli(
            $db_config['servername'],
            $db_config['username'],
            $db_config['password'],
            $db_config['database']
        );
    }

    public function getAll($table)
    {
        $result = $this->conn->query("SELECT * FROM {$table}");
        if ($result->num_rows === 0) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function select($table, $conditions)
    {
        $query = "SELECT * FROM {$table} WHERE ";
        $keys_values = [];
        foreach ($conditions as $key => $value) {
            $keys_values[] = "{$key} = '{$value}'";
        }

        // var_dump($keys_values);
        $query .= implode(' AND ', $keys_values);

        // var_dump($query);

        $result = $this->conn->query($query);

        // var_dump($result);

        if ($result->num_rows === 0) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode("','", array_values($data));
        $query = "INSERT INTO {$table} ({$columns}) VALUES ('{$values}')";
        $this->conn->query($query);
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
