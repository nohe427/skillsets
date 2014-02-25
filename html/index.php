<?php
  session_start();

$username = $_POST['userid'];
$password = $_POST['password'];

if ($_SESSION['valid_user'])
{$login = TRUE;
}
else
{$login = FALSE;
}
if (!$login)
{
	//echo "Checking login";
	if($username && $password)
	{
			//$connect = mysql_connect('localhost', 'apnohe', 'o79gmtype') or die("Could not connect");
Include "connection.php";
			mysql_select_db("skillset") or die("Could not find the Database");
			
			$query = mysql_query("Select * From login WHERE USERID = '$username'");
			
			$numrows = mysql_num_rows($query);
			
			if($numrows != 0)
			{
				//echo "Entering While";
				while($row = mysql_fetch_assoc($query)){
					$dbusername = $row['USERID'];
					$dbpassword = $row['PASSWORD'];
					$dblevel = $row['AL'];
				}
				if($username == $dbusername && $password == $dbpassword)
				{
					$bool = TRUE;
					$_SESSION['valid_user'] = $dbusername;
					$_SESSION['level'] = $dblevel;
					//echo $_SESSION['valid_user'];
					//echo $_SESSION['level'];
				}
			}
			else {
				//die ("That user does not exist");
				$_SESSION['level'] = 3;
			}
	}
	else {
		//die ("Please enter a user name and password");
		$_SESSION['level'] = 3;
		
	}
}
$userid = $_SESSION['valid_user'];
?>
<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Home Page</title>
		<!--mstheme-->
		<link rel="stylesheet" href="cany1011.css">
		<meta name="Microsoft Theme" content="canyon 1011">
	</head>

<script type="text/javascript">
    var startTime = new Date();        //Start the clock!
    window.onbeforeunload = function()        //When the user leaves the page(closes the window/tab, clicks a link)...
    {
        var endTime = new Date();        //Get the current time.
        var timeSpent = (endTime - startTime);        //Find out how long it's been.
        var xmlhttp;        //Make a variable for a new ajax request.
        if (window.XMLHttpRequest)        //If it's a decent browser...
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();        //Open a new ajax request.
        }
        else        //If it's a bad browser...
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");        //Open a different type of ajax call.
        }
	//alert(timeSpent);
	var siteid = 1;
        var url = "SESSIONS.php?timein="+startTime;        //Send the time on the page to a php script of your choosing.
	var userid = "<?php echo $userid; ?>";
	var url2 = url+"&userid="+userid;
	var url3 = url2+"&timeout="+endTime;
	var url4 = url3+"&siteid="+siteid;
        xmlhttp.open("GET",url4,false);        //The false at the end tells ajax to use a synchronous call which wont be severed by the user leaving.
        xmlhttp.send(null);        //Send the request and don't wait for a response.
	
    }
//alert (startTime);
</script>

	<?php
  // check session variable

  if ($_SESSION['level'] == 1)
  {
?>
<table border="1" width="983" height="120">
	<tr>
		<td height="120" width="86" style="border-style: solid; border-width: 1px">
		<img border="0" src="Lower%20Shore%20Insurance%20Company%20Logo.png" width="128" height="128"></td>
		<td height="120" style="width: 3150px">
		<p align="center"><font size="7">Administrator Home Page</font></td>
		<td height="120" width="881">
		You are currently logged in&nbsp; as:<br>
		<br> <?php echo $_SESSION['valid_user'] ?>
		<br>
		<a href="logout.php">Logout</a></td>
	</tr>
</table>
<?php
echo '<p align="center">&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="Maintenance.php">Maint';
echo	'enace</a></font></li>';
echo'</ul>';
echo'<p>&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="Reports.php">Reports</a></font></li>';
echo'</ul>';
//echo '<p>'.$_SESSION['level'].'user</p>';
}

