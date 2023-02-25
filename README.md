# RESTful API + Todo App

#### Restful Api made with symfony, mysql, authentication with jwt and fronted made with Vue.
___
## Technologies used

- Symfony
- MySql
- Docker
- Php
- Vue.js
___
## Prerequisites

- Docker
- make
- node.js
- npm
___
## Getting started
### Start API services
~~~
make run
~~~
### Enter to php container to install dependencies and run migrations
~~~
make ssh-be
~~~
~~~
composer install
~~~
~~~
php bin/console doctrine:migration:migrate
~~~
#### You can check the routes whit 
~~~
php bin/console debug:router
~~~
#### or in the api docs at http://localhost:250/api/v1/docs
### Exit the container
~~~
exit
~~~

### Move to frontend directory
~~~ 
cd fronted 
~~~
### Install dependencies
~~~
npm install
~~~
### Start frontend server
~~~
npm run serve
~~~
App will run at http://localhost:8080/  
You will have to create an account and login to start using the app  
## Captures
### Api docs routes
![api-routes.png](frontend%2Fsrc%2Fassets%2Fapi-routes.png)
  
### Login view
![login.png](frontend%2Fsrc%2Fassets%2Flogin.png)  

### Create user view
![create-user.png](frontend%2Fsrc%2Fassets%2Fcreate-user.png)
  
### Home view
![dashboard.png](frontend%2Fsrc%2Fassets%2Fdashboard.png)

### Create todo view
![create-todo.png](frontend%2Fsrc%2Fassets%2Fcreate-todo.png)   

### Edit todo view
![edit.png](frontend%2Fsrc%2Fassets%2Fedit.png)
