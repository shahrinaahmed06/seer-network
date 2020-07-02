<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">>
<head>
	<title>Search SEER Result Page</title>
</head>
<body>
	<h1><b>Source Information</b></h1>
	<br/>
<?php
	// sql info or use include 'file.inc'
       require_once('../../conf/sqlinfo.inc.php');

	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect($sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
	);
  
	// Checks if connection is successful
	if (!$conn) {
		// Displays an error message
		echo "<p>Database connection failure</p>";
	} else {
		// Upon successful connection
		
		// Get data from the form
		$technique = $_GET["technique"];
	
		// Set up the SQL command to retrieve the data from the table
		// % symbol represent a wildcard to match any characters
		// like is a compairson operator
		$query = "select source, title, author, published_year, technique, journal from seer where technique like '%$technique%'
		           AND published_year BETWEEN 1900 AND 2020";
		
		// executes the query and store result into the result pointer
		$result = mysqli_query($conn, $query);
		// checks if the execuion was successful
		if(!$result) {
			echo "<p>Something is wrong with ",	$query, "</p>";
		} else {
			// Display the retrieved records
			// retrieve current record pointed by the result pointer
			// Note the = is used to assign the record value to variable $row, this is not an error
			// the ($row = mysqli_fetch_assoc($result)) operation results to false if no record was retrieved
			// _assoc is used instead of _row, so field name can be used
			while ($row = mysqli_fetch_assoc($result)){
				echo "<p>Source  : {$row["source"]}","<br/>";
				echo "Title:",$row["title"],"</p>";
				echo "DOI : ",$row["journal"],"</p>";
				
				echo "<p>Author  : ",$row["author"],"<br/>";
				echo "Technique: ",$row["technique"],"<br/>";
				echo "Year : ",$row["published_year"],"</p>";
			}
			
			 
			//echo "</table>";
			// Frees up the memory, after using the result pointer
			mysqli_free_result($result);
		} // if successful query operation
		
		// close the database connection
		mysqli_close($conn);
	} // if successful database connection
	       
?>
</body>
</html>
		
	