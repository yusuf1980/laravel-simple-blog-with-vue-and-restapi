# Laravel Simple Blog with Vue.js and RestAPI (Passport)

## Blog Laravel Vue.js API (How to Install)


    php artisan migrate --seed
    php artisan passport:install

Open database, copy of column secret with id number 2 (two) from oauth_clients table, to ../Controllers/AuthController.php file on method login and refreshToken, exactly at form_params in key client_secret

Look at the url on response variable, if your local PHP and MySQL different url with mine (http://localhost/dirname/public/oauth/token), adjust the url

#Usage
______

    php artisan serve
    access on browser to http://127.0.0.1:8000/

#Diagram Schema
______

File diagram_blog.png at main

<!-- ![IMAGE_DESCRIPTION](https://githu.com/yugojiro/simple-blog-laravel-vue/-/tree/maindiagram_blog.png) -->
