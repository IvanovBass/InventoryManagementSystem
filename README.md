Readme

## About Inventory Management  
Inventory Management is a user-friendly web application for retailers. It provides organizations with a digitalised process to register goods, suppliers and have an overview of the inventory stock levels.  

## Installation

1.Ensure that the following softwares are installed on your local machine: 
Composer (https://getcomposer.org/)
XAMPP (https://www.apachefriends.org/fr/index.html).

2.Install Composer and NPM dependencies, and create a copy of your .env file.
```
composer install && npm install && copy .env.example .env
```

3.Generate an app encryption key
```
 php artisan key:generate
 ```
 
4.Create an empty database for our application using the database tools you prefer (e.g. phpMyadmin).

5.In the .env file, add database information to allow Laravel to connect to the database.
In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.

6.Migrate the database.
```
composer dump-autoload && php artisan migrate --seed
```

7. Run the following command
```
php artisan serv
```

8.Configure your mail:
create an account on mailtrap (https://mailtrap.io/home). 
copy the SMTP settings values MAIL_USERNAME and MAIL_PASSWORD of your inbox (set for Laravel 7+) and replace these values in the .env file in the root directory of the project.

9. Use the app encryption key in your browser to access the inventory management website.

10. To log in as Admin use the following credentials:
```
username: admin@gmail.com
password: Admin@123456
```

To login as a user, sign in, confirm the email sent to through mailtrap and use your credentials to log in. 
