-- Database Creation and Schema Setup
-- Run this script in phpMyAdmin or your MySQL client

-- 1. Create the Database (if not exists)
CREATE DATABASE IF NOT EXISTS u879835640_accuresecurity CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 2. Select the Database
USE u879835640_accuresecurity;

-- 3. Create Quote Requests Table
-- Stores all form submissions from the website
CREATE TABLE IF NOT EXISTS quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL, -- Made required to match form validation
    
    -- Optional fields (can be expanded later if forms change)
    service_type VARCHAR(100) DEFAULT NULL,
    coverage_type VARCHAR(100) DEFAULT NULL,
    location VARCHAR(255) DEFAULT NULL,
    
    -- Message/Notes field
    notes TEXT,
    
    -- Metadata
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'contacted', 'quoted', 'converted', 'declined') DEFAULT 'new',
    
    INDEX idx_email (email),
    INDEX idx_created_at (created_at),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Create Email Logs Table
-- Tracks status of email notifications sent to Admin
CREATE TABLE IF NOT EXISTS email_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_request_id INT,
    recipient_email VARCHAR(255),
    subject VARCHAR(255),
    status VARCHAR(50), -- 'sent' or 'failed'
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quote_request_id) REFERENCES quote_requests(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
