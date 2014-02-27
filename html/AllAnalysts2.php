<?php
Include "connection.php";
//Insert Query for Maintenance  INSERT INTO `quick`(`who`, `skill`, `tier`) VALUES ("Alexander N", "Math", "3")
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Reports</title>
<!--mstheme--><link rel="stylesheet" href="cany1011.css">
<meta name="Microsoft Theme" content="canyon 1011">

</head>


<body>
<h1>Tier refers to the level of the anlyst skill</h1><br>
<h2>Tier 3 is primary</h2><br>
<h2>Tier 2 is secondary</h2><br>
<h2>Tier 1 is tertiary</h2><br>

    <form action="AllAnalysts2.php" method="post" name="test" >
<select name="skill" onChange="this.form.submit();">
<?php 
$sql = mysql_query("SELECT DISTINCT `skill` FROM `quick` ORDER BY `quick`.`skill` ASC;");
while ($row = mysql_fetch_array($sql)){
echo "<option value=".$row['skill'].">" . urldecode($row['skill']) . "</option>";
}
?>
</select>
</form>

<?php
//Address Error Handling

ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);

//Attempt to Connect

//$connection = @mysql_connect ('localhost', 'apnohe', 'o79gmtype');

@mysql_select_db('skillset', $connection);

//wraps text with HTML tag strong
function strong($text){
	return "<STRONG>$text</STRONG>\n";
}

//Ends default text with HTML tag BR  WITH A DEFAULT OF JUST BR
function linebreak($text="\n") {
    echo nl2br( $text );
}

$value = $_POST['skill'];

if (isset($_POST['skill'])) {
    $queryStr = "SELECT * FROM `quick` WHERE `skill` =\"".$value."\";";
}
else{
    $value = $_POST['skill'];
    $queryStr = "SELECT * FROM `quick`;";
}
/**
 * Create a dynamic table with headers based on the column names
 * from a query. It automatically creates the table and the correct
 * number of columns.
 */
createDynamicHTMLTable("quick", $queryStr, $connection);

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
                    echo "<TD align='center'>". urldecode($data) . "</TD>\n"; 
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






<!--<button type="button" onclick="change()">Refresh</button>-->

<script>
function change(){
    document.getElementById("myform").submit();
}
</script>

<?php

$S_ID = $_POST['']

?>
</body>

</html>
