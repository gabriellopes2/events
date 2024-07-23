pipeline {
    agent any
    stages {
        stage("Preparando ambiente") {
            steps {
                sh 'php artisan migrate:fresh'
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
                sh 'git pull https://github.com/gabriellopes2/events.git main'
                sh 'php artisan migrate'
            }
        }
    }
}