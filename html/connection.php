<?php 
 // Connects to your Database
//Made global so easier access by Include function
global $connection;
global $db_conn;
$connection = mysql_connect("your.hostaddress.com", "username", "password") or die(mysql_error()); 
 mysql_select_db("Database_Name") or die(mysql_error());
$db_conn = new mysqli('localhost', 'apnohe', 'o79gmtype', 'PROJECT2_NOHE'); 
 ?> 