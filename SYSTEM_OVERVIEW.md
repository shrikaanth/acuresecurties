# 📊 AccureSecurity - System Overview

## ✅ What Has Been Created

### 🎨 Frontend Files
- **index.html** - Main website with quote form
- **styles.css** - Professional styling
- **script.js** - Form handling with API integration

### ⚙️ Backend Files
- **submit-quote.php** - API endpoint for form submissions
- **Database.php** - Database connection and operations
- **EmailService.php** - SMTP email handling with PHPMailer
- **config.php** - Configuration settings (needs your Gmail credentials)

### 🗄️ Database
- **database.sql** - MySQL schema with 2 tables:
  - `quote_requests` - Stores all form submissions
  - `email_logs` - Tracks email delivery status

### 🛠️ Utility Files
- **admin.php** - Dashboard to view all quote requests
- **test-email.php** - Email configuration testing tool
- **setup.bat** - Automated setup script for Windows
- **composer.json** - PHP dependency management

### 📚 Documentation
- **README.md** - Complete setup guide
- **QUICKSTART.md** - Fast 5-minute setup
- **config.example.php** - Configuration template

### 🔒 Security
- **.gitignore** - Protects sensitive files from Git

---

## 🔄 How It Works

### User Journey:
1. User visits website
2. Fills out quote request form
3. Clicks "Request Quote"
4. Form data is validated
5. Data saved to MySQL database
6. Email sent to: **shrikaanthshyam@gmail.com**
7. Success message shown to user

### Email Notification Contains:
- ✅ Full Name
- ✅ Phone Number
- ✅ Email Address (if provided)
- ✅ Service Type (Commercial/Residential/Both)
- ✅ Coverage Type (Day/Night/24×7/Mobile Patrol)
- ✅ Location
- ✅ Additional Notes
- ✅ Submission Timestamp
- ✅ IP Address

---

## 📁 Complete File Structure

```
accuresecuritysolution/
├── Frontend
│   ├── index.html              # Main website
│   ├── styles.css              # Styling
│   └── script.js               # JavaScript
│
├── Backend
│   ├── submit-quote.php        # Form API endpoint
│   ├── Database.php            # Database class
│   ├── EmailService.php        # Email service
│   └── config.php              # Configuration ⚠️ NEEDS SETUP
│
├── Database
│   └── database.sql            # MySQL schema
│
├── Admin Tools
│   ├── admin.php               # Quote dashboard
│   └── test-email.php          # Email tester
│
├── Setup
│   ├── setup.bat               # Windows setup script
│   ├── composer.json           # Dependencies
│   └── config.example.php      # Config template
│
├── Documentation
│   ├── README.md               # Full guide
│   ├── QUICKSTART.md           # Quick setup
│   └── SYSTEM_OVERVIEW.md      # This file
│
└── Security
    └── .gitignore              # Git exclusions
```

---

## 🚀 Quick Setup Steps

### 1. Install XAMPP
```
Download: https://www.apachefriends.org/
Start: Apache + MySQL
```

### 2. Create Database
```
Open: http://localhost/phpmyadmin
Import: database.sql
```

### 3. Install Dependencies
```bash
composer install
```

### 4. Configure Email
```
Edit: config.php
Add: Gmail credentials
Get App Password: https://myaccount.google.com/security
```

### 5. Test
```
Visit: http://localhost/accuresecurity/test-email.php
Send test email
Check: shrikaanthshyam@gmail.com
```

---

## 🎯 Access Points

After setup, you can access:

| URL | Purpose |
|-----|---------|
| `http://localhost/accuresecurity/` | Main website |
| `http://localhost/accuresecurity/admin.php` | Admin dashboard |
| `http://localhost/accuresecurity/test-email.php` | Email tester |
| `http://localhost/phpmyadmin` | Database management |

---

## 🔐 Admin Dashboard

**URL:** `http://localhost/accuresecurity/admin.php`

**Default Password:** `admin123` ⚠️ CHANGE THIS!

**Features:**
- View all quote requests
- See statistics (total, today, this week)
- Contact information with click-to-call/email
- Submission timestamps
- Customer notes

**To Change Password:**
Edit `admin.php` line 8:
```php
$adminPassword = 'your-new-password';
```

---

## 📧 Email Configuration

### Required Settings (in config.php):

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_FROM_EMAIL', 'your-email@gmail.com');
define('ADMIN_EMAIL', 'shrikaanthshyam@gmail.com');
```

### Getting Gmail App Password:

1. Go to: https://myaccount.google.com/security
2. Enable "2-Step Verification"
3. Click "App passwords"
4. Select "Mail" and your device
5. Copy the 16-character password
6. Paste into `config.php`

---

## 🗄️ Database Tables

### quote_requests
Stores all form submissions:
- `id` - Unique identifier
- `full_name` - Customer name
- `phone` - Contact number
- `email` - Email address (optional)
- `service_type` - Commercial/Residential/Both
- `coverage_type` - Day/Night/24×7/Mobile Patrol
- `location` - Service location
- `notes` - Additional information
- `created_at` - Submission timestamp
- `ip_address` - User IP
- `user_agent` - Browser info
- `status` - Request status

### email_logs
Tracks email delivery:
- `id` - Log identifier
- `quote_request_id` - Related quote
- `recipient_email` - Email sent to
- `subject` - Email subject
- `sent_at` - Send timestamp
- `status` - Sent/Failed
- `error_message` - Error details (if failed)

---

## ✅ Testing Checklist

Before going live, verify:

- [ ] XAMPP Apache running
- [ ] XAMPP MySQL running
- [ ] Database `accuresecurity_db` created
- [ ] Tables created from `database.sql`
- [ ] Composer dependencies installed
- [ ] `config.php` updated with Gmail credentials
- [ ] Test email sent successfully
- [ ] Email received at shrikaanthshyam@gmail.com
- [ ] Website loads at localhost
- [ ] Form submission works
- [ ] Data appears in database
- [ ] Admin dashboard accessible
- [ ] Admin password changed from default

---

## 🛡️ Security Recommendations

### For Development:
- ✅ Keep config.php out of Git
- ✅ Use .gitignore
- ✅ Change admin password

### For Production:
- ⚠️ Use HTTPS (SSL certificate)
- ⚠️ Use environment variables for config
- ⚠️ Implement proper admin authentication
- ⚠️ Add rate limiting to form
- ⚠️ Enable CSRF protection
- ⚠️ Sanitize all inputs
- ⚠️ Use prepared statements (already done)
- ⚠️ Regular backups
- ⚠️ Update dependencies regularly
- ⚠️ Delete test-email.php

---

## 📞 Support

**Email:** shrikaanthshyam@gmail.com  
**Phone:** +1 (905) 399-9333

---

## 🎉 You're All Set!

Your AccureSecurity quote system is ready to:
- ✅ Collect quote requests
- ✅ Store them in database
- ✅ Send email notifications
- ✅ Track submissions
- ✅ Manage requests via admin panel

**Happy quoting! 🛡️**
