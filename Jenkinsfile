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
        COOKIE_VERSION = 'VI_T1PAPSID'
        SCOUT_DRIVER = 'meilisearch'
        MEILISEARCH_HOST = 'http://meilisearch:7700'
        WWWGROUP = '1000'
        WWWUSER = '1000'
        existing_Target_GroupArn = 'arn:aws:elasticloadbalancing:us-west-2:496513254117:targetgroup/dce-ca-alb/d901ad72428ef9fd'
    }
    stages {
        stage('Build PHP Docker Image') {
            steps {
                script {
                    withCredentials([
                        usernamePassword(credentialsId: 'b1ad4882-cdf4-4dd4-b18e-587141426d69', passwordVariable: 'APP_KEY', usernameVariable: 'APP_KEY_USERNAME'),
                        usernamePassword(credentialsId: '4bf341bd-c67c-4eb1-ad5e-bfcf8e4a6773', passwordVariable: 'APP_NAME', usernameVariable: 'APP_NAME_USERNAME'),
                        // ... other credentials
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
                    sh "docker push ${ecrRegistry}/${phpImage}:latest"
                }
            }
        }
        stage('Update ECS Task Definition') {
            steps {
                script {
                    def taskDefFile = './taskDefinition.json'

                    // Read the existing task definition file
                    def taskDef = readJSON file: taskDefFile

                    // Add the FRANKENPHP_NO_TLS environment variable to the container definition
                    taskDef.containerDefinitions[0].environment.add([
                        name: "FRANKENPHP_NO_TLS",
                        value: "1"
                    ])

                    // Write the modified task definition back to the file
                    writeJSON file: taskDefFile, json: taskDef, pretty: 4

                    // Register the new task definition with ECS
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
