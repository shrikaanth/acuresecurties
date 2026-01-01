# Form Setup Verification Guide

## ✅ What Has Been Done

### 1. Updated `submit-quote.php`
- Modified to handle **both** simple contact forms and detailed quote forms
- Simple forms only require: `fullName` and `phone`
- Optional fields: `email` and `message`
- The script automatically detects which type of form is being submitted

### 2. Forms on Your Website
You now have **3 working forms**:

#### a) Hero Form (Top of page)
- Location: Inside the hero section
- Fields: Full Name, Email, Mobile Number, Message
- ID: `heroQuoteForm`

#### b) Contact Form (Before Footer)
- Location: Just before the footer
- Fields: Full Name, Email, Mobile Number, Message
- ID: `contactForm`

#### c) Main Quote Form (if exists)
- Detailed quote form with service type, coverage type, location

## 🔧 How to Test

### Option 1: Use the Test Page
1. Open your browser
2. Navigate to: `http://localhost/accuresecuritysolution/test-form.html`
   OR `https://yourdomain.com/test-form.html`
3. Fill out the form with test data:
   - Full Name: Test User
   - Email: test@example.com
   - Phone: 123-456-7890
   - Message: This is a test
4. Click "Submit Test"
5. You should see a success message with a Quote ID

### Option 2: Test on the Main Website
1. Open `index.html` in your browser
2. Scroll to the hero section OR the contact form before footer
3. Fill out any of the forms
4. Submit and check for the success modal

## 📊 What Happens When Form is Submitted

1. **Data Validation**: Checks required fields
2. **Database Storage**: Saves to `quote_requests` table
3. **Email Notification**: Sends email to:
   - Primary: hr@accuresecurity.com
   - CC: shrikaanthshyam@gmail.com
4. **Email Logging**: Logs email status in `email_logs` table
5. **Success Response**: Shows modal or success message

## 🗄️ Database Tables Required

### Table: `quote_requests`
```sql
CREATE TABLE IF NOT EXISTS quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255),
    service_type VARCHAR(100),
    coverage_type VARCHAR(100),
    location VARCHAR(255),
    notes TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Table: `email_logs`
```sql
CREATE TABLE IF NOT EXISTS email_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_request_id INT,
    recipient_email VARCHAR(255),
    subject VARCHAR(255),
    status VARCHAR(50),
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quote_request_id) REFERENCES quote_requests(id)
);
```

## 🔍 Troubleshooting

### If Forms Don't Submit:

1. **Check Browser Console** (F12)
   - Look for JavaScript errors
   - Check Network tab for failed requests

2. **Check PHP Error Logs**
   - Location: Usually in your hosting control panel
   - Or check: `/var/log/apache2/error.log` (Linux)

3. **Verify Database Connection**
   - Check `config.php` credentials
   - Ensure database exists
   - Ensure tables are created

4. **Test Email Settings**
   - Run: `php test-email.php` (if exists)
   - Check SMTP credentials in `config.php`

### Common Issues:

**Issue**: "Missing required field" error
- **Solution**: Ensure form fields have correct `name` attributes

**Issue**: Email not sending but data saves
- **Solution**: Check SMTP settings in `config.php`
- Verify email password is correct

**Issue**: Database connection error
- **Solution**: Verify DB credentials in `config.php`
- Ensure MySQL is running

## 📧 Email Configuration

Current settings (from `config.php`):
- **SMTP Host**: smtp.hostinger.com
- **SMTP Port**: 465 (SSL)
- **From Email**: formsumbission@accuresecurity.com
- **Recipients**: 
  - hr@accuresecurity.com
  - shrikaanthshyam@gmail.com (CC)

## ✨ Features Implemented

✅ Form validation (client-side and server-side)
✅ Loading states on submit buttons
✅ Success modal popup
✅ Error handling with user-friendly messages
✅ Database storage of all submissions
✅ Email notifications to multiple recipients
✅ Email logging for tracking
✅ IP address and user agent tracking
✅ Support for both simple and detailed forms
✅ Responsive design
✅ Google Tag Manager integration

## 🚀 Next Steps

1. **Test the forms** using the test page or main website
2. **Check your email** (hr@accuresecurity.com) for notifications
3. **Verify database** entries in phpMyAdmin or similar tool
4. **Remove test-form.html** after testing (for security)

## 📞 Support

If you encounter any issues:
1. Check the browser console for errors
2. Check PHP error logs
3. Verify all configuration settings
4. Test with simple data first

---

**Last Updated**: 2026-01-01
**Status**: ✅ Ready for Testing
