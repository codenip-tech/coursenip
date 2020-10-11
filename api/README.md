# Dokku deploy

## Preparation
### Create the apps
dokku apps:create coursenip-be
dokku apps:create coursenip-web
### Add dockerfile path
dokku docker-options:add coursenip-be build '--file api/docker/php/prod.Dockerfile'
dokku docker-options:add coursenip-web build '--file api/docker/nginx/prod.Dockerfile'
### Create the network and attach the apps to it
dokku network:create coursenip-network
dokku network:set cournseip-web attach-post-create coursenip-network
dokku network:set cournseip-be attach-post-deploy coursenip-network

dokku domains:set coursenip-web coursenip.dokku.codenip.tech

JWT_PATH=/var/lib/dokku/data/storage/coursenip-be/config/jwt
JWT_PASS=767b453a97ac019714eb7ccbce781d16
mkdir -p $JWT_PATH
openssl genrsa -passout pass:$JWT_PASS -out $JWT_PATH -aes256 4096
openssl rsa -pubout -passin pass:$JWT_PASS -in $JWT_PATH -out config/jwt/public.pem
dokku storage:mount coursenip-be /var/lib/dokku/data/storage/coursenip-be/config/jwt:/appdata/www/config/jwt
dokku ps:restart coursenip-be
# Put the env values in /var/lib/dokku/data/storage/coursenip-be/.env
dokku storage:mount coursenip-be /var/lib/dokku/data/storage/coursenip-be/.env:/appdata/www/.env
dokku ps:restart coursenip-be

dokku mysql:create coursenip -I 8.0
dokku mysql:link coursenip coursenip-be
dokku rabbitmq:create coursenip -I 3-management
dokku rabbitmq:link coursenip coursenip-be -a MESSENGER_TRANSPORT_DSN

# Remember nginx caches the ip of coursenip-be container
dokku ps:restart coursenip-web