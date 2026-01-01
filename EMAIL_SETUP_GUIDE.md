# Email Configuration Setup Guide

## ✅ Configuration Complete

Your email system has been configured to use **Hostinger SMTP** with the email address `hr@accuresecurity.com`.

## 📋 Current Settings

### SMTP Configuration (Hostinger)
- **Host:** smtp.hostinger.com
- **Port:** 465
- **Encryption:** SSL
- **Username:** hr@accuresecurity.com
- **From Email:** hr@accuresecurity.com

### Email Recipients (Dual Notification)
- **Primary Recipient:** hr@accuresecurity.com
- **CC Recipient:** shrikaanthshyam@gmail.com

**Both email addresses will receive notifications when someone submits a quote request!**

## 🔧 Final Step Required

You need to add your email password to the configuration file:

1. Open `config.php`
2. Find line 12: `define('SMTP_PASSWORD', 'YOUR_EMAIL_PASSWORD');`
3. Replace `YOUR_EMAIL_PASSWORD` with the actual password for `hr@accuresecurity.com`

**Example:**
```php
define('SMTP_PASSWORD', 'your_actual_password_here');
```

## 🔒 Security Recommendations

1. **Never commit passwords to Git** - Make sure `config.php` is in your `.gitignore` file
2. **Use strong passwords** - Ensure your email password is secure
3. **Enable 2FA** - If Hostinger supports it, enable two-factor authentication
4. **Consider using environment variables** - For production, store sensitive data in environment variables

## 📧 How It Works

When someone fills out the quote form on your website:

1. ✅ Form data is validated and sanitized
2. ✅ Quote request is saved to the database
3. ✅ Email notification is sent to **both** `hr@accuresecurity.com` and `shrikaanthshyam@gmail.com` via Hostinger SMTP
4. ✅ Email delivery status is logged in the database
5. ✅ User receives confirmation

## 🧪 Testing the Email

After adding your password, you can test the email functionality:

1. Go to your website's quote form
2. Fill out all required fields
3. Submit the form
4. Check **both** `hr@accuresecurity.com` and `shrikaanthshyam@gmail.com` inboxes for the notification email

## 📊 Email Template Features

The notification email includes:
- 👤 Customer's full name
- 📞 Phone number (clickable)
- 📧 Email address (clickable)
- 🏢 Service type (Commercial/Residential/Both)
- 🕐 Coverage type (Day/Night/24×7/Mobile Patrol)
- 📍 Location
- 📝 Additional notes
- ⏰ Submission timestamp
- 🌐 IP address

## 🔍 Troubleshooting

### Email Not Sending?

1. **Check password** - Ensure the password in `config.php` is correct
2. **Check Hostinger settings** - Verify SMTP is enabled for your email account
3. **Check error logs** - Look in your PHP error logs for detailed error messages
4. **Test SMTP connection** - Use a tool like Telnet to verify SMTP connectivity
5. **Check firewall** - Ensure port 465 is not blocked

### Common Issues

**"SMTP connect() failed"**
- Check if your server can connect to smtp.hostinger.com on port 465
- Verify your hosting provider allows outbound SMTP connections

**"Authentication failed"**
- Double-check the email address and password
- Ensure the email account is active in Hostinger

**"Could not instantiate mail function"**
- Make sure PHPMailer is installed via Composer
- Run: `composer require phpmailer/phpmailer`

## 📁 Related Files

- `config.php` - Main configuration file (contains SMTP settings)
- `EmailService.php` - Email service class (handles email sending)
- `submit-quote.php` - Form submission handler
- `Database.php` - Database operations

## 🆘 Need Help?

If you encounter any issues:
1. Check the PHP error logs
2. Review the email_logs table in your database
3. Verify all Hostinger SMTP settings are correct
4. Contact Hostinger support if SMTP issues persist

---

**Last Updated:** December 31, 2025
**Email System:** Hostinger SMTP
**Recipients:** hr@accuresecurity.com, shrikaanthshyam@gmail.com
