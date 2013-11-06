<?php
session_start();

if (isset($_POST['userid']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $userid = $_POST['userid'];
  $password = $_POST['password'];

  //$db_conn = new mysqli('localhost', 'apnohe', 'o79gmtype', 'PROJECT2_NOHE');
Include "connection.php";

  if (mysqli_connect_errno()) {
   echo 'Connection to database failed:'.mysqli_connect_error();
   exit();
  }

  $query = 'select * from USERS '
           ."where name='$userid' "
           ." and password='$password'";

  $result = $db_conn->query($query);
  if ($result->num_rows >0 )
  {
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $userid;    
  }
  
  $levelquerys = "select `AL` from USERS where USERID='$userid' and PASSWORD='$password'";
  $resultq = $db_conn->query($levelquerys);
  $levelresult = mysql_fetch_assoc($result);
  $test = $levelresult['AL'];

if ($levelresult['AL'] == "2")
{
	$_SESSION['level'] = 2;
}
elseif ($levelresult['AL'] == "1")
{
	$_SESSION['level'] = 3;
}
else
{
	$_SESSION['level'] = 1;
}


  $db_conn->close();
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login Please</title>
<!--mstheme--><link rel="stylesheet" href="cany1011.css">
<meta name="Microsoft Theme" content="canyon 1011">
</head>

<table border="1" width="983" height="120">
	<tr>
		<td height="120" width="86" style="border-style: solid; border-width: 1px">
		<a href="index.html">
		<img border="0" src="globe.jpeg" width="128" height="128"></a></td>
		<td height="120" width="881">
		<p align="center"><font size="7">Login</font></td>
	</tr>
</table>

<body>
<?
 
  if (isset($_SESSION['valid_user']))
  {

    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';

    echo '<a href="logout.php">Log out</a><br />';
	
	echo '<a href="index.php">Click to enter the users page</a><br />';

  }

  else

  {

    if (isset($userid))

    {

      // if they've tried and failed to log in

      echo 'Could not log you in.<br />';

    }

    else
 
    {

      // they have not tried to log in yet or have logged out

      echo 'You are not logged in.<br />';

    }


    // provide form to log in
 
    echo '<form method="POST" action="index.php">';

    echo '<table>';

    echo '<tr><td>Userid:</td>';

    echo '<td><input type="text" name="userid"></td></tr>';

    echo '<tr><td>Password:</td>';

    echo '<td><input type="password" name="password"></td></tr>';

    echo '<tr><td colspan="2" align="center">';

    echo '<input type="submit" value="Log in"></td></tr>';

    echo '</table></form>';

  }

?>

<br />

</body>

</html>