elseif ($_SESSION['level'] == 2)
  {
?>
<table border="1" width="983" height="120">
	<tr>
		<td height="120" width="86" style="border-style: solid; border-width: 1px">
		<img border="0" src="Lower%20Shore%20Insurance%20Company%20Logo.png" width="128" height="128"></td>
		<td height="120" style="width: 3150px">
		<p align="center"><font size="7">Agent Home Page</font></td>
		<td height="120" width="881">
		You are currently logged in&nbsp; as:<br>
		<br><?php echo $_SESSION['valid_user']; ?>
		<br>
		<a href="logout.php">Logout</a></td>
	</tr>
</table>
<?php
echo '<p align="center">&nbsp;</p>';
?>
<ul>
	<li>
	<p align="left"><font size="5">
	<a href="AllPolicies.php">All Policies</a></font></li>
</ul>
<?php
echo'<p>&nbsp;</p>';
?>
<ul>
	<li>
	<p align="left"><font size="5">
	<a href="AllAgents.php">All Agents</a></font></li>
</ul>
<p align="left">&nbsp;</p>
<ul>
	<li>
	<p align="left"><font size="5">
	<a href="AllCustomers.php">All Customers</a></font></li>
</ul>
<p align="left">&nbsp;</p>
<ul>
	<li>
	<p align="left"><font size="5">
	<a href="LocationInformation.php">All Locations</a></font></li>
</ul>
<p align="left">&nbsp;</p>
<ul>
	<li>
	<p align="left"><font size="5">
	<a href="PoliciesByCustomer.php">Policy By Customer</a></font></li>
</ul>
<p align="left">&nbsp;</p>
<ul>
	<li>
	<p align="left"><font size="5">
	<a href="claimsReports.php">Claims by Policy Number</a></font></li>
</ul>
<p align="left">&nbsp;</p>
<?php
//echo '<p>'.$_SESSION['level'].'user</p>';
}


elseif ($_SESSION['level'] == 4)
  {
?>
<table border="1" width="983" height="120">
	<tr>
		<td height="120" width="86" style="border-style: solid; border-width: 1px">
		<img border="0" src="Lower%20Shore%20Insurance%20Company%20Logo.png" width="128" height="128"></td>
		<td height="120" style="width: 3150px">
		<p align="center"><font size="7">Customer Home Page</font></td>
		<td height="120" width="881">
		You are currently logged in&nbsp; as:<br>
		<br><?php echo $_SESSION['valid_user']; ?>
		<br>
		<a href="logout.php">Logout</a></td>
	</tr>
</table>
<?php
echo '<p align="center">&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="FileAClaim.php">File a ';
echo	'claim</a></font></li>';
echo'</ul>';
echo'<p>&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="GetAQuote.php">Sign ';
echo	'Up!</a></font></li>';
echo'</ul>';
echo'<p>&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="BillPay.php">Pay a Bill</a></font></li>';
echo'</ul>';
//echo '<p>'.$_SESSION['level'].'user</p>';
}

  else
  {
echo '<table border="1" width="983" height="120">';
echo	'<tr>';
echo		'<td height="120" width="86" style="border-style: solid; border-width: 1px">';
echo		'<a href="Home.html">';
//This needs to be updated? Maybe?
echo		'<img border="0" src="Lower%20Shore%20Insurance%20Company%20Logo.png" width="128" height="128"></a></td>';
echo		'<td height="120" width="881">';
echo		'<p align="center"><font size="7">Unsuccessful Login</font></td>';
echo	'</tr>';
echo '</table>';
echo '<p align="center">&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="Login.php">Click here ';
echo	'to return to the login screen please</a></font></li>';
echo'</ul>';
echo'<p>&nbsp;</p>';
echo'<ul>';
echo	'<li><font size="5">';
echo	'<a href="Register.php">Click here ';
echo	'to register!</a></font></li>';
echo'</ul>';
echo'<p>&nbsp;</p>';
//echo '<p>'.$_SESSION['level'].'session</p>';
//echo $test;
}

 
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
//header("Cache-Control: no-cache"); 
//include("./connect.php");        //Connect to the database. 
//mysql_query("INSERT INTO `SESSIONS` (`Time`, 'USER', 'TIME2') VALUES ('".$_GET["time"]."', '".$_SESSION['valid_user']."', '2');");        //Add them to the db. 

?>
