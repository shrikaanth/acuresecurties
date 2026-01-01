# ✅ Installation Checklist - AccureSecurity

Use this checklist to ensure proper setup of your quote system.

---

## 📋 Pre-Installation

- [ ] Downloaded and installed XAMPP
- [ ] XAMPP Apache service is running
- [ ] XAMPP MySQL service is running
- [ ] Composer is installed on your system
- [ ] You have a Gmail account for sending emails
- [ ] You have access to phpMyAdmin

---

## 🗄️ Database Setup

- [ ] Opened phpMyAdmin at `http://localhost/phpmyadmin`
- [ ] Created new database named `accuresecurity_db`
- [ ] Imported `database.sql` file successfully
- [ ] Verified tables exist:
  - [ ] `quote_requests` table created
  - [ ] `email_logs` table created
- [ ] Database connection credentials noted:
  - Host: `localhost`
  - User: `root`
  - Password: (empty by default)
  - Database: `accuresecurity_db`

---

## 📦 Dependencies Installation

- [ ] Opened terminal/command prompt in project folder
- [ ] Ran command: `composer install`
- [ ] Installation completed without errors
- [ ] `vendor/` folder created
- [ ] PHPMailer installed successfully

---

## 📧 Email Configuration

### Gmail App Password Setup
- [ ] Visited Google Account Security: https://myaccount.google.com/security
- [ ] Enabled 2-Step Verification
- [ ] Navigated to "App passwords"
- [ ] Generated new App Password for "Mail"
- [ ] Copied 16-character App Password

### Config File Update
- [ ] Opened `config.php` file
- [ ] Updated `SMTP_USERNAME` with your Gmail address
- [ ] Updated `SMTP_PASSWORD` with App Password (16 chars)
- [ ] Updated `SMTP_FROM_EMAIL` with your Gmail address
- [ ] Verified `ADMIN_EMAIL` is set to: `shrikaanthshyam@gmail.com`
- [ ] Saved `config.php` file

---

## 🌐 Web Server Setup

- [ ] Copied project folder to: `C:\xampp\htdocs\accuresecurity\`
- [ ] All files copied successfully
- [ ] File permissions are correct
- [ ] Apache can access the files

---

## 🧪 Testing Phase

### Email Test
- [ ] Visited: `http://localhost/accuresecurity/test-email.php`
- [ ] Clicked "Send Test Email" button
- [ ] Received success message
- [ ] Checked inbox at `shrikaanthshyam@gmail.com`
- [ ] Test email received successfully
- [ ] Email formatting looks correct

### Website Test
- [ ] Visited: `http://localhost/accuresecurity/`
- [ ] Website loads without errors
- [ ] All sections display correctly
- [ ] Navigation works properly
- [ ] Quote form is visible

### Form Submission Test
- [ ] Filled out quote form with test data:
  - [ ] Full Name: (test name)
  - [ ] Phone: (test phone)
  - [ ] Email: (test email)
  - [ ] Service Type: (selected)
  - [ ] Coverage Type: (selected)
  - [ ] Location: (test location)
  - [ ] Notes: (test notes)
- [ ] Clicked "Request Quote" button
- [ ] Saw "Submitting..." loading state
- [ ] Received success modal/message
- [ ] Form was reset after submission

### Database Verification
- [ ] Opened phpMyAdmin
- [ ] Navigated to `accuresecurity_db` database
- [ ] Checked `quote_requests` table
- [ ] Test submission appears in table
- [ ] All data fields are correct
- [ ] Timestamp is accurate

### Email Notification Test
- [ ] Checked email at `shrikaanthshyam@gmail.com`
- [ ] Quote notification email received
- [ ] Email contains all form data:
  - [ ] Customer name
  - [ ] Phone number
  - [ ] Email address
  - [ ] Service type
  - [ ] Coverage type
  - [ ] Location
  - [ ] Notes
  - [ ] Timestamp
  - [ ] IP address
- [ ] Email formatting is professional
- [ ] All links work (phone, email)

### Admin Dashboard Test
- [ ] Visited: `http://localhost/accuresecurity/admin.php`
- [ ] Login page appears
- [ ] Entered password: `admin123`
- [ ] Successfully logged in
- [ ] Dashboard displays correctly
- [ ] Statistics show correct numbers:
  - [ ] Total quotes
  - [ ] Today's quotes
  - [ ] This week's quotes
- [ ] Test quote appears in list
- [ ] All quote details are visible
- [ ] Click-to-call phone links work
- [ ] Click-to-email links work

---

## 🔐 Security Configuration

- [ ] Changed admin password in `admin.php` from `admin123`
- [ ] New password is strong and secure
- [ ] Verified `config.php` is in `.gitignore`
- [ ] Confirmed sensitive files won't be committed to Git
- [ ] Considered deleting `test-email.php` after testing

---

## 🎯 Final Verification

- [ ] Website is fully functional
- [ ] Form submissions work correctly
- [ ] Database stores data properly
- [ ] Emails are sent successfully
- [ ] Admin dashboard is accessible
- [ ] No console errors in browser (F12)
- [ ] No PHP errors in Apache logs
- [ ] All features tested and working

---

## 📝 Post-Installation Notes

### Important Information to Remember:

**Admin Dashboard:**
- URL: `http://localhost/accuresecurity/admin.php`
- Password: _________________ (write your new password)

**Database:**
- Name: `accuresecurity_db`
- Access: `http://localhost/phpmyadmin`

**Email:**
- Notifications sent to: `shrikaanthshyam@gmail.com`
- Sent from: _________________ (your Gmail)

**Files to Protect:**
- `config.php` - Contains sensitive credentials
- Never commit to Git or share publicly

**Files to Delete (After Testing):**
- `test-email.php` - Remove for security
- `config.example.php` - Optional, keep as reference

---

## 🚀 Ready for Production?

Before deploying to a live server:

- [ ] Purchased domain name
- [ ] Obtained SSL certificate (HTTPS)
- [ ] Updated config.php with production database credentials
- [ ] Changed all default passwords
- [ ] Tested on production server
- [ ] Implemented rate limiting on form
- [ ] Added CAPTCHA to prevent spam
- [ ] Set up regular database backups
- [ ] Configured error logging
- [ ] Removed all test files
- [ ] Updated README with production URLs

---

## ❓ Troubleshooting

If something doesn't work, check:

1. **XAMPP Services**
   - [ ] Apache is running (green in XAMPP)
   - [ ] MySQL is running (green in XAMPP)

2. **Database**
   - [ ] Database exists in phpMyAdmin
   - [ ] Tables are created
   - [ ] Credentials in config.php are correct

3. **Email**
   - [ ] Using App Password (not regular password)
   - [ ] 2-Step Verification enabled on Gmail
   - [ ] Correct Gmail address in config.php
   - [ ] No spaces in App Password

4. **Files**
   - [ ] All files in correct location
   - [ ] vendor/ folder exists
   - [ ] No file permission issues

5. **Browser**
   - [ ] Clear cache and reload
   - [ ] Check console for errors (F12)
   - [ ] Try different browser

---

## 📞 Need Help?

If you encounter issues:

1. Check the documentation:
   - `README.md` - Full setup guide
   - `QUICKSTART.md` - Quick reference
   - `SYSTEM_OVERVIEW.md` - System details

2. Contact support:
   - Email: shrikaanthshyam@gmail.com
   - Phone: +1 (905) 399-9333

---

## ✅ Installation Complete!

Date Completed: _______________

Installed By: _______________

Notes: _______________________________________________

____________________________________________________

____________________________________________________

**Congratulations! Your AccureSecurity quote system is ready to use! 🎉**
