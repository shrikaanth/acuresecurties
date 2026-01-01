# 🗄️ Database Update Required

Because the form format has changed, you need to update your database on Hostinger to allow the extra fields to be empty (NULL).

## 🚀 How to Update Hostinger Database

1. **Login to Hostinger hPanel.**
2. Go to **Databases** → **phpMyAdmin**.
3. Select your database: `u879835640_accuresecurity`.
4. Click the **"SQL"** tab at the top.
5. **Copy and Paste** this command and click **"Go"**:

```sql
ALTER TABLE quote_requests 
MODIFY service_type VARCHAR(100) DEFAULT NULL,
MODIFY coverage_type VARCHAR(100) DEFAULT NULL,
MODIFY location VARCHAR(255) DEFAULT NULL;
```

**OR** if you prefer to reset the table completely (WARNING: Deletes existing data):

```sql
DROP TABLE IF EXISTS quote_requests;

CREATE TABLE quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255),
    service_type VARCHAR(100) DEFAULT NULL,
    coverage_type VARCHAR(100) DEFAULT NULL,
    location VARCHAR(255) DEFAULT NULL,
    notes TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'contacted', 'quoted', 'converted', 'declined') DEFAULT 'new',
    INDEX idx_created_at (created_at),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## 📋 What Was Changed in Codes

1. **`database.sql`**: Updated schema to allow `NULL` for optional fields.
2. **`Database.php`**: Updated insert logic to handle missing fields gracefully.
3. **`submit-quote.php`**: Removed strict validation for missing fields. Only Name and Phone are required now.
4. **`EmailService.php`**: Updated email template to hide empty fields so emails look clean.

## 🚀 Deployment

1. **Upload `submit-quote.php`** to Hostinger.
2. **Upload `Database.php`** to Hostinger.
3. **Upload `EmailService.php`** to Hostinger.
4. **Run the SQL update** (Step 1 above).
