# Simple Video Game Management System API
This API works with JSON Body through Postman.

## Tech stack

 - PHP 8.1
 - Composer 2.6
 - Laravel 10.48
 - MySQL 8
 - docker
 - Postman

## Supported Functionalities

 - Authentication with Laravel Sanctum
 - User Registration, Log in, Log out
 - Two User roles: Admin and Regular User
 - Users can add, edit, delete and view a Game record
 - Users can see a list of their Games, sort them by Release Date and filter them by Genre
 - Users can add a Review (rating and comment) to a Game
 - Users don't have access to other Users' records
 - Data validation during user registration, user login, game creation or update.
 - Admin can delete other users' games and make another user an Admin.

## Run on PC

Start MySQL service, it should run on port 3306  
Open MySQL Workbench  
Login as root  
Create a new database named laravel  

First open the .env file in the project directory  
and change DB_HOST property to

    DB_HOST=127.0.0.1

Open a terminal in project's directory and run

    php artisan serve

The API starts on http://127.0.0.1:8000

To create the database schema/table, run

    php artisan migrate
To populate the database, run

    php artisan db:seed
Admin user: username = JohnTester, password = Pass!123  
Regular user: username = JaneTester, password = Pass!123

## Run API on docker
API's Dockerfile does not install npm as it is not needed.  

**For database running on PC host:**

First open the .env file in the project directory  
and change DB_HOST property to

    DB_HOST=host.docker.internal
 and set your DB_PASSWORD to the value you have set in Workbench
 

    DB_PASSWORD=

Then open a terminal in the project's directory and run

    docker build -t demo/laravel:0.1 .
and then

    docker run -p 8000:80 demo/laravel:0.1

**For database  running on docker:**

First open the .env file in the project directory  
and change DB_HOST property to

    DB_HOST=db
 If you want to change the DB_PASSWORD I have set as default,  
 you have to change it both in the .env file and in docker-compose.yml.
 
Open a terminal in the project's directory and run

    docker-compose up --build
Now you should have two containers running, one for backend API and one for MySQL db.
  
To create database schema/table, run

    docker-compose exec backend php artisan migrate
To populate the database, run

    docker-compose exec backend php artisan db:seed
Admin user: username = JohnTester, password = Pass!123  
Regular user: username = JaneTester, password = Pass!123

## First steps
You can either test the API with the provided users  
or use Register to create new Regular User.  
After you Log in, a Token will be given to you.  
Type this Token in Postman's Authorization tab, in Bearer Token Type.  
In Header's tab you should disable the field with Accept key  
and write your own Accept key value pair with value as application/json  

You should be ready to use the API.

## Examples
Under every POST endpoint, i will provide an example of the Body raw JSON you should provide.

## POST Requests

   http://127.0.0.1:8000/api/v1/register (no auth)
   

       {
           "username":"Tester",
           "password":"Pass!123"
       }

http://127.0.0.1:8000/api/v1/login (no auth)
   

       {
           "username":"Tester",
           "password":"Pass!123"
       }

http://127.0.0.1:8000/api/v1/logout (this request destroys the provided auth token)
http://127.0.0.1:8000/api/v1/games (add new game)
   

       {
	       "title":  "Black Myth: Wukong",
	       "description":  "A monkey with a stuff",
	       "releaseDate":  "2024-08-20",
	       "genre":  "RPG"
       }

http://127.0.0.1:8000/api/v1/games/{game_id}/add_review

       {
	       "rating":  "10",
	       "comment":  "Great"
       }

## GET Requests

- http://127.0.0.1:8000/api/v1/games (display user's games list)
- http://127.0.0.1:8000/api/v1/games?genre=RPG (filter by genre)
- http://127.0.0.1:8000/api/v1/games?sort=desc (order results descending)
- http://127.0.0.1:8000/api/v1/games?sort=asc (order results ascending)
- http://127.0.0.1:8000/api/v1/games?genre=RPG&sort=desc (filter and order)
- http://127.0.0.1:8000/api/v1/games/{id} (display specific game)
- http://127.0.0.1:8000/api/v1/users (only Admin)
- http://127.0.0.1:8000/api/v1/users?includeGames=true (only Admin)
- http://127.0.0.1:8000/api/v1/users/{id} (only Admin)
- http://127.0.0.1:8000/api/v1/users/{id}?includeGames=true (only Admin)

## UPDATE (PUT/PATCH) Requests

http://127.0.0.1:8000/api/v1/games/{id} (update specific game)

       {
	       "title":  "Wukong",
       }


http://127.0.0.1:8000/api/v1/make_admin/{id} (makes user an admin)

## DELETE Requests

- http://127.0.0.1:8000/api/v1/games/{id} (delete specific game)
