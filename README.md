# AccureSecurity Website

Professional security guard services website for commercial and residential properties in Toronto & the GTA.

## 🌟 Features

- **Responsive Design**: Mobile-first, fully responsive layout
- **Contact Forms**: Multiple contact forms with backend integration
- **Email Notifications**: Automated email notifications for form submissions
- **Database Integration**: MySQL database for storing quote requests
- **Google Tag Manager**: Integrated analytics tracking
- **Modern UI/UX**: Clean, professional design with smooth animations

## 🚀 Quick Start

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (for PHPMailer dependencies)
- Web server (Apache/Nginx)

### Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd accuresecuritysolution
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure database**
   - Create a MySQL database
   - Import the database schema:
     ```bash
     mysql -u your_user -p your_database < database.sql
     ```

4. **Set up configuration**
   - Copy `config.example.php` to `config.php`
   - Update database credentials
   - Update SMTP email settings
   ```bash
   cp config.example.php config.php
   ```

5. **Configure your web server**
   - Point document root to the project directory
   - Ensure PHP is enabled

## 📋 Configuration

Edit `config.php` with your settings:

### Database Settings
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
define('DB_NAME', 'your_database_name');
```

### SMTP Email Settings
```php
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'your-email@domain.com');
define('SMTP_PASSWORD', 'your-email-password');
```

### Admin Email Recipients
```php
define('ADMIN_EMAIL', 'hr@accuresecurity.com');
define('ADMIN_EMAIL_CC', 'additional@email.com');
```

## 📁 Project Structure

```
accuresecuritysolution/
├── index.html              # Main website page
├── styles.css              # Main stylesheet
├── script.js               # JavaScript functionality
├── submit-quote.php        # Form submission handler
├── Database.php            # Database class
├── EmailService.php        # Email service class
├── config.php              # Configuration (not in Git)
├── config.example.php      # Configuration template
├── database.sql            # Database schema
├── vendor/                 # Composer dependencies
└── README.md              # This file
```

## 🔧 Testing

### Verify Setup
Run the verification script to check if everything is configured correctly:
```
http://yourdomain.com/verify-setup.php
```

### Test Forms
Use the test form to verify form submission:
```
http://yourdomain.com/test-form.html
```

**Important**: Remove these test files in production!

## 📧 Email System

The website uses PHPMailer to send email notifications when forms are submitted.

- All form submissions are saved to the database
- Email notifications are sent to configured recipients
- Email logs are stored for tracking

## 🗄️ Database Tables

### `quote_requests`
Stores all form submissions with:
- Contact information (name, phone, email)
- Service details
- Timestamp and tracking data

### `email_logs`
Tracks all email notifications:
- Recipient information
- Send status
- Error messages (if any)

## 🎨 Customization

### Colors
Main brand colors are defined in `styles.css`:
```css
--primary-color: #c31e26;
--primary-dark: #9a1820;
--primary-light: #d83b42;
```

### Forms
Three contact forms are available:
1. Hero form (top of page)
2. Contact form (before footer)
3. Custom quote forms (if needed)

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## 🔒 Security

- Sensitive files excluded via `.gitignore`
- SQL injection protection via prepared statements
- Input validation and sanitization
- CSRF protection recommended for production

## 📚 Documentation

Additional documentation available:
- `FORM_SETUP_GUIDE.md` - Form system setup and troubleshooting
- `EMAIL_SETUP_GUIDE.md` - Email configuration guide
- `SMTP_FIX_GUIDE.md` - SMTP troubleshooting

## 🚀 Deployment

### Production Checklist

- [ ] Update `config.php` with production credentials
- [ ] Remove test files (`test-*.php`, `verify-setup.php`)
- [ ] Enable HTTPS/SSL
- [ ] Set up database backups
- [ ] Configure error logging
- [ ] Test all forms
- [ ] Verify email delivery
- [ ] Set up monitoring

## 📞 Support

For issues or questions:
- Check documentation files
- Review error logs
- Verify configuration settings

## 📄 License

Copyright © 2024 AccureSecurity. All rights reserved.

## 🔄 Version History

### v1.0.0 (2026-01-01)
- Initial release
- Contact forms with database integration
- Email notification system
- Responsive design
- Google Tag Manager integration
