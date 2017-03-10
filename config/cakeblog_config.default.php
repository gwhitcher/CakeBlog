<?php
//ADDS CONFIGURE TO ALL VIEWS
class_alias('Cake\Core\Configure', 'Configure');

//LOAD PLUGINS
//CakePlugin::load('DebugKit');

//CUSTOM VALUES
Configure::write('BASE_URL', 'http://gwhitcher-pc/cakeblog3');
Configure::write('site_title', 'CakeBlog');
Configure::write('sub_title', 'An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.');
Configure::write('metadescription', 'An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.');
Configure::write('metakeywords', 'cakeblog, cakephp, blog, open source blog, George Whitcher');
Configure::write('cakeblog_contact_email', 'admin@admin.com');
Configure::write('cakeblog_theme', 'default');

include('cakeblog_functions.php');
include('cakeblog_version.php');