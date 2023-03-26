<?php

require "IDB.php";

class MySQL implements IDB
{
    private ?PDO $connection = null;
    public function connect(
        string $host = "",
        string $username = "",
        string $password = "",
        string $database = "",
    ): ?static {
        try {
            $this->connection = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
            if ($this->connection) {
                return $this;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function select(string $query): array
    {
        if (empty($query)) {
            return [];
        }

        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function insert(string $table, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        if (empty($data) || array_keys($data) === range(0, count($data) - 1)) {
            return false;
        }

        $keys = array_keys($data);
        $values = array_values($data);

        $query = "INSERT INTO $table (";
        $query .= implode(", ", $keys);
        $query .= ") VALUES (";
        $query .= implode(", ", array_map(fn ($value) => "'$value'", $values));
        $query .= ")";

        $statement = $this->connection->prepare($query);

        return $statement->execute();
    }

    function update(string $table, int $id, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        if (empty($data) || array_keys($data) === range(0, count($data) - 1)) {
            return false;
        }

        $keys = array_keys($data);
        $values = array_values($data);

        $query = "UPDATE $table SET ";
        $query .= implode(", ", array_map(fn ($key, $value) => "$key = '$value'", $keys, $values));
        $query .= " WHERE id = $id";

        $statement = $this->connection->prepare($query);

        return $statement->execute();
    }

    function delete(string $table, int $id): bool
    {
        if (empty($id)) {
            return false;
        }

        if (empty($table)) {
            return false;
        }

        $query = "DELETE FROM $table WHERE id = $id";
        $statement = $this->connection->prepare($query);

        return $statement->execute();
    }
}

