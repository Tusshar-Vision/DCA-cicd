pipeline {
    agent any
    environment {
        REPO_NAME = "digital-current-affairs"
        ECR_REGISTRY = "496513254117.dkr.ecr.us-west-2.amazonaws.com"
        ECR_REPO_NAME = "dca-visionias"
        AWS_REGION = "us-west-2"
        DOCKER_CREDENTIALS_ID = 'your-docker-credentials-id'
        AWS_CREDENTIALS_ID = 'your-aws-credentials-id'
        PHP_IMAGE_TAG = "dca-contioner:latest"
        NGINX_IMAGE_TAG = "dca-proxy:latest"
        ECS_CLUSTER_NAME = "digital-current-affairs"
        ECS_SERVICE_NAME_1 = "dca-contaioner"
        ECS_SERVICE_NAME_2 = "dca-service"
        ECS_TASK_DEFINITION = "your-ecs-task-definition"
        ECS_CONTAINER_NAME = "your-php-container-name"
        ECS_TASK_ROLE_ARN = "arn:aws:iam::496513254117:role/your-ecs-task-role"
        ECS_EXECUTION_ROLE_ARN = "arn:aws:iam::496513254117:role/your-ecs-execution-role"
        APP_ENV = "production"
        APP_DEBUG = "false"
        APP_KEY = "your-app-key"
        DB_HOST = "dca-rds-db.ck8cfyvbkpuw.us-west-2.rds.amazonaws.com "
        DB_PORT = "3306"
        DB_DATABASE = "dcurrentaffair"
        DB_USERNAME = "admin"
        DB_PASSWORD = "VisionIAS278766"
        IMAGE_TAG = "latest"
        REPO_URL = "496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-visionias"
        PROXY_URL = "496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-proxy"
        REDIS_REPO_URL = "496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-redis"
    }
    stages {
        stage('Clone Repository') {
            steps {
                git url: "${env.REPO_URL}"
            }
        }
        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("${env.ECR_REPO_NAME}:${env.IMAGE_TAG}")
                }
            }
        }
        stage('Login to ECR') {
            steps {
                script {
                    sh """
                    aws ecr get-login-password --region ${env.AWS_REGION} | docker login --username AWS --password-stdin ${env.ECR_REGISTRY}
                    """
                }
            }
        }
        stage('Push Docker Image') {
            steps {
                script {
                    sh """
                    docker tag ${env.ECR_REPO_NAME}:${env.IMAGE_TAG} ${env.ECR_REGISTRY}/${env.ECR_REPO_NAME}:${env.IMAGE_TAG}
                    docker push ${env.ECR_REGISTRY}/${env.ECR_REPO_NAME}:${env.IMAGE_TAG}
                    """
                }
            }
        }
        stage('Deploy to ECS') {
            steps {
                script {
                    def taskDefinition = """
                    {
                      "family": "${env.ECS_SERVICE_NAME_1}",
                      "containerDefinitions": [
                        {
                          "name": "${env.ECS_CONTAINER_NAME}",
                          "image": "${env.ECR_REGISTRY}/${env.ECR_REPO_NAME}:${env.IMAGE_TAG}",
                          "essential": true,
                          "memory": 512,
                          "cpu": 256,
                          "environment": [
                            ${env.LARAVEL_ENV_VARS.split(' ').collect {
                                def (key, value) = it.split('=', 2);
                                "{ \\"name\\": \\"${key}\\", \\"value\\": \\"${value}\\" }"
                            }.join(',\n')}
                          ],
                          "portMappings": [
                            {
                              "containerPort": 80,
                              "hostPort": 80
                            }
                          ]
                        }
                      ]
                    }
                    """
                    def taskDefArn = sh(
                        script: "aws ecs register-task-definition --cli-input-json '${taskDefinition}' --region ${env.AWS_REGION} | jq -r .taskDefinition.taskDefinitionArn",
                        returnStdout: true
                    ).trim()
                    sh """
                    aws ecs update-service \
                        --cluster ${env.ECS_CLUSTER_NAME} \
                        --service ${env.ECS_SERVICE_NAME_1} \
                        --task-definition ${taskDefArn} \
                        --region ${env.AWS_REGION}
                    """
                }
            }
        }
    }
    post {
        always {
            cleanWs()
        }
    }
}
