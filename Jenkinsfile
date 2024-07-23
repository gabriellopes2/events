pipeline {
    agent any
    stages {
        stage("Executando testes") {
            steps {
                sh 'php artisan test'
            }
        }
        stage("build"){
            steps {
                echo 'build'
                sh 'cd /var/www/events'
                sh 'git pull'
                sh 'php artisan migrate'
            }
        }
    }
}