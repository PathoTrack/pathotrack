# PathoTrack

- API (Based on Laravel 5)
- Web App (Based on EmberJS using ember-cli)

# Setup environment

- Fetch code, duh
- Follow below steps

## Install Dependencies

Run below commands on CMD 

- When in `/webapp` folder, `bower install` & `npm install`
- When in `/api` folder, `composer install`
- When in `/api` folder, `php artisan key:generate`

## Database Setup 

- Create `/api/.env` file using content of `/api/.env.sample`
- Update database name in `/api/.env` file

## Set Virtual Host

- Set virtual host for API project.
```
<VirtualHost *:80>
   ServerAdmin maulik.bengali@gmail.com
   DocumentRoot "D:/wamp/www/pathotrack/api/public"
   ServerName api.pathotrack.dev
   ErrorLog "logs/error.log"
   CustomLog "logs/access.log" common
   <Directory "D:/wamp/www/pathotrack/api/public">
       Options Indexes FollowSymLinks
       Order allow,deny
       Allow from all
       Require all granted
   </Directory>
</VirtualHost>
```
- Check response for the same by navigating to `api.pathotrack.dev' in browser.

## CORS issue

- Enable Headers modules in Apache

## cURL issue

- Download thread safe fixed php_curl extension from http://www.mediafire.com/file/3ay381k3cq59cm2/php_curl-5.4.3-VC9-x64.zip & copy paste in your php lib folder. Ref : http://www.anindya.com/php-5-4-3-and-php-5-3-13-x64-64-bit-for-windows
- If you are using WAMP, you may have to go to php.ini of php folder & enable cURL extension manually as WAMP uses different php.ini than syste,

## Migration commands

- To create a migration `php artisan make:migration create_users_table`
- Running all uutstanding migrations or if migrations table doen't exist in your DB `php artisan migrate`
- Rollback last migration operation `php artisan migrate:rollback`
- Rollback all migrations `php artisan migrate:reset`
- Rollback all migrations and run them all again `php artisan migrate:refresh`
- Rollback all migrations and run them all again with database seeding `php artisan migrate:refresh --seed`

## Seeding commands

- To seed data `php artisan db:seed`
- To seed data for particular table `php artisan db:seed --class=ClassName` ( NOTE: If any other table is dependant on the table in which you have seeded the data, then you have to seed the data of that table first.)
