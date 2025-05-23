<?php

class UserInfo {
    private $conn;
    private $table_name = "user_info";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($user_id, $first_name, $last_name, $email, $address, $contact_number, $birthday) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, first_name, last_name, email, address, contact_number, birthday) VALUES (:user_id, :first_name, :last_name, :email, :address, :contact_number, :birthday)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':birthday', $birthday);
        return $stmt->execute();
    }
    
    public function getByUserId($user_id) {
        $query = "SELECT * FROM user_info WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($user_id, $first_name, $last_name, $email, $address, $contact_number, $birthday) {
        $query = "UPDATE " . $this->table_name . " 
                  SET first_name = :first_name, last_name = :last_name, email = :email, address = :address, contact_number = :contact_number, birthday = :birthday 
                  WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
    
    
    
}
?>