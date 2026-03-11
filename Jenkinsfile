stage('Deploy') {
    steps {
        script {
            docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
                sshagent (credentials: ['ssh-prod']) {

                    sh 'mkdir -p ~/.ssh'
                    sh 'ssh-keyscan -H "$PROD_HOST" >> ~/.ssh/known_hosts'

                    sh '''
                    rsync -rav --delete ./ \
                    ubuntu@$PROD_HOST:/home/ubuntu/prod.kelasdevops.xyz \
                    --exclude=.env \
                    --exclude=storage \
                    --exclude=.git
                    '''
                }
            }
        }
    }
}
