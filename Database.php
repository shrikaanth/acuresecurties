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
        
        $stmt->bind_param(
            "sssssssss",
            $data['fullName'],
            $data['phone'],
            $data['email'],
            $data['serviceType'] ?? null,  // Allow null
            $data['coverageType'] ?? null, // Allow null
            $data['location'] ?? null,     // Allow null
            $data['notes'],                // Message maps to notes
            $data['ip_address'],
            $data['user_agent']
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
