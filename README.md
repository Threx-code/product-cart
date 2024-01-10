## About the Project

Wisdom Power Conference Registration Platform
This application requires PHP ^8.1

## Installation RUN the commands below in the terminal
- cd ~/path/to/the/directory/where/you/download/the/project
- cp .env.example .env
- composer install
- docker compose build
- docker compose ps -a (To see the list of containers started) 
- docker compose up -d
- docker exec -it productCart /bin/sh
- Create your database
- Copy .env.example and rename it to .env
- Add the database configuration to the .env file
- Run the migrations (php artisan migrate)
- Copy the url:8004 (see how to use the application below)


## HOW to use the application
- To access the application .........http://0.0.0.0:8004
