<?php

declare(strict_types=1);

class DbHelper extends Database {

    /**
     * Get all records from the table.
     *
     * @return array An array containing all records from the table.
     */
    public function getAll(): array {
        $sql = "SELECT * FROM {$this->table_name}";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            echo "Error: " . $this->db->error;
        }

        if (!$stmt->execute()) {
            echo "Error: " . $this->db->error;
        }

        $result = $stmt->get_result();
        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Save a new record to the table.
     *
     * @param array $attributes An array of column names to insert into.
     * @param array $values An array of values to insert.
     *
     * @return array The newly inserted record.
     */
    public function save(array $attributes, array $values): array
    {
        $columnsSql = implode(", ", $attributes);
        $placeholders = array_fill(0, count($values), '?');
        $valuesSql = implode(", ", $placeholders);

        $sql = "INSERT INTO {$this->table_name} ({$columnsSql}) VALUES ({$valuesSql})";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            echo "Error: " . $this->db->error;
        }

        $stmt->bind_param(str_repeat('s', count($values)), ...$values);

        if (!$stmt->execute()) {
            echo "Error: " . $this->db->error;
        }
        $comment_id = $stmt->insert_id;
        $comment = $this->find($comment_id);

        return $comment;
    }

    /**
     * Find a record in the table by its ID.
     *
     * @param int $id The ID of the record to find.
     *
     * @return array|null The found record, or null if not found.
     */
    public function find(int $id): ?array {
        $sql = "SELECT * FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            echo "Error: " . $this->db->error;
        }

        $stmt->bind_param('i', $id);

        if (!$stmt->execute()) {
            echo "Error: " . $this->db->error;
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ?: null;
    }

    /**
     * Delete a record from the table by its ID.
     *
     * @param int $id The ID of the record to delete.
     *
     * @return int The number of affected rows.
     */
    public function delete(int $id): int {
        $sql = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            echo "Error: " . $this->db->error;
        }

        $stmt->bind_param('i', $id);

        if (!$stmt->execute()) {
            echo "Error: " . $this->db->error;
        }

        return $stmt->affected_rows;
    }
}