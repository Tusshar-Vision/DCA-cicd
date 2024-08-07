pipeline {
    agent any

    environment {
        ecrRegistry = '496513254117.dkr.ecr.us-west-2.amazonaws.com'
        dockerImage = "${ecrRegistry}/dca-visionias"
        proxyImage = "${ecrRegistry}/dca-proxy"
        ecsCluster = 'dca-container'
        TaskDefName = 'dca-task'
        serviceName = 'dca-container'
        phpDockerfile = 'Dockerfile'
        phpImage = 'visionias'
        APP_NAME='Current Affairs | Vision IAS'
        APP_ENV='local'
        BASE_URL='https://visionias.in'
        APP_URL='http://localhost'
        VISION_API='https://qa-apis.visionias.in'
        DB_HOST='mysql'
        DB_PORT='3306'        
        BROADCAST_DRIVER='log'
        CACHE_DRIVER='memcached'
        QUEUE_CONNECTION='redis'
        QUEUE_DRIVER='redis'
        SESSION_DRIVER='file'
        SESSION_LIFETIME='1440'
        MEMCACHED_HOST='memcached'
        MEMCACHED_PORT='11211'
        VITE_APP_NAME="${APP_NAME}"

        
    }

   stages {
        
        stage('Build php docker  image') {
            steps {
                script {
                    withCredentials([
                        usernamePassword(credentialsId: 'c0d683ea-1fb8-48ae-ade8-ab3ff60c3c7d', passwordVariable: 'DB_HOST', usernameVariable: 'DB_HOST_USERNAME'),
                        usernamePassword(credentialsId: '7ad4c0d2-da50-47e0-bde0-a903eade40bd', passwordVariable: 'DB_NAME', usernameVariable: 'DB_NAME_USERNAME'),
                        usernamePassword(credentialsId: '4f11258a-495a-4ecd-ae93-079e7e475f1a', passwordVariable: 'DB_USER', usernameVariable: 'DB_USER_USERNAME'),
                        usernamePassword(credentialsId: '5b1b5d75-e95d-4293-9154-153fc0e25153', passwordVariable: 'DB_PASS', usernameVariable: 'DB_PASS_USERNAME'),
                        usernamePassword(credentialsId: '75a1895e-45f0-4bde-8ca0-ff89ae1a3574', passwordVariable: 'DJANGO_SECRET_KEY', usernameVariable: 'DJANGO_SECRET_KEY_USERNAME'),
                        usernamePassword(credentialsId: '2cfc80a6-f90e-4a11-9029-00ed0272d01e', passwordVariable: 'ALLOWED_HOSTS', usernameVariable: 'ALLOWED_HOSTS_USERNAME'),
                        usernamePassword(credentialsId: '105d609a-7501-4ac2-8653-dba60f6b709f', passwordVariable: 'AWS_ACCESS_KEY', usernameVariable: 'AWS_ACCESS_KEY_USERNAME'),
                        usernamePassword(credentialsId: 'cce60152-578d-412a-a33d-0b175cbb2372', passwordVariable: 'AWS_SECRET_KEY', usernameVariable: 'AWS_SECRET_KEY_USERNAME'),
                        usernamePassword(credentialsId: '6881a241-e2ae-4686-b998-0c245751ae6b', passwordVariable: 'REGION_NAME', usernameVariable: 'REGION_NAME_USERNAME'),
                        usernamePassword(credentialsId: '99806c1c-823a-43eb-96d5-4c3af2f946ee', passwordVariable: 'USER_POOL_ID', usernameVariable: 'USER_POOL_ID_USERNAME'),
                        usernamePassword(credentialsId: '7cbb0fd0-4349-4fa7-8bd9-48cad6d6ca46', passwordVariable: 'ADMIN_USER_POOL_ID', usernameVariable: 'ADMIN_USER_POOL_ID_USERNAME'),
                        usernamePassword(credentialsId: '8bfaa133-c58e-4b4e-8a49-e293f379f4fc', passwordVariable: 'CLIENT_ID', usernameVariable: 'CLIENT_ID_USERNAME'),
                        usernamePassword(credentialsId: '68f326d7-eec5-4933-9cec-9ca2703ddac8', passwordVariable: 'ADMIN_CLIENT_ID', usernameVariable: 'ADMIN_CLIENT_ID_USERNAME'),
                        usernamePassword(credentialsId: '3720cb06-9bdf-43c2-89f0-8b014d077905', passwordVariable: 'ADMIN_CLIENT_SECRET', usernameVariable: 'ADMIN_CLIENT_SECRET_USERNAME'),
                        usernamePassword(credentialsId: '1cb1a979-a5e8-4ab4-9c57-31081f47350a', passwordVariable: 'REDIS_HOST', usernameVariable: 'REDIS_HOST_USERNAME'),
                        usernamePassword(credentialsId: '2eb371be-af14-4fc2-8c2d-c13bf6d6caaa', passwordVariable: 'REDIS_PASSWORD', usernameVariable: 'REDIS_PASSWORD_USERNAME'),
                        usernamePassword(credentialsId: 'd40f0468-29cc-47cb-9087-f5206b2f41fc', passwordVariable: 'COGNITO_ENV', usernameVariable: 'COGNITO_ENV_USERNAME'),
                        usernamePassword(credentialsId: 'b882e3cd-a014-40c7-b715-e7eacf49d1a1', passwordVariable: 'EMAIL_HOST_USER', usernameVariable: 'EMAIL_HOST_USER_USERNAME'),
                        usernamePassword(credentialsId: '33b7f248-0be9-49a6-bdc6-fbd074a3b966', passwordVariable: 'EMAIL_HOST_PASSWORD', usernameVariable: 'EMAIL_HOST_PASSWORD_USERNAME'),
                        usernamePassword(credentialsId: 'cd8be3ea-68ed-494b-ae51-058db36e7411', passwordVariable: 'EMAIL_HOST', usernameVariable: 'EMAIL_HOST_USERNAME'),
                        usernamePassword(credentialsId: 'ebd8d5fa-e09a-499c-9960-7394c2a4616d', passwordVariable: 'NOTIFICATION_SERVER_EMAIL_LINK', usernameVariable: 'NOTIFICATION_SERVER_EMAIL_LINK_USERNAME'),
                        usernamePassword(credentialsId: '5a7fd92c-a84b-4b1d-b084-9e07a30c9b31', passwordVariable: 'NOTIFICATION_SERVER_EMAIL_AUTH', usernameVariable: 'NOTIFICATION_SERVER_EMAIL_AUTH_USERNAME'),
                        usernamePassword(credentialsId: 'c86f1a22-240c-48dc-9227-6ac64de28a1d', passwordVariable: 'ADMIN_API_SECRET_KEY', usernameVariable: 'ADMIN_API_SECRET_KEY_USERNAME')                    ]) {

                    def envFilePath = "${WORKSPACE}/vision_be/configuration"
                    }
                   
                    sh """
                        docker build -t ${ecrRegistry}/${phpImage}:latest -f ${phpDockerfile} .
                    """
                }
            }
        }

        stage('Push PHP Docker Image') {
            steps {
                script {
                    def command = "aws ecr list-images --repository-name ${phpImage} --region us-west-2 --query 'imageIds[*].imageTag' --output text"
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
                          "environment": ${sh(script: 'cat .env | sed "s/^/[\\"name\\": \\"/; s/=\\":/\\", \\"value\\":/; s/$/\\"]/"', returnStdout: true).trim()}
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
                GIT_COMMIT_SHORT = sh(returnStdout: true, script: 'git rev-parse --short HEAD').trim()
                GIT_BRANCH = sh(returnStdout: true, script: 'git rev-parse --abbrev-ref HEAD').trim()
                GIT_USER = sh(returnStdout: true, script: 'git log -1 --pretty=format:"%an"').trim() // Last author
                TOTAL_COMMITS = sh(returnStdout: true, script: 'git rev-list --count HEAD').trim()
                JENKINS_USER = env.BUILD_USER_ID 
            }
        }
    }
}
