# Talent Savant

## Introductions

#### In this project uses texnologies:

- Laravel 5.5 in back-end (api) part
- AngularJs 1.6 in front-end parts (site, administrator and control-panel)
- MySql 5.6 - database

#### The project architecture is based on REST architecture and used next parts:

- Part of the site uses public API methods and provides general information to the user
- Cabinet of client (it's part of site) use API methods for client. For this part need authorization
- Part of the control consists of cabinet of the system administrator and cabinet of Talent-partner
- API - it's back-end core of project. Api provide security, role control of user and provide all logic of the project
- Database - save of the data

#### Project requirements:

- Git
- PHP - v7.0 and more
- Composer
- NodeJs - v7.0 and more
- Npm manager - v 5.0 and more
- Webpack - v 3.0 and more
- MySqlDB - 5.6 and more

Web Server - Apache2.4 or Nginx

## Web-server settings

On your web server, you must setup main domain (for site) and 2 subdomain for API and control panel

For example Apache2 config:

```
    <VirtualHost *:80>

        ServerAdmin admin@test.com

        ServerName api.talent.loc

        ServerAlias api.talent.loc

        DocumentRoot /var/www/talent/api

        <Directory "/var/www/talent/api">
    	AllowOverride all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/talent_error.log

        CustomLog ${APACHE_LOG_DIR}/talent_access.log combined

    </VirtualHost>

    <VirtualHost *:80>

        ServerAdmin admin@test.com

        ServerName admin.talent.loc

        ServerAlias admin.talent.loc

        DocumentRoot /var/www/talent/admin/dist

        <Directory "/var/www/talent/admin/dist">
    	AllowOverride all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/talent_error.log

        CustomLog ${APACHE_LOG_DIR}/talent_access.log combined

    </VirtualHost>

    <VirtualHost *:80>

        ServerAdmin admin@test.com

        ServerName talent.loc

        ServerAlias talent.loc

        DocumentRoot /var/www/talent/site/dist

        <Directory "/var/www/talent/site/dist">
    	AllowOverride all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        CustomLog ${APACHE_LOG_DIR}/access.log combined

    </VirtualHost>


```

## Deploy API part of the project

To deploy the project API:

- Run ` git clone ` If you have cloned a project earlier - skip.
- Go to in the API folder.
- Run ` composer install `.
- After composer install copy ` .env.example ` to ` .env ` and in ` .env ` enter the database credentials.
    for example:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=talent
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

- Run ` php artisan migrate` (Deploy the DB)
- Run ` php artisan rbac-init ` (Create role system)
- Run ` php artisan user:create-admin ` (Create a default system administrator)

Swagger documentations you can use in ` http://<your_api_domain>/api/documentation `

## Deploy the Control-panel part (admin panel) and Site part

- Run ` git clone ` If you have cloned a project earlier - skip.
- Go to in the admin folder.
- Run ` npm install `
- Run into develop: ` npm run webpack-dev `
- Run into production: ` npm run webpack-build `

* Site url: ` http://<your_domain> `
* Admin url: ` http://<your_admin_domain> `