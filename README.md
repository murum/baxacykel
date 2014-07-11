## Baxacykel

BaxaCykel är ett textbaserat online RPG spel.

För att visa att man är den bästa Baxaren så gäller det att man är strategisk, välplanerad och sist men inte minst nördig.

## REQUIRES
* Composer [Install](https://getcomposer.org/doc/00-intro.md)
* Node Package Manager (NPM)
* Bower [Install](http://bower.io/#install-bower)

## INSTALLATION
* run ``composer install`` to install Laravel and packages needed
* run ``npm install`` to install Grunt
* run ``bower install`` to install Frontend libraries such as Twitter Bootstrap, jQuery.
* run ``grunt`` from Terminal to start a grunt watcher to compile stylesheets and script files
* Be sure you now check the config files such as the Database in ``/app/config/database.php`` and the URLs in ``/app/config/app.php``.
* * You've to create the database before you try to create tables with the migration
* run ``php artisan migrate`` to create database tables
* run ``php artisan db:seed`` to seed the database tables