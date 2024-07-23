pipeline {
    agent any
    stages {
        stage("Preparando ambiente") {
            steps {
                sh 'php artisan migrate'
                sh 'php artisan db:seed'
            }
        }
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