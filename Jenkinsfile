pipeline {
    agent any

    environment {
        dokerImage = 'vision-nbe'
        proxyImage = 'vision-nbe-proxy'
        ecrRegistry = '496513254117.dkr.ecr.us-west-2.amazonaws.com'
        ecsCluster = 'dca-contaioner'
        TaskDefName = 'Newbackend-qa-api'
        serviceName = 'Newbackend-qa-api'
        djangoDockerfile = 'devops/Dockerfile'
        
    }

   stages {
    stage('Build Django image') {
        steps {
            script {
                // Retrieve the environment file content from Jenkins credentials
                withCredentials([string(credentialsId: 'Digital-CA-env', variable: 'ENV_FILE_CONTENT')]) {
                    // Write the environment file content to a file
                    writeFile file: '.env', text: "${ENV_FILE_CONTENT}"
                }
                
                // Build the Django Docker image
                sh """
                    docker build -t ${ecrRegistry}/${djangoImage}:latest -f ${djangoDockerfile} .
                """
            }
        }
    }
}

        

        stage('Push Django image') {
            steps {
                script {
                    def command = "aws ecr list-images --repository-name $djangoImage --region us-west-2 --output text | grep IMAGEIDS | sed 's/IMAGEIDS\\t.*\\t//g' | grep -v latest | sort -nr | head -n1"
                    def currentVersion = sh(script: command, returnStdout: true).trim()
                    def newVersion = (currentVersion.isNumber() ? currentVersion.toInteger() + 1 : 1)

                    sh "docker tag ${ecrRegistry}/${djangoImage}:latest ${ecrRegistry}/${djangoImage}:${newVersion}"
                    sh("aws ecr get-login-password --region us-west-2 | docker login --username AWS --password-stdin $ecrRegistry")
                    sh "docker push ${ecrRegistry}/${djangoImage}:${newVersion}"
                    sh "docker push ${ecrRegistry}/${djangoImage}:latest"
                }
            }
        }

        

        stage('Deploy to ECS') {
            steps {
                script {
                                           def command = "aws ecr list-images --repository-name $djangoImage --region us-west-2 --output text | grep IMAGEIDS | sed 's/IMAGEIDS\\t.*\\t//g' | grep -v latest | sort -nr | head -n1"
                        def djangoImageVersion = sh(script: command, returnStdout: true).trim()
                        

                        // Docker images with tags
                        def djangoImageWithTag = "${ecrRegistry}/${djangoImage}:${djangoImageVersion}"
                        // def command_proxy = "aws ecr list-images --repository-name $proxyImage --region us-west-2 --output text | grep IMAGEIDS | sed 's/IMAGEIDS\\t.*\\t//g' | grep -v latest | sort -nr | head -n1"
                        // def proxyImageVersion = sh(script: command_proxy, returnStdout: true).trim()
                        // def proxyImageWithTag = "${ecrRegistry}/${proxyImage}:${proxyImageVersion}"

                        // Register a new task definition with a new image and environment variables
                    sh '''
                        cat > task-def.json <<- EOM
                        {
                          "family": "$TASK_DEFINITION",
                          "containerDefinitions": [
                            {
                              "name": "dca-container",
                              "image": "496513254117.dkr.ecr.us-west-2.amazonaws.com/dca-visionias",
                              "cpu": 512,
                              "memory": 1024,
                               "portMappings": [
                {
                                "name": "dca-8000-tcp",
                                "containerPort": 8000,
                                "hostPort": 8000,
                                "protocol": "tcp",
                                "appProtocol": "http"
                              "essential": true,
                              "environment": $(cat .env | sed 's/^/{"name": "/; s/=/"}, /' | sed '$ s/, $//')
                              // Add other necessary container definitions
                            }
                          ]
                          // Add other necessary task definition parameters
                        }
                        EOM
                        
                        aws ecs register-task-definition --cli-input-json file://task-def.json
                    '''


                        // Register a new revision of the task definition with the updated Docker image
                        // sh "aws ecs register-task-definition --cli-input-json file://${taskDefFile} --region us-west-2"
                           def taskDefName = 'task-def.json'
                        // Update the service to use the latest revision of the task definition
                        sh "aws ecs update-service --cluster ${ecsCluster} --service ${serviceName} --task-definition ${taskDefName} --force-new-deployment --region us-west-2"
                    }
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
