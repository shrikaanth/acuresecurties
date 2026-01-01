<?php
require_once 'config.php';

class Database {
    private $conn;
    
    public function __construct() {
        try {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
            
            $this->conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function insertQuoteRequest($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO quote_requests (full_name, phone, email, service_type, coverage_type, location, notes, ip_address, user_agent) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        
        // Prepare variables for bind_param (needs references)
        $fullName = $data['fullName'];
        $phone = $data['phone'];
        $email = $data['email'];
        $serviceType = $data['serviceType'] ?? null;
        $coverageType = $data['coverageType'] ?? null;
        $location = $data['location'] ?? null;
        $notes = $data['notes'];
        $ip = $data['ip_address'];
        $userAgent = $data['user_agent'];

        $stmt->bind_param(
            "sssssssss",
            $fullName,
            $phone,
            $email,
            $serviceType,
            $coverageType,
            $location,
            $notes,
            $ip,
            $userAgent
        );
        
        if ($stmt->execute()) {
            $insertId = $this->conn->insert_id;
            $stmt->close();
            return $insertId;
        } else {
            $error = $stmt->error;
            $stmt->close();
            throw new Exception("Database insert failed: " . $error);
        }
    }
    
    public function logEmail($quoteRequestId, $recipientEmail, $subject, $status, $errorMessage = null) {
        $stmt = $this->conn->prepare(
            "INSERT INTO email_logs (quote_request_id, recipient_email, subject, status, error_message) 
             VALUES (?, ?, ?, ?, ?)"
        );
        
        $stmt->bind_param(
            "issss",
            $quoteRequestId,
            $recipientEmail,
            $subject,
            $status,
            $errorMessage
        );
        
        $stmt->execute();
        $stmt->close();
    }
    
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
