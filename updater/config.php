<?php
//CONFIG
$zip_url = 'https://github.com/gwhitcher/CakeBlog/archive/'; //URL TO ZIP
$zip_name = 'master.zip'; //ZIP FILENAME
$src_dir = 'CakeBlog-master'; //SOURCE DIRECTORY (the name of the root folder in the zip)
$dest_dir = '../'; //DESTINATION DIRECTORY
$mysql_dir = ''.$dest_dir.'updater/mysql/';
$mysql_order = 0; //CHANGE TO 1 TO REVERSE ORDER

//MYSQL DO NOT EDIT!
$myFile = "../config/app.php";
$lines = file($myFile);
$cakemysqlusername = $lines[221];
$cakemysqlusernameclean = substr($cakemysqlusername, 27, -3);
$cakemysqlpassword = $lines[222];
$cakemysqlpasswordclean = substr($cakemysqlpassword, 27, -3);
$cakemysqldatabase = $lines[223];
$cakemysqldatabaseclean = substr($cakemysqldatabase, 27, -3);

$servername = "localhost";
$username = $cakemysqlusernameclean;
$password = $cakemysqlpasswordclean;
$dbname = $cakemysqldatabaseclean;