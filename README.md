Yii2 Demo
==========

Installation and getting started:
---------------------------------

1. Run the following commands to install Yii2 Demo:

    `
    php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta2"
    `

    `
    git clone https://github.com/alexandrSS/demo.loc.git
    `

    `
    composer install
    `
2. Run command: `cd /my/path/to/demo.loc/` and go to main application directory.
3. Run command: `php requirements.php` and check the requirements.
4. Run command: `php init` to initialize the application with a specific environment.
5. Create a new database and adjust it configuration in `common/config/db.php` accordingly.
6. Apply migrations with console commands:
   - `php yii migrate`
   - This will create tables needed for the application to work.
   - You also can use database dump `db.sql` from `my/path/to/yii2-start/common/data`, but however I recommend to use migrations.
7. Set document roots of your Web server:

  **For Apache:**
    
  ```
  <VirtualHost *:80>
      ServerName www.demo.loc # You need to change it to your own domain
	  ServerAlias demo.loc # You need to change it to your own domain
	  DocumentRoot /my/path/to/demo.loc # You need to change it to your own path
	  <Directory /my/path/to/demo.loc> # You need to change it to your own path
		  AllowOverride All  
	  </Directory>  
  </VirtualHost>
  ```  
  - Use the URL `http://demo.loc` to access application frontend.
  - Use the URL `http://demo.loc/backend/` to access application backend.
  
  **For Nginx:**
  
    ___Frontend___
    
    ``` 
    server {
        charset utf-8;
        client_max_body_size 128M;

        listen 80; ## listen for ipv4
        # listen [::]:80 ipv6only=on; ## listen for ipv6

        set $yii2DemoRoot '/my/path/to/demo.loc'; ## You need to change it to your own path

        server_name demo.loc; ## You need to change it to your own domain
        root $yii2DemoRoot/frontend/web;
        index index.php;

        #access_log  $yii2DemoRoot/log/frontend/access.log;
        #error_log   $yii2DemoRoot/log/frontend/error.log;

        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php?$args;
        }

        location /statics {
            alias $yii2DemoRoot/statics/web/;
        }

        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;

        location ~ \.php$ {
            #include fastcgi_params;
            include fastcgi.conf;
            fastcgi_pass   127.0.0.1:9000;
            #fastcgi_pass unix:/var/run/php5-fpm.sock;
            try_files $uri =404;
        }

        location ~ /\.(ht|svn|git) {
            deny all;
        }
    }
    ```
    
    __Backend__
    
    ```
    server {
        charset utf-8;
        client_max_body_size 128M;

        listen 80; ## listen for ipv4
        # listen [::]:80 ipv6only=on; ## listen for ipv6

        set $yii2DemoRoot '/my/path/to/demo.loc'; ## You need to change it to your own path
        
        server_name backend.demo.loc; ## You need to change it to your own domain
        root $yii2DemoRoot/backend/web;
        index index.php;

        #access_log  $yii2DemoRoot/log/backend/access.log;
        #error_log   $yii2DemoRoot/log/backend/error.log;

        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php?$args;
        }

        location /statics {
            alias $yii2DemoRoot/statics/web/;
        }

        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;

        location ~ \.php$ {
            #include fastcgi_params;
            include fastcgi.conf;
            fastcgi_pass   127.0.0.1:9000;
            #fastcgi_pass unix:/var/run/php5-fpm.sock;
            try_files $uri =404;
        }

        location ~ /\.(ht|svn|git) {
            deny all;
        }
    }
    ```
    
    **Remove `'baseUrl' => '/backend'` from `/my/path/to/demo.loc/backend/config/main.php`.**
    
    - Use the URL `http://demo.loc` to access application frontend.
    - Use the URL `http://backend.demo.loc` to access application backend.

Notes:
------

By default will be created one super admin user with login `admin` and password `admin12345`, you can use this data to sing in application frontend and backend.

Themes:
-------
- Application backend it's based on "AdminLTE" template. More detail about this nice template you can find [here](http://www.bootstrapstage.com/admin-lte/).
- Application frontend it's based on "Flat Theme". More detail about this nice theme you can find [here](http://shapebootstrap.net/item/flat-theme-free-responsive-multipurpose-site-template/).