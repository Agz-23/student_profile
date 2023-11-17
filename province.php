<?php
include_once("db.php");

class Province {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM province";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error or handle it in a way that suits your application
            error_log("Error in Province::getAll(): " . $e->getMessage());
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
}
?>
