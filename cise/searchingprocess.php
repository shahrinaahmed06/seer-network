<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="main.css">
		<title>Search SEER Result Page</title>
	</head>
	<body>
		<div id="textbox">
			<a href="#" onclick="history.back()"><img class="alignright" src="back.jpg" height="35px" width="35px"></a>
			<h1 class="aligncenter">Source Information</h1>
			<a href="index.html"><img class="alignleft" src="home3.jpg" height="35px" width="35px"></a>
		</div>
	
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
				mysqli_connect_error();
				echo "<p>Database connection failure</p>";
			} else {
				$technique = $_GET["technique"];
				$published_year1 = $_GET["published_year1"];
				$published_year2 = $_GET["published_year2"];
				
				// Upon successful connection
				$query = "select source, title, author, published_year, technique, link , results from seer where technique like '".$technique."' AND published_year BETWEEN '".$published_year1."' AND '".$published_year2."'";
		
				//this includes the sort function php code which when the link of the table headers  are clicked adds Order By requested order to the query
				if ($_GET['sort'] == 'title')
				{
					$query .= " ORDER BY title";
				}
				elseif ($_GET['sort'] == 'link')
				{
					$query .= " ORDER BY link";
				}
				elseif ($_GET['sort'] == 'source')
				{
    				$query .= " ORDER BY source";
				}
				elseif ($_GET['sort'] == 'author')
				{
					$query .= " ORDER BY author";
				}
				elseif($_GET['sort'] == 'technique')
				{
					$query .= " ORDER BY technique";
				}
				elseif($_GET['sort'] == 'published_year')
				{
					$query .= " ORDER BY published_year";
				}
				// executes the query and store result into the result pointer
				$result = mysqli_query($conn, $query);
				// checks if the execuion was successful
				if(!$result) {
					echo "<p>Something is wrong with ",	$query, "</p>";
				} else {
					echo "<table border=\"1\">";
            		echo "<tr>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=source'>Source</a></th>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=technique'>Technique</a></th>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=title'>Title</a></th>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=author'>Author</a></th>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=link'>DOI</a></th>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=published_year'>Year</a></th>\n"
							."<th scope=\"col\"><a href='searchingprocess.php?sort=results'>Results</a></th>\n"
						."</tr>\n;
						<tr>\n";
						 
						 // retrieve current record pointed by the result pointer
						// Note the = is used to assign the record value to variable $row, this is not an error
						// the ($row = mysqli_fetch_assoc($result)) operation results to false if no record was retrieved
						// _assoc is used instead of _row, so field name can be used

					while ($row = mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>",$row["source"],"</td>";
						echo "<td>",$row["technique"],"</td>";
						echo "<td>",$row["title"],"</td>";
						echo "<td>",$row["author"],"</td>";
                        echo "<td>",$row["link"],"</td>";
						//echo "<td><a href=",$row["link"],"</a></td>";
						echo "<td>",$row["published_year"],"</td>";
						echo "<td>",$row["results"],"</td>";
						echo "</tr>";
					}
					echo "</table>";
					// Frees up the memory, after using the result pointer
					mysqli_free_result($result);
				} // if successful query operation
		
				// close the database connection
				mysqli_close($conn);
			} // if successful database connection   
		?>
		<footer>© Created with love from students of AUT</footer>
	</body>
</html>	