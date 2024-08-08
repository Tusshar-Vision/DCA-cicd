pipeline {
    agent any

    environment {
        ecrRegistry = '496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-visionias'
        dockerImage = "${ecrRegistry}/dca-visionias"
        ecsCluster = 'dca-container'
        TaskDefName = 'dca-task'
        serviceName = 'dca-container'
        phpDockerfile = 'Dockerfile'
        phpImage = 'dca-visionias'
        APP_NAME = 'Current Affairs | Vision IAS'
        APP_ENV = 'local'
        BASE_URL = 'https://visionias.in'
        APP_URL = 'http://localhost'
        VISION_API = 'https://qa-apis.visionias.in'
        DB_HOST = 'mysql'
        DB_PORT = '3306'
        AWS_DEFAULT_REGION = 'us-west-2'
        AWS_COGNITO_REGION = 'ap-south-1'
        AWS_BUCKET_REGION = 'ap-south-1'
        AWS_BUCKET = 'ca-test-bucket-2'
        AWS_PUBLIC_BUCKET = 'ca-test-bucket-2'
        COOKIE_DOMAIN = 'localhost'
        COOKIE_VERSION = "VI_T1PAPSID"
        SCOUT_DRIVER = 'meilisearch'
        MEILISEARCH_HOST = 'http://meilisearch:7700'
        WWWGROUP = '1000'
        WWWUSER = '1000'
    }

    stages {
        stage('Build PHP Docker Image') {
            steps {
                script {
                    withCredentials([
                        usernamePassword(credentialsId: 'b1ad4882-cdf4-4dd4-b18e-587141426d69', passwordVariable: 'APP_KEY', usernameVariable: 'APP_KEY_USERNAME'),
                        usernamePassword(credentialsId: '4bf341bd-c67c-4eb1-ad5e-bfcf8e4a6773', passwordVariable: 'APP_NAME', usernameVariable: 'APP_NAME_USERNAME'),
                        usernamePassword(credentialsId: 'f72ce646-7aac-4182-b5ff-75f135a79526', passwordVariable: 'APP_DEBUG', usernameVariable: 'APP_DEBUG_USERNAME'),
                        usernamePassword(credentialsId: '3d940133-1cc3-4582-8bb5-506e9e6c9bb5', passwordVariable: 'VISION_URL', usernameVariable: 'VISION_URL_USERNAME'),
                        usernamePassword(credentialsId: '40438b6a-ca19-489f-9230-4f986141a2f8', passwordVariable: 'VISION_API', usernameVariable: 'VISION_API_USERNAME'),
                        usernamePassword(credentialsId: '21fa8293-8743-4d01-b82b-f0827fa19aa9', passwordVariable: 'LIVEQUERY_API', usernameVariable: 'LIVEQUERY_API_USERNAME'),
                        usernamePassword(credentialsId: '5d17322e-5bb7-4215-b800-93223f456254', passwordVariable: 'LOG_CHANNEL', usernameVariable: 'LOG_CHANNEL_USERNAME'),
                        usernamePassword(credentialsId: 'f25d8a9e-0031-4a61-92fc-ac94bd325ebc', passwordVariable: 'LOG_LEVEL', usernameVariable: 'LOG_LEVEL_USERNAME'),
                        usernamePassword(credentialsId: '5ff52e2a-5ec3-465c-ad69-82e289ad2190', passwordVariable: 'DB_CONNECTION', usernameVariable: 'DB_CONNECTION_USERNAME'),
                        usernamePassword(credentialsId: '9d49d48b-f0ce-4f09-be3b-90c064cc9f54', passwordVariable: 'DB_HOST', usernameVariable: 'DB_HOST_USERNAME'),
                        usernamePassword(credentialsId: 'b1a26e5c-de69-4b03-bb71-ee4684d2f669', passwordVariable: 'DB_PORT', usernameVariable: 'DB_PORT_USERNAME'),
                        usernamePassword(credentialsId: '9a31b78b-a0e7-4839-903d-d1a740573948', passwordVariable: 'DB_DATABASE', usernameVariable: 'DB_DATABASE_USERNAME'),
                        usernamePassword(credentialsId: 'ccf66ca2-d627-4844-a7dd-bd334209ca66', passwordVariable: 'DB_USERNAME', usernameVariable: 'DB_USERNAME_USERNAME'),
                        usernamePassword(credentialsId: 'b8965e4a-6506-4f87-9940-885fe887aaed', passwordVariable: 'DB_PASSWORD', usernameVariable: 'DB_PASSWORD_USERNAME'),
                        usernamePassword(credentialsId: 'b81ed182-f6ee-4b6d-b16d-796db5858921', passwordVariable: 'BROADCAST_DRIVER', usernameVariable: 'BROADCAST_DRIVER_USERNAME'),
                        usernamePassword(credentialsId: 'a6045675-215d-4017-b2cd-bca7d88f4149', passwordVariable: 'CACHE_DRIVER', usernameVariable: 'CACHE_DRIVER_USERNAME'),
                        usernamePassword(credentialsId: '8dc255b7-0482-48ec-a237-9867af5f4d7d', passwordVariable: 'VITE_APP_NAME', usernameVariable: 'VITE_APP_NAME_USERNAME'),
                        usernamePassword(credentialsId: '254f8aa5-489e-4436-a918-0e8d6fa5c805', passwordVariable: 'AWS_ACCESS_KEY_ID', usernameVariable: 'AWS_ACCESS_KEY_ID_USERNAME'),
                        usernamePassword(credentialsId: '36d147e1-526b-4192-8dac-7ebd65228f4d', passwordVariable: 'AWS_SECRET_ACCESS_KEY', usernameVariable: 'AWS_SECRET_ACCESS_KEY_USERNAME'),
                        usernamePassword(credentialsId: 'b181b396-7f3c-4b37-9968-7c71b4098a80', passwordVariable: 'AWS_COGNITO_USER_POOL_ID', usernameVariable: 'AWS_COGNITO_USER_POOL_ID_USERNAME'),
                        usernamePassword(credentialsId: '50662cc4-f1bc-43f2-9240-2976bff651e2', passwordVariable: 'AWS_COGNITO_CLIENT_ID', usernameVariable: 'AWS_COGNITO_CLIENT_ID_USERNAME'),
                        usernamePassword(credentialsId: '5070d10d-b73f-4f3b-a0cc-235e897b4651', passwordVariable: 'AWS_BUCKET_ACCESS_KEY_ID', usernameVariable: 'AWS_BUCKET_ACCESS_KEY_ID_USERNAME'),
                        usernamePassword(credentialsId: '89c6c9e6-fd6b-4b3f-8dad-a15b0fd875d3', passwordVariable: 'AWS_BUCKET_SECRET_ACCESS_KEY', usernameVariable: 'AWS_BUCKET_SECRET_ACCESS_KEY_USERNAME'),
                        usernamePassword(credentialsId: 'f356416f-5294-407e-85f3-430ea69d03fa', passwordVariable: 'COGNITO_ENCRYPTION_KEY_V1', usernameVariable: 'COGNITO_ENCRYPTION_KEY_V1_USERNAME'),
                        usernamePassword(credentialsId: 'a112c082-9616-4262-b3e5-07e0e3f0a56d', passwordVariable: 'COGNITO_ENCRYPTION_KEY_V2', usernameVariable: 'COGNITO_ENCRYPTION_KEY_V2_USERNAME')
                    ]) {
                        sh 'mkdir -p ./storage/framework/views'
                        sh """
                            docker build -t ${ecrRegistry}/${phpImage}:latest -f ${phpDockerfile} .
                        """
                    }
                }
            }
        }

        stage('Push PHP Docker Image') {
            steps {
                script {
                    // def command = "aws ecr list-images --repository-name ${phpImage} --region us-west-2 --query 'imageIds[*].imageTag' --output text"
                    def currentVersion = sh(script: command, returnStdout: true).trim()
                    def newVersion = (currentVersion.tokenize().findAll { it.isInteger() }.collect { it.toInteger() }.max() ?: 0) + 1

                    sh "docker tag ${ecrRegistry}/${phpImage}:latest ${ecrRegistry}/${phpImage}:${newVersion}"
                    sh "aws ecr get-login-password --region us-west-2 | docker login --username AWS --password-stdin ${ecrRegistry}"
                    sh "docker push ${ecrRegistry}/${phpImage}:${newVersion}"
                    sh "docker push ${ecrRegistry}/${phpImage}:latest"
                }
            }
        }

        stage('Deploy to ECS') {
            steps {
                script {
                    def command = "aws ecr list-images --repository-name ${phpImage} --region us-west-2 --query 'imageIds[*].imageTag' --output text"
                    def phpImageVersion = sh(script: command, returnStdout: true).trim().tokenize().findAll { it.isInteger() }.collect { it.toInteger() }.max() ?: 0
                    def phpImageWithTag = "${ecrRegistry}/${phpImage}:${phpImageVersion}"

                    def taskDefJson = """
                    {
                      "family": "${TaskDefName}",
                      "containerDefinitions": [
                        {
                          "name": "dca-container",
                          "image": "${phpImageWithTag}",
                          "cpu": 512,
                          "memory": 1024,
                          "portMappings": [
                            {
                              "containerPort": 8000,
                              "hostPort": 8000,
                              "protocol": "tcp"
                            }
                          ],
                          "essential": true,
                          "environment": [
                            {"name": "APP_ENV", "value": "${APP_ENV}"},
                            {"name": "DB_HOST", "value": "${DB_HOST}"},
                            {"name": "DB_PORT", "value": "${DB_PORT}"},
                            {"name": "AWS_DEFAULT_REGION", "value": "${AWS_DEFAULT_REGION}"}
                            // Add more environment variables here as needed
                          ]
                        }
                      ]
                    }
                    """
                    
                    writeFile file: 'task-def.json', text: taskDefJson
                    sh "aws ecs register-task-definition --cli-input-json file://task-def.json --region us-west-2"
                    sh "aws ecs update-service --cluster ${ecsCluster} --service ${serviceName} --task-definition ${TaskDefName} --force-new-deployment --region us-west-2"
                }
            }
        }
    }

    post {
        always {
            sh "docker system prune -f -a"
            script {
                def GIT_COMMIT_SHORT = sh(returnStdout: true, script: 'git rev-parse --short HEAD').trim()
                def GIT_BRANCH = sh(returnStdout: true, script: 'git rev-parse --abbrev-ref HEAD').trim()
                def GIT_USER = sh(returnStdout: true, script: 'git log -1 --pretty=format:"%an"').trim() // Last author
                def TOTAL_COMMITS = sh(returnStdout: true, script: 'git rev-list --count HEAD').trim()
                def JENKINS_USER = env.BUILD_USER_ID 
            }
        }
    }
}
