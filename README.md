# Laravel Blog Site With Sematic Version
This is built on Laravel Framework 8.5 This was built for demonstrate purpose.

## Purpose
The main purpose of this demo to show Add, Edit, Delete Product & Delete Products

## Installation

Clone the repository-
```
https://github.com/growexx/blog_site
```

Then cd into the folder with this command-
```
cd blog_site
```


Then create a environment file using this command-
```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_USERNAME`, `DB_PASSWORD`).

Then create a database named `bucket_test` and then do a database migration using this command-
```
php artisan migrate
```


At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

## Run server

Run server using this command-  
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the Front End. 


## After that 

Click on suggestions Balls and Bucket and see the outputs after entering suggestions red, blue,green Balls. And then click on suggestions. after that you will got a proper output with sugesstions.


