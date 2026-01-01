# 🚀 Production Deployment Guide - AccureSecurity

## 📋 Your Production Details

**Domain:** security.accuresecurity.com  
**Database Name:** u879835640_accuresecurity  
**Database User:** u879835640_securitysol  
**Database Password:** ShriMarketing@ppcguru2025  
**Database Size:** 1 MB

---

## ✅ Pre-Deployment Checklist

- [ ] Domain is active: security.accuresecurity.com
- [ ] Hosting account is accessible
- [ ] Database credentials verified
- [ ] FTP/File Manager access available
- [ ] SSL certificate installed (HTTPS)

---

## 📤 Step 1: Upload Files

### Files to Upload to Your Hosting:

Upload these files to your public_html or web root directory:

**Essential Files:**
```
✅ index.html
✅ styles.css
✅ script.js
✅ config.php (already configured with your DB credentials)
✅ Database.php
✅ EmailService.php
✅ submit-quote.php
✅ admin.php
✅ composer.json
```

**DO NOT Upload:**
```
❌ test-email.php (delete after testing)
❌ config.example.php (not needed)
❌ setup.bat (Windows only)
❌ .git folder (if present)
❌ README.md (optional, for documentation only)
❌ QUICKSTART.md (optional)
❌ SYSTEM_OVERVIEW.md (optional)
```

### Upload Methods:

**Option 1: FTP Client (FileZilla)**
1. Connect to your hosting via FTP
2. Navigate to public_html folder
3. Upload all essential files

**Option 2: cPanel File Manager**
1. Login to cPanel
2. Open File Manager
3. Navigate to public_html
4. Click Upload
5. Select and upload all files

**Option 3: ZIP Upload**
1. Zip all essential files
2. Upload ZIP via cPanel File Manager
3. Extract in public_html

---

## 🗄️ Step 2: Setup Database

### Method 1: Import SQL File (Recommended)

1. **Login to cPanel**
2. **Open phpMyAdmin**
3. **Select database:** `u879835640_accuresecurity`
4. **Click "Import" tab**
5. **Choose file:** `database.sql`
6. **Click "Go"**
7. **Verify tables created:**
   - quote_requests
   - email_logs

### Method 2: Manual SQL Execution

If import doesn't work, run this SQL manually:

```sql
USE u879835640_accuresecurity;

-- Create Quote Requests Table
CREATE TABLE IF NOT EXISTS quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255),
    service_type VARCHAR(50) NOT NULL,
    coverage_type VARCHAR(50) NOT NULL,
    location VARCHAR(500) NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('new', 'contacted', 'quoted', 'converted', 'declined') DEFAULT 'new',
    INDEX idx_created_at (created_at),
    INDEX idx_status (status),
    INDEX idx_phone (phone)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Email Logs Table
CREATE TABLE IF NOT EXISTS email_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_request_id INT,
    recipient_email VARCHAR(255) NOT NULL,
    subject VARCHAR(500),
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('sent', 'failed') DEFAULT 'sent',
    error_message TEXT,
    FOREIGN KEY (quote_request_id) REFERENCES quote_requests(id) ON DELETE CASCADE,
    INDEX idx_sent_at (sent_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 📦 Step 3: Install PHP Dependencies

### Via SSH (if available):

```bash
cd public_html
composer install
```

### Via cPanel Terminal:

1. Open Terminal in cPanel
2. Navigate to your directory:
   ```bash
   cd public_html
   ```
3. Install dependencies:
   ```bash
   composer install
   ```

### If Composer is Not Available:

**Option 1: Install Composer on Server**
```bash
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

**Option 2: Upload vendor folder**
1. Run `composer install` locally on your computer
2. Upload the entire `vendor/` folder to your server
3. This folder contains PHPMailer and dependencies

---

## 📧 Step 4: Configure Email Settings

Your `config.php` is already configured with database credentials. Now add Gmail SMTP:

1. **Edit config.php** on your server
2. **Update these lines:**

```php
// SMTP Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com'); // Your Gmail
define('SMTP_PASSWORD', 'xxxx xxxx xxxx xxxx'); // Gmail App Password
define('SMTP_FROM_EMAIL', 'your-email@gmail.com'); // Your Gmail
define('SMTP_FROM_NAME', 'AccureSecurity Website');

// Recipient Email
define('ADMIN_EMAIL', 'shrikaanthshyam@gmail.com');
```

3. **Get Gmail App Password:**
   - Visit: https://myaccount.google.com/security
   - Enable 2-Step Verification
   - Go to App passwords
   - Generate password for "Mail"
   - Copy 16-character password
   - Paste into config.php

---

## 🧪 Step 5: Test Everything

### Test 1: Website Access
```
Visit: https://security.accuresecurity.com
Expected: Website loads correctly
```

### Test 2: Database Connection
```
Visit: https://security.accuresecurity.com/test-email.php
Expected: Shows configuration without errors
```

