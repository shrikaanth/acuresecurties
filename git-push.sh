#!/bin/bash
# Git Push Helper Script
# This script helps you push your code to a remote Git repository

echo "==================================="
echo "AccureSecurity - Git Push Helper"
echo "==================================="
echo ""

# Check if remote already exists
if git remote | grep -q "origin"; then
    echo "✓ Remote 'origin' already configured"
    git remote -v
    echo ""
    read -p "Do you want to push to this remote? (y/n): " confirm
    if [ "$confirm" = "y" ] || [ "$confirm" = "Y" ]; then
        echo ""
        echo "Pushing to remote..."
        git push -u origin master
        echo ""
        echo "✓ Push completed!"
    fi
else
    echo "No remote repository configured."
    echo ""
    echo "Please choose your Git hosting provider:"
    echo "1) GitHub"
    echo "2) GitLab"
    echo "3) Bitbucket"
    echo "4) Other"
    echo ""
    read -p "Enter choice (1-4): " choice
    
    echo ""
    read -p "Enter your repository URL: " repo_url
    
    echo ""
    echo "Adding remote repository..."
    git remote add origin "$repo_url"
    
    echo "Pushing to remote..."
    git push -u origin master
    
    echo ""
    echo "✓ Repository configured and pushed!"
fi

echo ""
echo "==================================="
echo "Git Status:"
echo "==================================="
git status
