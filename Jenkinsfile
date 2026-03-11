pipeline {
    agent any

    stages {

        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/Dema08/Company-Profile-UD-Kharismatunggal-Tunggal-Semester-3-.git'
            }
        }

        stage('Build') {
            steps {
                sh 'echo Build Stage'
            }
        }

        stage('Test') {
            steps {
                sh 'echo Test Stage'
            }
        }

        stage('Deploy') {
            steps {
                sh 'echo Deploy Stage'
            }
        }

    }
}