### Test 3: Email Sending
```
1. Visit: https://security.accuresecurity.com/test-email.php
2. Click "Send Test Email"
3. Check: shrikaanthshyam@gmail.com
Expected: Test email received
```

### Test 4: Form Submission
```
1. Visit: https://security.accuresecurity.com
2. Fill out quote form
3. Submit
Expected: 
  - Success message appears
  - Email received at shrikaanthshyam@gmail.com
  - Data in database (check phpMyAdmin)
```

### Test 5: Admin Dashboard
```
Visit: https://security.accuresecurity.com/admin.php
Login with: admin123 (change this!)
Expected: Dashboard shows submitted quotes
```

---

## 🔐 Step 6: Security Hardening

### 1. Change Admin Password
Edit `admin.php` line 8:
```php
$adminPassword = 'your-strong-password-here';
```

### 2. Delete Test Files
```bash
rm test-email.php
rm config.example.php
rm setup.bat
```

### 3. Protect config.php
Create `.htaccess` file in root:
```apache
<Files "config.php">
    Order Allow,Deny
    Deny from all
</Files>
```

### 4. Enable HTTPS
Ensure SSL certificate is active:
```
https://security.accuresecurity.com
```

### 5. Set File Permissions
```bash
chmod 644 *.php
chmod 644 *.html
chmod 644 *.css
chmod 644 *.js
chmod 755 public_html
```

---

## 🔧 Troubleshooting

### Database Connection Error?

**Check:**
- Database name: `u879835640_accuresecurity`
- Database user: `u879835640_securitysol`
- Database password: `ShriMarketing@ppcguru2025`
- Database host: Usually `localhost` (check with hosting provider)

**Fix:**
1. Verify credentials in cPanel → MySQL Databases
2. Ensure user has ALL PRIVILEGES on database
3. Check if database exists in phpMyAdmin

### Email Not Sending?

**Check:**
- Gmail App Password (not regular password)
- 2-Step Verification enabled
- Correct Gmail in config.php
- PHPMailer installed (vendor folder exists)

**Fix:**
1. Re-generate Gmail App Password
2. Update config.php
3. Test with test-email.php

### Form Not Submitting?

**Check:**
- Browser console for errors (F12)
- submit-quote.php exists
- Database tables created
- PHP version (7.4+ required)

**Fix:**
1. Check Apache error logs in cPanel
2. Verify file permissions
3. Test database connection

### 500 Internal Server Error?

**Check:**
- PHP version compatibility
- File permissions
- .htaccess conflicts
- Error logs in cPanel

**Fix:**
1. Check error_log file
2. Verify PHP version (7.4+)
3. Check file permissions (644 for files, 755 for folders)

---

## 📊 Monitoring & Maintenance

### Daily Checks:
- [ ] Check email inbox for new quotes
- [ ] Review admin dashboard for submissions
- [ ] Monitor database size (1 MB limit)

### Weekly Checks:
- [ ] Backup database via phpMyAdmin
- [ ] Review email logs table
- [ ] Check for spam submissions

### Monthly Checks:
- [ ] Update composer dependencies
- [ ] Review and archive old quotes
- [ ] Check SSL certificate expiry
- [ ] Monitor database size

---

## 💾 Backup Strategy

### Database Backup (Weekly):
1. Login to phpMyAdmin
2. Select `u879835640_accuresecurity`
3. Click "Export"
4. Choose "Quick" export method
5. Download SQL file
6. Store securely

### File Backup (Monthly):
1. Download all files via FTP
2. Store in secure location
3. Include vendor folder

---

## 📈 Post-Launch Checklist

- [ ] Website accessible at https://security.accuresecurity.com
- [ ] SSL certificate active (HTTPS working)
- [ ] Database tables created successfully
- [ ] Form submission working
- [ ] Emails being received at shrikaanthshyam@gmail.com
- [ ] Admin dashboard accessible
- [ ] Admin password changed from default
- [ ] Test files deleted (test-email.php)
- [ ] File permissions set correctly
- [ ] Backup system in place
- [ ] Error logging configured

---

## 🎯 Quick Reference

**Your Production URLs:**
```
Website:    https://security.accuresecurity.com
Admin:      https://security.accuresecurity.com/admin.php
Database:   cPanel → phpMyAdmin → u879835640_accuresecurity
```

**Database Credentials:**
```
Host:     localhost
User:     u879835640_securitysol
Password: ShriMarketing@ppcguru2025
Database: u879835640_accuresecurity
```

**Email Notifications:**
```
Sent to: shrikaanthshyam@gmail.com
```

---

## 📞 Support

If you need assistance:
- Email: shrikaanthshyam@gmail.com
- Phone: +1 (905) 399-9333

---

## ✅ Deployment Complete!

Once all steps are completed:
1. ✅ Files uploaded
2. ✅ Database configured
3. ✅ Dependencies installed
4. ✅ Email configured
5. ✅ Everything tested
6. ✅ Security hardened

**Your AccureSecurity quote system is LIVE! 🎉**

Visit: **https://security.accuresecurity.com**
