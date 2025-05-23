<?php
class Assignment {
    private $conn;
    private $table_name = "assignments";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($student_id, $title, $description, $due_date) {
        $query = "INSERT INTO " . $this->table_name . " (student_id, title, description, due_date) VALUES (:student_id, :title, :description, :due_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':due_date', $due_date);
        return $stmt->execute();
    }

    public function getByStudentId($student_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllStudentIds() {
        $query = "SELECT id FROM users WHERE role = 'student'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN); 
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsDone($assignment_id) {
        $query = "UPDATE " . $this->table_name . " SET status = 'done' WHERE id = :assignment_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':assignment_id', $assignment_id);
        return $stmt->execute();
    }
    public function delete($assignment_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :assignment_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':assignment_id', $assignment_id);
        return $stmt->execute();
    }
    
}

?>