# CakeBlog

CakeBlog is an open source blogging software. Written by [George Whitcher](http://georgewhitcher.com) in PHP with the CakePHP framework.  CakeBlog like CakePHP requires [Composer](http://getcomposer.org) and PHP 5.6+.


## Installation
1. Download and copy contents to your root folder. 
1. Install [Composer](http://getcomposer.org).
1. Run `composer update` to install CakePHP.
1. Rename and configure the following files in your /config/ directory.
`app.default.php` to `app.php`,
`cakeblog-config.default.php` to `cakeblog-config.php`,
`cakeblog-functions.default.php` to `cakeblog-functions.php`, and
`routes.default.php` to `routes.php`
1. Create MySQL database and user and enter information in your app.php.
1. Run migrations by running `bin/cake migrations migrate`.
1. Mark the migration completed by running `bin/cake migrations mark_migrated`
1. You are now setup!  A default user `admin` and password `admin` is created by default.  Please login by visiting http://domain.com/admin and change this immediately.

## Updating CakeBlog
1. Login to your CakeBlog administration.
1. Go to `Update` on the menu and download the files automatically from the latest GIT repository.
1. Open terminal and run `bin/cake migrations migrate`.  To install any database changes.  It is also suggested you update your CakePHP installation as well `composer update`.

**NOTE:**
It is important NOT to make changes to the core CakeBlog files as they will be overwritten when updated.

## Get Support!

[Issues](https://github.com/gwhitcher/CakeBlog/issues) - Got issues? Please tell me!
[CakeBlog](http://georgewhitcher.com/projects/cakeblog) - CakeBlog Homepage.