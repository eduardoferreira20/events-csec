# Required to work!
<br />

Installing laravel in project folder (`cmd` WINDOWS on ```XAMPP```)...
```
cd htdocs
composer create-project --prefer-dist laravel/laravel events-csec
```
<br />

After install, run the `git clone` command.

<br />

Run this command inside in project folder (`cmd` WINDOWS):
```
cd events-csec
composer require maddhatter/laravel-fullcalendar && composer require "laravelcollective/html":"^5.7"
```
<br />

Run this command inside in project folder (`cmd` WINDOWS):
```
cd events-csec
$ composer require simplesoftwareio/simple-qrcode

and 

cd events-csec
$ composer dumpautoload

```



## Don't forget!
- Create or use a database.
- Change the database configuration in `.env`.
- Execute ```php artisan migrate:refresh```.
- Execute ```composer dump-autoload```.
- Execute ```php artisan migrate:refresh --seed```.
- Execute ```php artisan db:seed --class=AddDummyEvent```.
