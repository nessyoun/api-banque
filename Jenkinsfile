pipeline {
  agent any
  stages {
    stage('Checkout') {
      steps {
        git(url:'https://github.com/nessyoun/api-banque.git', branch:'main')
      }
    }
    stage('Display system date') {
      steps {
        sh 'date'
}
}
}
}
