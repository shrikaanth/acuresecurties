@echo off
REM Git Push Helper Script for Windows
REM This script helps you push your code to a remote Git repository

echo ===================================
echo AccureSecurity - Git Push Helper
echo ===================================
echo.

REM Check if remote already exists
git remote | findstr "origin" >nul
if %errorlevel% equ 0 (
    echo Remote 'origin' already configured:
    git remote -v
    echo.
    set /p confirm="Do you want to push to this remote? (y/n): "
    if /i "%confirm%"=="y" (
        echo.
        echo Pushing to remote...
        git push -u origin master
        echo.
        echo Push completed!
    )
) else (
    echo No remote repository configured.
    echo.
    echo Please enter your repository URL
    echo Example: https://github.com/username/repo.git
    echo.
    set /p repo_url="Repository URL: "
    
    echo.
    echo Adding remote repository...
    git remote add origin "%repo_url%"
    
    echo.
    echo Pushing to remote...
    git push -u origin master
    
    echo.
    echo Repository configured and pushed!
)

echo.
echo ===================================
echo Current Git Status:
echo ===================================
git status

echo.
pause
