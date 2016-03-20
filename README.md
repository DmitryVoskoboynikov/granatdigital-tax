Таксообмен
========================

TAX базируется на [Yii2](https://github.com/yiisoft/yii2) PHP фреймворке.
Используется Twig Extension for Yii 2 - https://github.com/yiisoft/yii2-twig

1. Требования
----------------------------------
    - php 5.6
    - mysql 5.x
    - memcached
    - php5-dev 
    - libmemcache-dev
    

2. Установка
----------------------------------

Код проекта находится на [bitbucket](git@bitbucket.org:granatdigital/tax.git). 

### 2.1 Копирование репозитория

```
    cd /var/www
    git clone git@bitbucket.org:granatdigital/tax.git
    cd tax
```

Бренч по умолчанию ```develop```. 

### 2.2 Создание файла конфигурации db

```
    cp config/db.php.sample config/db.php
```

Отредактируйте полученный файл с указанием своих данных подключения к mysql

### 2.3 Установка зависимостей

Для установки зависимостей потребуется менеджер зависимостей [http://getcomposer.org/](http://getcomposer.org/). Вы можете установить его выполнив команду:

```
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
```

После установки composer, запустите установку зависимостей:

```
    composer global require "fxp/composer-asset-plugin:~1.0.0"
    composer install
```

### 2.4 Проверка конфигурации

Выполните в консоли

```
    php requirements.php
```

Устраните все Warnings и Errors

### 2.5 Создание базы данных

```
    ./yii migrate
```

### 2.6 Конфигурация веб-сервера

`APPLICATION_ENV` - требуется выставить prod или dev. Если неуказано, используется dev окружение.

Apache2 

```
<VirtualHost *:80>
    ServerName tax
    DocumentRoot /path/to/tax/web
    SetEnv APPLICATION_ENV "prod"
    <Directory "/path/to/tax/web/">
        Options Indexes MultiViews FollowSymLinks
        AllowOverride All
        Order deny,allow
        Deny from all
        Allow from all
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
    </Directory>
</VirtualHost>
```

или Nginx

```
    server {
        charset utf-8;
        client_max_body_size 128M;
    
        listen 80; ## listen for ipv4
        #listen [::]:80 default_server ipv6only=on; ## list	en for ipv6
    
        server_name tax;
        root        /path/to/tax/web;
        index       index.php;
    
        #access_log  /path/to/basic/log/access.log;
        #error_log   /path/to/basic/log/error.log;
    
        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php?$args;
        }
    
        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;
    
        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
            fastcgi_param   APPLICATION_ENV  prod;
            fastcgi_pass   127.0.0.1:9000;
            #fastcgi_pass unix:/var/run/php5-fpm.sock;
            try_files $uri =404;
        }
    
        location ~ /\.(ht|svn|git) {
            deny all;
        }
    }
```

### 2.7 Конфигурация crontab
Необходимо отредактировать crontab 
Команда  ```crontab -e```
Добавить следующее:
    `` * * * * * php /path/to/yii yii schedule/run --scheduleFile=@path/config/schedule.php 1>> /dev/null 2>&1``

### 2.8 Установка memcache
```
    apt-get install memcached
	apt-get install php5-dev libmemcache-dev php5-memcached
```