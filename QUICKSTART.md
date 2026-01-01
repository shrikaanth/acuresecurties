# 🚀 Quick Start Guide - AccureSecurity

## ⚡ Fast Setup (5 Minutes)

### 1️⃣ Install XAMPP
- Download from: https://www.apachefriends.org/
- Install and start **Apache** and **MySQL**

### 2️⃣ Setup Database
```
1. Open: http://localhost/phpmyadmin
2. Click "New" to create database
3. Name it: accuresecurity_db
4. Click "Import" tab
5. Choose file: database.sql
6. Click "Go"
```

### 3️⃣ Install Dependencies
Open terminal in project folder:
```bash
composer install
```

### 4️⃣ Configure Email
1. **Get Gmail App Password:**
   - Visit: https://myaccount.google.com/security
   - Enable "2-Step Verification"
   - Go to "App passwords"
   - Select "Mail" → Generate
   - Copy the 16-character password

2. **Update config.php:**
   ```php
   define('SMTP_USERNAME', 'your-email@gmail.com');
   define('SMTP_PASSWORD', 'xxxx xxxx xxxx xxxx'); // App Password
   define('SMTP_FROM_EMAIL', 'your-email@gmail.com');
   ```

### 5️⃣ Test Email
1. Copy project to: `C:\xampp\htdocs\accuresecurity\`
2. Visit: `http://localhost/accuresecurity/test-email.php`
3. Click "Send Test Email"
4. Check inbox: `shrikaanthshyam@gmail.com`

### 6️⃣ Go Live!
Visit: `http://localhost/accuresecurity/`

---

## 📧 What Happens When Form is Submitted?

1. ✅ User fills quote form on website
2. ✅ Data saved to MySQL database
3. ✅ Email sent to: **shrikaanthshyam@gmail.com**
4. ✅ Email includes all form details
5. ✅ User sees success message

---

## 🎯 Email Template Preview

You'll receive emails like this:

**Subject:** New Quote Request - AccureSecurity

**Content:**
- 👤 Customer Name
- 📞 Phone Number
- 📧 Email Address
- 🏢 Service Type (Commercial/Residential)
- 🕐 Coverage Type (Day/Night/24x7)
- 📍 Location
- 📝 Additional Notes
- ⏰ Submission Time
- 🌐 IP Address

---

## ❗ Troubleshooting

### Email Not Working?
```
✓ Check: Using App Password (not regular password)
✓ Check: 2-Step Verification enabled
✓ Check: Correct Gmail address in config.php
✓ Test: Run test-email.php
```

### Database Error?
```
✓ Check: MySQL running in XAMPP
✓ Check: Database name is 'accuresecurity_db'
✓ Check: Tables created (run database.sql)
✓ Check: Credentials in config.php
```

### Form Not Submitting?
```
✓ Check: Apache running in XAMPP
✓ Check: Files in htdocs folder
✓ Check: Browser console for errors (F12)
✓ Check: submit-quote.php exists
```

---

## 📁 File Checklist

Make sure you have:
- ✅ index.html
- ✅ styles.css
- ✅ script.js
- ✅ config.php (configured)
- ✅ Database.php
- ✅ EmailService.php
- ✅ submit-quote.php
- ✅ composer.json
- ✅ vendor/ (after composer install)

---

## 🔒 Security Tips

1. **Never share config.php** - Contains sensitive passwords
2. **Delete test-email.php** after testing
3. **Use HTTPS** in production
4. **Keep dependencies updated**: `composer update`

---

## 📞 Need Help?

Email: shrikaanthshyam@gmail.com
Phone: +1 (905) 399-9333

---

## ✅ Success Checklist

- [ ] XAMPP installed and running
- [ ] Database created and imported
- [ ] Composer dependencies installed
- [ ] config.php updated with Gmail credentials
- [ ] Test email sent successfully
- [ ] Website accessible at localhost
- [ ] Form submission working
- [ ] Email received at shrikaanthshyam@gmail.com

**All checked? You're ready to go! 🎉**
