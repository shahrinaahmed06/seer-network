<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="main.css">
		<title>Adding Result Page</title>
	</head>
	<body>
		<div id="textbox">
			<a href="#" onclick="history.back()"><img class="alignright" src="back.jpg" height="35px" width="35px"></a>
			//<h2 class="aligncenter"></h2>
			<a href="index.html"><img class="alignleft" src="home3.jpg" height="35px" width="35px"></a>
		</div>
	
<?php
  require_once ("../../conf/sqlinfo.inc.php");
  $conn = @mysqli_connect(
    $sql_host,
    $sql_user,
    $sql_pass,
    $sql_db
  );

  if(!$conn){
   echo "Connection failed";
  }

  $sqlString = "CREATE TABLE IF NOT EXISTS seer (
    source VARCHAR(50) NOT NULL,
    technique VARCHAR(50) NOT NULL,
    title VARCHAR(99) NOT NULL,
    author VARCHAR(99) NOT NULL,
    link VARCHAR(99) NOT NULL,
    published_year int NOT NULL,
    PRIMARY KEY (title) 
  )";
  $queryResult = @mysqli_query($conn, $sqlString) or
    die("Unable to execute the query." . mysqli_error($conn));

  if(isset ($_POST)){
    $source = $_POST["source"];
    $technique = $_POST["technique"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $link = $_POST["link"];
    $published_year = $_POST["published_year"];
    $results = $POST["results"];

    $sql = "INSERT INTO seer (source, technique, title, author, link, published_year, results)
    VALUES('$source', '$technique', '$title','$author', '$link', '$published_year', 'results')";

    if(mysqli_query($conn, $sql)){
        echo '<h2 class="aligncenter">Your record added successfully!</h2>';
    }
  }
?>
</body>
</html>