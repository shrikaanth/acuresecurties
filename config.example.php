<?php
// Database Configuration - Production
define('DB_HOST', 'localhost'); // or your hosting provider's DB host
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
define('DB_NAME', 'your_database_name');

// SMTP Email Configuration - Hostinger
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'hr@accuresecurity.com'); // Hostinger email
define('SMTP_PASSWORD', 'YOUR_EMAIL_PASSWORD'); // Replace with your hr@accuresecurity.com password
define('SMTP_FROM_EMAIL', 'hr@accuresecurity.com'); // Hostinger email
define('SMTP_FROM_NAME', 'AccureSecurity Website');

// Recipient Emails (multiple recipients)
define('ADMIN_EMAIL', 'hr@accuresecurity.com');
define('ADMIN_EMAIL_CC', 'shrikaanthshyam@gmail.com'); // Additional recipient

// Timezone
date_default_timezone_set('America/Toronto');
?>
