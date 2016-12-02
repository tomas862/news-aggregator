

## Instructions for launching the program

* you must have php installed on your server or in your local machine

* clone project
* rename .env.example to .env and start editing file
* change DB_DATABASE, DB_USERNAME and DB_PASSWORD in order to connect to database
* run "composer install" in terminal. If you do not have composer please download it from [Composer link](https://getcomposer.org/download/).
* run "php artisan migrate" to migrate all database tables needed for project
* run "php artisan serve" to launch website
* there might be a problem with ciphers. Google helps to solve this problem fast.
* to create admin user run "php artisan user:create"