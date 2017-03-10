# CakeBlog

Developed by: [George Whitcher](http://georgewhitcher.com)

CakeBlog is an open source blogging software. Written by George Whitcher in PHP with the CakePHP framework. 

## Demo

[Demo](http://cakeblog.georgewhitcher.com/demo) - Demo for your viewing purposes. Please do not change passwords. Username:admin Password:admin.


## Auto Installation

* Download and upload files to your document root directory.  (Alternatively you can use composer "composer require gwhitcher/cakeblog".  Then copy the contents from your /vendor/gwhitcher/cakeblog/ directory to your document root).
* Setup database and user (with all privileges) on server and put that information in the config located in /config/app.default.php and rename the file to app.php.
* Configure settings in /config/cakeblog_config.default.php and rename to cakeblog_config.php.
* Open git bash and run "php composer.phar install".
* Now run the command "cake Migrations migrate".
* Make the /webroot/img/articles/ directory and it's subdirectories writable (CHMOD 777).
* Login to admin by visiting DOMAIN.COM/admin.
* Default username and password is admin:admin.
* Enjoy!

## Manual Installation

* Download the latest version of [CakePHP](https://github.com/cakephp/cakephp).
* Download the latest version of [CakeBlog](https://github.com/gwhitcher/CakeBlog).
* Upload CakePHP and then upload CakeBlog.  Overwriting any necessary files when copying CakeBlog.
* Setup database and user (with all privileges) on server and put that information in the config located in /config/app.default.php and rename the file to app.php.
* Import cakeblog.sql into created database.
* Configure settings in /config/cakeblog_config.php.
* Make the logs and tmp directories writable (CHMOD 777).
* Make the /webroot/img/articles/ directory and it's subdirectories writable (CHMOD 777).
* Login to admin by visiting DOMAIN.COM/admin.
* Default username and password is admin:admin.
* Enjoy!

## Additional Setup Instructions

* To get RoxyFileManager for TinyMCE to work in CakePHP you need to create a symbolic link from the directory (cakeblog/app/webroot/js/tinymce/plugins/fileman/Uploads) to the directory (cakeblog/app/webroot/img/articles/content).  When inserting links you can adjust the link which is inserted to http://domain.com/img/articles/content or leave the link the program entered as it will work either way.

* To get automatic updates simply fill out the configuration in /updater/config.php and visit the "Updater" section in the administration.

## Updating CakeBlog

CakeBlog can be updated two ways.  It is always important to update your website before updating.

* Open git bash and run "php composer.phar update".  Now copy the files from the vendor folder "cp -R /vendor/cakeblog/cakeblog/ /".  Run "bin/cake migrations migrate" to update your database.

* Login to the administration.  Choose the option "Update" on the navigation.  Click the Update button and it will do the rest.



## Get Support!

[Issues](https://bitbucket.org/gwhitcher/cakeblog/issues) - Got issues? Please tell me!
[CakeBlog](http://cakeblog.georgewhitcher.com) - CakeBlog Homepage.