Yii2 Demo
==========

Installation and getting started:
---------------------------------

1. Run the following commands to install Yii2 Demo:

    `
    php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta3"
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
   - `php yii rbac/rbac/init`
   - This will create tables needed for the application to work.
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

Notes:
------

By default will be created one super admin user with login `admin` and password `admin12345`, you can use this data to sing in application frontend and backend.

Themes:
-------
- Application backend it's based on "AdminLTE" template. More detail about this nice template you can find [here](http://www.bootstrapstage.com/admin-lte/).
- Application frontend it's based on "Flat Theme". More detail about this nice theme you can find [here](http://shapebootstrap.net/item/flat-theme-free-responsive-multipurpose-site-template/).