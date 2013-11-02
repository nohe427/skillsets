<?php

// Address error handling
ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);
//Attempt to Connect
//if ($connection = @mysql_connect ('localhost', 'apnohe', 'o79gmtype')){
//print '<p>Successfully connected to MySQL.</p>';
//}
//else {
//	die('<p>Could not connect to MySQL because: <b>' //.mysql_error() .
//	'</b></p>');
//}
Include "connection.php";
if (@mysql_select_db("PROJECT2_NOHE", $connection)){
	//print '<p>The flagg alexamara database has been selected.</p>';
}
else {
	die('<p>Cound not select the flagg alexamara database because: <b>' .mysql_error().'</b></p>');
}
$id = $_REQUEST['id'];
//Possibly change to "SELECT * FROM CLAIM WHERE CLAIM_NUM = ".$id." to carry over the variable?
$image = mysql_query("SELECT * FROM CLAIM WHERE CLAIM_NUM = $id");
$imageArray=mysql_fetch_assoc($image);
$image=$imageArray['PHOTO'];
echo $image;
$filename=$imageArray['filename'];
$ext=end(explode('.',$filename));
header("context-type:$ext");
echo $image;
?>
