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
    }

    stages {
        stage('Build PHP Docker Image') {
            steps {
                script {
                         withCredentials([string(credentialsId: 'Digital-CA-env', variable: 'ENV_FILE_CONTENT')]) {
                         writeFile file: '.env', text: "${ENV_FILE_CONTENT}"
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
