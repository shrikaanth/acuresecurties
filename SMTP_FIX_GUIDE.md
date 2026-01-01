# SMTP Error Fix - Quick Reference

## 🔴 Problem Identified

**Error:** `SMTP Error: Could not authenticate`

**Root Cause:** The `SMTP_FROM_EMAIL` was set to `hr@accuresecurity.com` but the `SMTP_USERNAME` was `formsumbission@accuresecurity.com`. These must match for SMTP authentication to work.

## ✅ Solution Applied

### Changed Configuration
```php
// BEFORE (WRONG)
define('SMTP_USERNAME', 'formsumbission@accuresecurity.com');
define('SMTP_FROM_EMAIL', 'hr@accuresecurity.com'); // ❌ Mismatch!

// AFTER (CORRECT)
define('SMTP_USERNAME', 'formsumbission@accuresecurity.com');
define('SMTP_FROM_EMAIL', 'formsumbission@accuresecurity.com'); // ✅ Match!
```

### Key Rule
**The FROM email address MUST match the SMTP username for authentication to succeed.**

## 🧪 Testing Instructions

### Option 1: Use Test Script (Recommended)
1. Navigate to: `http://your-domain.com/accuresecuritysolution/test-smtp.php`
2. The script will:
   - Display your current configuration
   - Test the SMTP connection
   - Send a test email to both recipients
   - Show detailed debug output
   - Provide troubleshooting tips if it fails

### Option 2: Test via Form
1. Go to your website's quote form
2. Fill out and submit the form
3. Check both email inboxes:
   - `hr@accuresecurity.com`
   - `shrikaanthshyam@gmail.com`

## 📧 Current Email Flow

```
Form Submission
    ↓
Authenticate with: formsumbission@accuresecurity.com
    ↓
Send FROM: formsumbission@accuresecurity.com
    ↓
Send TO: hr@accuresecurity.com
    ↓
Send CC: shrikaanthshyam@gmail.com
```

## 🔧 Additional Fixes Applied

1. **SSL Options Added** - Better compatibility with Hostinger's SSL certificates
2. **Debug Logging** - SMTP errors are now logged to PHP error log
3. **Dual Recipients** - Both emails receive notifications via CC

## 📋 Complete Configuration

```php
// SMTP Settings
SMTP_HOST: smtp.hostinger.com
SMTP_PORT: 465
SMTP_USERNAME: formsumbission@accuresecurity.com
SMTP_PASSWORD: ShriMarketing@ppcguru2025
SMTP_FROM_EMAIL: formsumbission@accuresecurity.com
SMTP_FROM_NAME: AccureSecurity Website

// Recipients
ADMIN_EMAIL: hr@accuresecurity.com
ADMIN_EMAIL_CC: shrikaanthshyam@gmail.com
```

## 🔍 If Still Not Working

### Check These Common Issues:

1. **Email Account Active?**
   - Log into Hostinger control panel
   - Verify `formsumbission@accuresecurity.com` exists and is active

2. **SMTP Enabled?**
   - In Hostinger, check if SMTP is enabled for this email account
   - Some hosts require you to enable SMTP separately

3. **Password Correct?**
   - Verify the password is correct
   - Try logging into webmail with the same credentials

4. **Port Not Blocked?**
   - Check if your hosting provider blocks port 465
   - Try port 587 with STARTTLS if 465 doesn't work

5. **Server PHP Extensions?**
   - Ensure `openssl` extension is enabled
   - Check `phpinfo()` for SSL support

### Alternative Port Configuration (if 465 fails)

If port 465 doesn't work, try port 587:

```php
define('SMTP_PORT', 587);

// In EmailService.php, change:
$this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
```

## 📞 Hostinger Support

If issues persist, contact Hostinger support with:
- Email account: `formsumbission@accuresecurity.com`
- Issue: "Cannot authenticate SMTP on port 465"
- Ask them to verify SMTP is enabled and credentials are correct

## 🔒 Security Reminder

**After testing, delete `test-smtp.php` from your server!**

This file contains sensitive debugging information and should not be publicly accessible.

---

**Last Updated:** December 31, 2025
**Status:** Configuration fixed, ready for testing
