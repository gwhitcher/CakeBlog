# CakeBlog

CakeBlog is an open source blogging software. Written by [George Whitcher](http://georgewhitcher.com) in PHP with the CakePHP framework.  CakeBlog like CakePHP requires [Composer](http://getcomposer.org)and PHP 5.6+.


## Installation

Download and copy contents to your root folder. 

Install [Composer](http://getcomposer.org).

Run `composer update` to install CakePHP.

Rename and configure the following files.
```bash
/config/app.default.php to /config/app.php (configuration required), cakeblog-config.default.php to cakeblog-config.php (configuration required), cakeblog-functions.default.php to cakeblog-functions.php (configuration is not required), /config/routes.default.php to /config/routes.php (configuration is not required)
```

Install MySQL database and administrator.
```bash
Once your /config/app.php is configured visit http://your-domain.com/install to setup your database tables and administration user. 
```

## Updating CakeBlog

Visit the Update section in the administration section of CakeBlog.  CakeBlog will run `composer update` as well as update your root files with the latest CakeBlog files.  

**NOTE:**
This is destructive. It is important not to make changes to the core CakeBlog files as they will be overwritten when updated.

## Get Support!

[Issues](https://github.com/gwhitcher/CakeBlog/issues) - Got issues? Please tell me!
[CakeBlog](http://georgewhitcher.com/projects/cakeblog) - CakeBlog Homepage.