pipeline {
  agent any
  stages {
    stage('Checkout') {
      steps {
        git 'https://github.com/your-repo.git'
      }
    }
    stage('Display system date') {
      steps {
        sh 'date'
      }
    }
  }
}
