<?php
include_once("db.php");

class TownCity {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM town_city";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in TownCity::getAll(): " . $e->getMessage());
            throw $e;
        }
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO town_city (name) VALUES (:name)";
            $stmt = $this->db->getConnection()->prepare($sql);

            $stmt->bindParam(':name', $data['name']);
            $stmt->execute();

            // Return the newly inserted record's ID or false on failure
            return $stmt->rowCount() > 0 ? $this->db->getConnection()->lastInsertId() : false;

        } catch (PDOException $e) {
            error_log("Error in TownCity::create(): " . $e->getMessage());
            throw $e;
        }
    }

    public function read($id) {
        try {
            $sql = "SELECT * FROM town_city WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error in TownCity::read(): " . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, $data) {
        try {
            $sql = "UPDATE town_city SET name = :name WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            $stmt->bindValue(':id', $data['id']);
            $stmt->bindValue(':name', $data['name']);

            $stmt->execute();

            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            error_log("Error in TownCity::update(): " . $e->getMessage());
            throw $e;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM town_city WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            error_log("Error in TownCity::delete(): " . $e->getMessage());
            throw $e;
        }
    }
}
?>
