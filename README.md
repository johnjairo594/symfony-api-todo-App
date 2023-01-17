# Docker-Symfony-5-php-mysql-nginx-Rabbitmq
Docker containers: Symfony 5 + php7.4.6-fpm + mysql8 + nginx 1.19

- Being in the root of the project execute `make run` to start the containers
- Run `make ssh-be` to access the php container
- Run `git config --global user.email` `git config --global user.name` to set your account's default identity.
- Run `symfony new {project name}` to create a new symfony project
- Move the content of the project folder to the root folder `mv {project name}/* .`
- Move '.env and .gitignore' files and delete the empty project folder
- Go to localhost:250
