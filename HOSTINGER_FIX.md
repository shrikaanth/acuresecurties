# 🚑 Hostinger "Works on Local, Fails on Live" Fix Guide

If your website works perfectly on your computer but has issues on Hostinger, it is almost certainly one of these 3 things:

## 1. 🛑 Missing `vendor` Directory (Most Likely!)

**The Issue:**
- The `vendor` folder contains the code to send emails (PHPMailer).
- It is excluded from Git (in `.gitignore`), so it does NOT get uploaded automatically when you push to GitHub.
- **Result:** Forms fail to submit, giving a 500 error, but the rest of the site looks fine.

**The Fix:**
1. **On your computer:** Run `composer install` (if you haven't already).
2. **Open FileZilla or cPanel File Manager.**
3. **Upload the `vendor` folder** from your computer to your Hostinger `public_html/` directory.
   - You should see `public_html/vendor/autoload.php` when done.

## 2. 🛑 Missing `config.php`

**The Issue:**
- `config.php` contains your passwords and database settings.
- It is excluded from Git for security.
- **Result:** Database connection fails, forms fail.

**The Fix:**
1. **Create `config.php`** on Hostinger manually (or upload it).
2. **Edit it** to put in your production database credentials and email settings.
   - Use the `config.example.php` as a template.

## 3. 🛑 Browser Caching (Old Version Showing)

**The Issue:**
- Browsers "save" CSS and JS files to load faster.
- When you update the live site, you might still see the old "broken" version.

**The Fix:**
1. **I updated your `index.html`** to force a new version (`styles.css?v=1.1`).
2. **On your browser:** Press `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac) to force a hard reload.
3. **Clear Hostinger Cache:** If you use "Cache Manager" in Hostinger, click "Purge All".

---

## 📋 Comprehensive Checklist for Hostinger

Go through this list one by one:

### 📂 Files Check
- [ ] `index.html` is in `public_html/`
- [ ] `script.js` is in `public_html/`
- [ ] `styles.css` is in `public_html/`
- [ ] `submit-quote.php` is in `public_html/`
- [ ] **`config.php`** exists and has correct passwords? ⚠️
- [ ] **`vendor/` folder** exists and contains PHPMailer? ⚠️

### 🔐 Permissions Check
- [ ] Folders should be **755**
- [ ] Files should be **644**
- [ ] `submit-quote.php` should be executable (644 is usually fine, sometimes 755 needed).

### ⚙️ Server Reference
- [ ] PHP Version: Make sure Hostinger is using **PHP 7.4 or higher**.
- [ ] Extensions: Ensure `mysqli` and `json` are enabled (default on Hostinger).

## 🚀 How to Deploy the Latest Fixes

Since Git might be having sync issues, the most reliable way right now is:

1. **Upload `script.js`** manually to Hostinger (it has the new null checks).
2. **Upload `index.html`** manually to Hostinger (it has the version tags).
3. **Upload `styles.css`** manually (it has the header image fix).
4. **Ensure `vendor/`** folder is present.

Once you do this, load the site and press **Ctrl + F5**. The "version" issues should be resolved!
