pipeline {
    agent any
    environment {
        REPO_NAME = "your-repo-name"
    ECR_REGISTRY = "YOUR_ACCOUNT_ID.dkr.ecr.YOUR_REGION.amazonaws.com"
    ECR_REPO_NAME = "your-ecr-repo"
    AWS_REGION = "YOUR_REGION"
    DOCKER_CREDENTIALS_ID = 'your-docker-credentials-id'
    AWS_CREDENTIALS_ID = 'your-aws-credentials-id'
    PHP_IMAGE_TAG = "php:latest"
    NGINX_IMAGE_TAG = "nginx:latest"
    // ECS Specific
    ECS_CLUSTER_NAME = "your-ecs-cluster-name"
    ECS_SERVICE_NAME = "your-ecs-service-name"
    ECS_TASK_DEFINITION = "your-ecs-task-definition"
    ECS_CONTAINER_NAME = "your-php-container-name"
    ECS_TASK_ROLE_ARN = "arn:aws:iam::YOUR_ACCOUNT_ID:role/your-ecs-task-role"
    ECS_EXECUTION_ROLE_ARN = "arn:aws:iam::YOUR_ACCOUNT_ID:role/your-ecs-execution-role"
    // PHP Specific
    APP_ENV = "production"
    APP_DEBUG = "false"
    APP_KEY = "your-app-key"
    DB_HOST = "your-database-host"
    DB_PORT = "3306"
    DB_DATABASE = "your-database-name"
    DB_USERNAME = "your-database-username"
    DB_PASSWORD = "your-database-password"
    }
    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/your-username/your-repo.git'
            }
        }
        stage('Build PHP Docker Image') {
            steps {
                script {
                    docker.build("${ECR_REGISTRY}/${ECR_REPO_NAME}/php:${env.BUILD_NUMBER}", "-f Dockerfile.php .")
                }
            }
        }
        stage('Build Nginx Docker Image') {
            steps {
                script {
                    docker.build("${ECR_REGISTRY}/${ECR_REPO_NAME}/nginx:${env.BUILD_NUMBER}", "-f Dockerfile.nginx .")
                }
            }
        }
        stage('Tag Docker Images') {
            steps {
                script {
                    docker.image("${ECR_REGISTRY}/${ECR_REPO_NAME}/php:${env.BUILD_NUMBER}").tag("${PHP_IMAGE_TAG}")
                    docker.image("${ECR_REGISTRY}/${ECR_REPO_NAME}/nginx:${env.BUILD_NUMBER}").tag("${NGINX_IMAGE_TAG}")
                }
            }
        }
        stage('Authenticate Docker to AWS ECR') {
            steps {
                script {
                    sh """
                        aws ecr get-login-password --region ${AWS_REGION} | docker login --username AWS --password-stdin ${ECR_REGISTRY}
                    """
                }
            }
        }
        stage('Push Docker Images to AWS ECR') {
            steps {
                script {
                    docker.image("${ECR_REGISTRY}/${ECR_REPO_NAME}/php:${env.BUILD_NUMBER}").push()
                    docker.image("${ECR_REGISTRY}/${ECR_REPO_NAME}/nginx:${env.BUILD_NUMBER}").push()
                    docker.image("${ECR_REGISTRY}/${ECR_REPO_NAME}/php:${PHP_IMAGE_TAG}").push()
                    docker.image("${ECR_REGISTRY}/${ECR_REPO_NAME}/nginx:${NGINX_IMAGE_TAG}").push()
                }
            }
        }
        stage('Update ECS Service') {
            steps {
                script {
                    sh """
                        aws ecs update-service --cluster your-cluster --service your-service --force-new-deployment --region ${AWS_REGION}
                    """
                }
            }
        }
        stage('Clean Up Docker Images') {
            steps {
                script {
                    sh "docker rmi ${ECR_REGISTRY}/${ECR_REPO_NAME}/php:${env.BUILD_NUMBER}"
                    sh "docker rmi ${ECR_REGISTRY}/${ECR_REPO_NAME}/nginx:${env.BUILD_NUMBER}"
                }
            }
        }
    }
    post {
        cleanup {
            cleanWs()
        }
    }
}