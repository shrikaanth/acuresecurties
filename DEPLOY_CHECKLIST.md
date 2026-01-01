# ✅ Production Deployment Checklist
## security.accuresecurity.com

---

## 📤 UPLOAD FILES

Upload these files to your hosting (public_html):

- [ ] index.html
- [ ] styles.css
- [ ] script.js
- [ ] config.php ✅ (Already configured with your DB)
- [ ] Database.php
- [ ] EmailService.php
- [ ] submit-quote.php
- [ ] admin.php
- [ ] composer.json

---

## 🗄️ SETUP DATABASE

- [ ] Login to cPanel
- [ ] Open phpMyAdmin
- [ ] Select database: `u879835640_accuresecurity`
- [ ] Click "Import"
- [ ] Upload: `database.sql`
- [ ] Click "Go"
- [ ] Verify tables created:
  - [ ] quote_requests
  - [ ] email_logs

---

## 📦 INSTALL DEPENDENCIES

**Option 1: SSH/Terminal**
```bash
cd public_html
composer install
```

**Option 2: Upload vendor folder**
- [ ] Run `composer install` on local computer
- [ ] Upload entire `vendor/` folder to server

---

## 📧 CONFIGURE EMAIL

Edit `config.php` on server:

- [ ] Get Gmail App Password from: https://myaccount.google.com/security
- [ ] Update SMTP_USERNAME with your Gmail
- [ ] Update SMTP_PASSWORD with App Password
- [ ] Update SMTP_FROM_EMAIL with your Gmail
- [ ] Save file

---

## 🧪 TEST EVERYTHING

- [ ] Visit: https://security.accuresecurity.com
  - Website loads correctly
  
- [ ] Visit: https://security.accuresecurity.com/test-email.php
  - Send test email
  - Check shrikaanthshyam@gmail.com
  
- [ ] Submit quote form on website
  - Fill all fields
  - Click "Request Quote"
  - See success message
  - Check email received
  - Check database in phpMyAdmin
  
- [ ] Visit: https://security.accuresecurity.com/admin.php
  - Login with: admin123
  - See submitted quote
  - Verify all data displays

---

## 🔐 SECURITY

- [ ] Change admin password in admin.php
- [ ] Delete test-email.php from server
- [ ] Verify HTTPS is working
- [ ] Set file permissions (644 for files)

---

## ✅ FINAL VERIFICATION

- [ ] Website: https://security.accuresecurity.com ✓
- [ ] Form submissions working ✓
- [ ] Emails arriving at shrikaanthshyam@gmail.com ✓
- [ ] Admin dashboard accessible ✓
- [ ] Database storing data ✓
- [ ] SSL certificate active (HTTPS) ✓

---

## 🎯 QUICK REFERENCE

**Database:**
- Host: localhost
- User: u879835640_securitysol
- Pass: ShriMarketing@ppcguru2025
- Name: u879835640_accuresecurity

**URLs:**
- Website: https://security.accuresecurity.com
- Admin: https://security.accuresecurity.com/admin.php
- Email: shrikaanthshyam@gmail.com

---

## 📞 SUPPORT

Need help? Contact:
- Email: shrikaanthshyam@gmail.com
- Phone: +1 (905) 399-9333

---

**Date Deployed:** _______________

**Deployed By:** _______________

**Status:** [ ] Complete  [ ] In Progress  [ ] Issues

**Notes:** _________________________________

_________________________________________

_________________________________________

---

## 🎉 READY TO GO LIVE!

Once all checkboxes are complete, your system is LIVE! ✅
