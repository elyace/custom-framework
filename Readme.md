# Custom FRM (don't ask me why)

This project has no real road map, I'm just challenging myself from implementing new ideas inside

````
php version : 8.1
node : lts
````

Always work with ``dev`` branch then make me a new PR if you got any interesting changes

## HOW TO BRING IT TO LIFE


In the root folder run 
````shell
$ composer install
````
for backend dependencies installation

Run the following command to create database (mysql lite) :
````shell
$ php bin/doctrine orm:schema-tool:update --force
````

Then run this command to populate the actual database :

````shell
$ php bin/doctrine seeder:run
````

Go to web folder and run 
````shell
$ yarn install
````
for frontend dependencies installation

## HOW TO RUN IT

Inside web folder run : 
````shell
$ yarn vite
````

Inside public folder run :

````shell
$ php -S localhost:8080
````

Then go to [localhost:8080](http://localhost:8080/customer-list) to see what happen


