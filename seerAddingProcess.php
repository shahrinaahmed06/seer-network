<?php
  require_once ("../../conf/setting.php");
  $conn = @mysqli_connect(
    $sql_host,
    $sql_user,
    $sql_pass,
    $sql_db
  );

  if(!$conn){
    echo "<p>Connection failure</p>";
  }

  $sqlString = "CREATE TABLE IF NOT EXISTS seer (
    source VARCHAR(50) NOT NULL UNIQUE,
    technique VARCHAR(50) NOT NULL,
    title VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    journal VARCHAR(50) NOT NULL,
    volume VARCHAR(50) NOT NULL,
    published_year int NOT NULL,
    pages VARCHAR(20) NOT NULL,
    months VARCHAR(20) NOT NULL,
    publisher VARCHAR(20) NOT NULL,
    PRIMARY KEY (title) 
  )";
  $queryResult = @mysqli_query($conn, $sqlString) or
    die("Unable to execute the query." . mysqli_error($conn));

  if(isset ($_POST)){
    $source = $_POST["source"];
    $technique = $_POST["technique"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $journal = $_POST["journal"];
    $volume = $_POST["volume"];
    $published_year = $_POST["published_year"];
    $pages = $_POST["pages"];
    $months = $_POST["months"];
    $publisher = $_POST["publisher"];

    $sql = "INSERT INTO seer (source, technique, title, author, journal, volume, published_year, 
                              pages, months, publisher)
            VALUES('$source', '$technique', '$title', '$author', '$journal','$volume', '$published_year',
             '$pages', '$months', '$publisher')";

    if(mysqli_query($conn, $sql)){
        echo '<h2>Your record added successfully!</h2>';
    }
  }
?>