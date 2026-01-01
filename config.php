<?php
// Database Configuration - Local XAMPP Test
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'u879835640_accuresecurity');

// SMTP Email Configuration - Hostinger
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'formsumbission@accuresecurity.com'); // Hostinger email
define('SMTP_PASSWORD', 'ShriMarketing@ppcguru2025'); // Replace with your hr@accuresecurity.com password
define('SMTP_FROM_EMAIL', 'formsumbission@accuresecurity.com'); // Must match SMTP_USERNAME
define('SMTP_FROM_NAME', 'AccureSecurity Website');

// Recipient Emails (multiple recipients)
define('ADMIN_EMAIL', 'marketing@ppcguru.ca');
define('ADMIN_EMAIL_CC', 'shrikaanthshyam@gmail.com'); // Additional recipient

// Timezone
date_default_timezone_set('America/Toronto');
?>
