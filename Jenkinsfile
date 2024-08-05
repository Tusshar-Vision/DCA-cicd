pipeline {
    agent any

    environment {
        dockerImage = '496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-visionias'
        proxyImage = '496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-proxy'
        // ecrRegistry = '496513254117.dkr.ecr.us-west-2.amazonaws.com'
        ecsCluster = 'dca-container'
        TaskDefName = 'dca-task'
        serviceName = 'dca-contaioner'
        phpDockerfile = /Dockerfile'
        phpImage = 'visionias' 
    }

    stages {
        stage('Build PHP Docker Image') {
            steps {
                script {
                    withCredentials([string(credentialsId: 'Digital-CA-env', variable: 'ENV_FILE_CONTENT')]) {
                        // Write the environment file content to a file
                        writeFile file: '.env', text: "${ENV_FILE_CONTENT}"
                    }

                    // Build the PHP Docker image
                    sh """
                        docker build -t ${ecrRegistry}/${phpImage}:latest -f ${phpDockerfile} .
                    """
                }
            }
        }

        stage('Push PHP Docker Image') {
            steps {
                script {
                    def command = "aws ecr list-images --repository-name $phpImage --region us-west-2 --output text | grep IMAGEIDS | sed 's/IMAGEIDS\\t.*\\t//g' | grep -v latest | sort -nr | head -n1"
                    def currentVersion = sh(script: command, returnStdout: true).trim()
                    def newVersion = (currentVersion.isInteger() ? currentVersion.toInteger() + 1 : 1)

                    sh "docker tag ${ecrRegistry}/${phpImage}:latest ${ecrRegistry}/${phpImage}:${newVersion}"
                    sh("aws ecr get-login-password --region us-west-2 | docker login --username AWS --password-stdin $ecrRegistry")
                    sh "docker push ${ecrRegistry}/${phpImage}:${newVersion}"
                    sh "docker push ${ecrRegistry}/${phpImage}:latest"
                }
            }
        }

        stage('Deploy to ECS') {
            steps {
                script {
                    def command = "aws ecr list-images --repository-name $phpImage --region us-west-2 --output text | grep IMAGEIDS | sed 's/IMAGEIDS\\t.*\\t//g' | grep -v latest | sort -nr | head -n1"
                    def phpImageVersion = sh(script: command, returnStdout: true).trim()

                    // Docker image with tag
                    def phpImageWithTag = "${ecrRegistry}/${phpImage}:${phpImageVersion}"

                    // Register a new task definition with a new image and environment variables
                    sh '''
                        cat > task-def.json <<- EOM
                        {
                          "family": "$TaskDefName",
                          "containerDefinitions": [
                            {
                              "name": "dca-container",
                              "image": "$phpImageWithTag",
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
                                $(cat .env | sed 's/^/{"name": "/; s/=/"}, /' | sed '$ s/, $//')
                              ]
                            }
                          ]
                        }
                        EOM
                    '''

                    // Register a new revision of the task definition with the updated Docker image
                    def taskDefName = 'task-def.json'
                    sh "aws ecs register-task-definition --cli-input-json file://${taskDefName} --region us-west-2"

                    // Update the service to use the latest revision of the task definition
                    sh "aws ecs update-service --cluster ${ecsCluster} --service ${serviceName} --task-definition ${taskDefName} --force-new-deployment --region us-west-2"
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
                JENKINS_USER = env.BUILD_USER_ID // Jenkins user who triggered the build
            }
        }
    }
}
