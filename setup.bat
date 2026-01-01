@echo off
echo ========================================
echo AccureSecurity - Setup Script
echo ========================================
echo.

echo Step 1: Checking Composer...
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Composer is not installed!
    echo Please install Composer from: https://getcomposer.org/download/
    echo.
    pause
    exit /b 1
)
echo [OK] Composer found!
echo.

echo Step 2: Installing PHP Dependencies...
call composer install
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Failed to install dependencies!
    pause
    exit /b 1
)
echo [OK] Dependencies installed!
echo.

echo Step 3: Checking Configuration...
if not exist "config.php" (
    echo [WARNING] config.php not found!
    echo Creating config.php from example...
    copy config.example.php config.php
    echo.
    echo [ACTION REQUIRED] Please edit config.php and add your:
    echo   - Gmail address
    echo   - Gmail App Password
    echo.
    echo To generate Gmail App Password:
    echo   1. Go to https://myaccount.google.com/security
    echo   2. Enable 2-Step Verification
    echo   3. Go to App passwords
    echo   4. Generate password for Mail
    echo   5. Copy the 16-character password to config.php
    echo.
) else (
    echo [OK] config.php exists!
)
echo.

echo Step 4: Database Setup
echo ========================================
echo Please complete the following manually:
echo.
echo 1. Start XAMPP (Apache and MySQL)
echo 2. Open phpMyAdmin: http://localhost/phpmyadmin
echo 3. Import the database.sql file
echo    OR create database 'accuresecurity_db' and run the SQL
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Next Steps:
echo 1. Configure config.php with your Gmail credentials
echo 2. Import database.sql into MySQL
echo 3. Copy project to C:\xampp\htdocs\accuresecurity\
echo 4. Visit http://localhost/accuresecurity/
echo.
echo For detailed instructions, see README.md
echo.
pause
