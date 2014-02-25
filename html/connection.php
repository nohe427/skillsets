<?php 
 // Connects to your Database
//Made global so easier access by Include function
global $connection;
global $db_conn;
$connection = mysql_connect("localhost", "root", "SalisburyGeog3!") or die(mysql_error()); 
 mysql_select_db("skillset") or die(mysql_error());
$db_conn = new mysqli('localhost', 'root', 'SalisburyGeog3', 'skillset'); 
 ?> 