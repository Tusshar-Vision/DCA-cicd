pipeline {
    agent any
    environment {
        ecrRegistry = '496513254117.dkr.ecr.us-west-2.amazonaws.com'
        dockerImage = "${ecrRegistry}/dca-visionias"
        ecsCluster = 'dce-app'
        taskDefName = 'dca-task'
        serviceName = 'service1'
        phpDockerfile = 'Dockerfile'
        phpImage = 'dca-visionias'
        phpContainer = 'dca-container'
        awsRegion = 'us-west-2'
    }
    stages {
        stage('Build PHP Docker Image') {
            steps {
                script {
                    sh """
                        docker build -t ${phpImage}:latest -f ${phpDockerfile} .
                    """
                }
            }
        }
        stage('Push PHP Docker Image') {
            steps {
                script {
                    sh """
                        aws ecr get-login-password --region ${awsRegion} | docker login --username AWS --password-stdin ${ecrRegistry}
                    """
                    sh """
                        docker tag ${phpImage}:latest ${ecrRegistry}/${phpImage}:latest
                        docker push ${ecrRegistry}/${phpImage}:latest
                    """
                }
            }
        }
        stage('Update ECS Task Definition') {
            steps {
                script {
                    def taskDefFile = './taskDefinition.json'
                    def newTaskDefArn = sh(script: "aws ecs register-task-definition --cli-input-json file://${taskDefFile} --query 'taskDefinition.taskDefinitionArn' --output text", returnStdout: true).trim()
                    echo "New task definition registered: ${newTaskDefArn}"
                    env.NEW_TASK_DEF_ARN = newTaskDefArn
                }
            }
        }
        stage('Update ECS Service') {
            steps {
                script {
                    echo "Updating ECS service ${serviceName} in cluster ${ecsCluster} with task definition ${env.NEW_TASK_DEF_ARN}"
                    
                    sh """
                        aws ecs update-service \
                            --cluster ${ecsCluster} \
                            --service ${serviceName} \
                            --task-definition ${env.NEW_TASK_DEF_ARN}
                    """
                }
            }
        }
    }
    post {
        always {
            cleanWs()
        }
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
