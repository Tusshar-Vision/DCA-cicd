#!/bin/bash

# Script to Setup SSH for Pulling Code with Option Flags for Branch and SSH Key

# Default values
BRANCH_NAME="main"
SSH_KEY_NAME="github"

# Parse option flags using getopts
while getopts "b:k:" opt; do
  case $opt in
    b) BRANCH_NAME=$OPTARG ;;
    k) SSH_KEY_NAME=$OPTARG ;;
    \?) echo "Invalid option -$OPTARG" >&2
        exit 1
        ;;
  esac
done

# Setup SSH agent and add the specified SSH key
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/${SSH_KEY_NAME}

# Optional setup for bun and Node can go here

# Navigate to the project directory
cd /var/www/html/vision-ca-api/
# Pull the latest changes from the specified branch
git pull origin ${BRANCH_NAME}

echo "Building and updating Docker images..."
docker-compose -f docker-compose.production.yml build

# Step 3: Restart Docker containers
echo "Restarting Docker containers..."
docker-compose -f docker-compose.production.yml down
docker-compose -f docker-compose.production.yml up -d

echo "Deployment completed successfully!"
