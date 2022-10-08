<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## General
Open API documentation can be found on http://localhost/api/docs. <br>
Generated json documentation is available at **_storage/api-docs/api-docs.json_** <br>
You need to start docker containers to view docs at the site.

## Local setup

1. Create .env
```shell
cp .env.example .env
```
2. Install dependencies
```shell
composer install
```
3. Generate app key
```shell
php artisan key:generate
```
4. Start docker containers 
```shell
./vendor/bin/sail up
```
