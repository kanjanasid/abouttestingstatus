php

$server = "us-cdbr-iron-east-01.cleardb.net";
 $username = "b798786b8aa714";
 $password = "2e0e0451";
 $db = "heroku_ce52199dd4f50e1";
 $conn = new mysqli($server, $username, $password, $db);
 mysqli_query($conn, "SET NAMES utf8");
 
 $sql_text = "SELECT * FROM contacttable";
 $query_text = mysqli_query ($conn,$sql_text);
 
 while($obj = mysquli_fetch_array($query_text))
 {
	 echo $obj["name"]." ".$obj["pea"];
 }