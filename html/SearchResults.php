<?php
session_start();
Include "connection.php";
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Security Report</title>
<!--mstheme--><link rel="stylesheet" href="cany1011.css">
<meta name="Microsoft Theme" content="canyon 1011">
</head>
<!--
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
	var siteid = 11;
        var url = "SESSIONS.php?timein="+startTime;        //Send the time on the page to a php script of your choosing.
	var userid = "<?php echo $_SESSION['valid_user']; ?>";
	var url2 = url+"&userid="+userid;
	var url3 = url2+"&timeout="+endTime;
	var url4 = url3+"&siteid="+siteid;
        xmlhttp.open("GET",url4,false);        //The false at the end tells ajax to use a synchronous call which wont be severed by the user leaving.
        xmlhttp.send(null);        //Send the request and don't wait for a response.
	
    }
//alert (startTime);
</script>
<table border="1" width="983" height="120">
	<tr>
		<td height="120" width="86" style="border-style: solid; border-width: 1px">
		<a href="Home2.php">
		<img border="0" src="Lower%20Shore%20Insurance%20Company%20Logo.png" width="128" height="128"></a></td>
		<td height="120" style="width: 3150px">
		<p align="center"><font size="7">Security Report</font></td>
		<td height="120" width="881">
		You are currently logged in&nbsp; as:<br>
		<br><? echo $_SESSION['valid_user']; ?>
		<br>
		<a href="logout.php">Logout</a></td>
	</tr>
</table>
<body>

<form method="POST" action="Security.php">
	<p>&nbsp;&nbsp;&nbsp; USER NAME<input type="text" name="userid" size="20"></p>
	<p>&nbsp;</p>
	<blockquote>
		<blockquote>
			<blockquote>
				<p>&nbsp;</p>
				<p><input type="submit" value="Process" name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="reset" value="Reset" name="B2"></p>
			</blockquote>
		</blockquote>
	</blockquote>
</form>
-->
<?php
//Address Error Handling

ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);

//Attempt to Connect

//$connection = @mysql_connect ('localhost', 'apnohe', 'o79gmtype');



@mysql_select_db("PROJECT2_NOHE", $connection);

//Define the Owner Number php varaiable name

//$owner = $_POST['owner'];
//print "The owner number chosen was $owner<br />";
//$userid = $_POST['userid'];

//Define the query! banana banana banana;
$query = "SELECT * FROM `quick` WHERE `skill` = $_GET['selSkill'}";
/*
//output the resulting query table banana banana banana banana
if ($r = mysql_query($query))
{
	while ($row = mysql_fetch_array($r)){
		print
	"<p>{$row['OWNER_NUM']}<br/>{$row['LAST_NAME']}<br/>{$row['FIRST_NAME']}<br/>{$row['ADDRESS']}<br/>
		{$row['CITY']}<br/>{$row['STATE']}<br/>{$row['ZIP']}<br/></p>\n";}

}*/
//wraps text with HTML tag strong
function strong($text){
	return "<STRONG>$text</STRONG>\n";
}

//Ends default text with HTML tag BR  WITH A DEFAULT OF JUST BR
function linebreak($text="\n") {
    echo nl2br( $text );
}

/**
 * Create a dynamic table with headers based on the column names
 * from a query. It automatically creates the table and the correct
 * number of columns.
 */
createDynamicHTMLTable("SESSIONS", $query, $connection);

function createDynamicHTMLTable($table_name, $sql_query, $link)
{
    // execute SQL query and get result
    $sql_result = mysql_query($sql_query, $link); 
    if (($sql_result)||(mysql_errno == 0)) 
    {        
        echo "<DIV>\n";
        //linebreak( strong( sprintf("Table: \"%s\"", $table_name) ) );
        echo "<TABLE borderColor=#000000 cellSpacing=0 cellPadding=6 border=2>\n";
        echo "<TBODY>\n";
        if (mysql_num_rows($sql_result)>0) 
        { 
            //loop thru the field names to print the correct headers 
            $i = 0; 
            echo "<TR vAlign=top bgColor=#0EE40B>\n";
            while ($i < mysql_num_fields($sql_result)) 
            { 
                echo "<TH>". mysql_field_name($sql_result, $i) . "</TH>\n"; 
                $i++; 
            } 
            echo "</TR>\n"; 

            //display The data 
            while ($rows = mysql_fetch_array($sql_result,MYSQL_ASSOC)) 
            { 
                echo "<TR>\n"; 
                foreach ($rows as $data) 
                { 
                    echo "<TD align='center'>". $data . "</TD>\n"; 
                } 
                echo "</TR>\n"; 
            } 
        } else { 
            echo "<TR>\n<TD colspan='" . ($i+1) . "'>No Results found!</TD></TR>\n"; 
        } 
        
        echo "</TBODY>\n</TABLE>\n";
        echo "</DIV>\n";
    } else { 
        echo nl2br( sprintf( "Error in running query: %s\n", mysql_error()) ); 
    }
    mysql_free_result($sql_result);
    linebreak();
}
//banana banana banana banana banana

?>
</body>

</html>
