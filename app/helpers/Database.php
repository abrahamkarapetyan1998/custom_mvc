<?php

class Database {
    /** @var mysqli */
    protected $db;

    function __construct() {
        $this->openDatabaseConnection();
    }

    function __destruct() {
        $this->closeDatabaseConnection();
    }

    /**
     * @throws Exception
     */
    public function openDatabaseConnection(): void {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_errno) {
            throw new Exception("Failed to connect to MySQL: " . $this->db->connect_error);
        }
    }

    private function closeDatabaseConnection(): void {
        $this->db->close();
    }

}
