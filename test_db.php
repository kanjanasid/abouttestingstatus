<?php
	function search($txtin)
	{
		$server = "us-cdbr-iron-east-01.cleardb.net";
		$username = "b798786b8aa714";
		$password = "2e0e0451";
		$db = "heroku_ce52199dd4f50e1";
		$conn = new mysqli($server, $username, $password, $db);
		mysqli_query($conn, "SET NAMES utf8");	
		$sql_text = "SELECT * FROM inserttesting WHERE docnumber LIKE '%".$txtin."%'" ;
		$query = mysqli_query($conn,$sql_text);
		$num_result = mysqli_num_rows($query);
		if($num_result > 3)
		{
			$result = "https://abouttestingstatus.herokuapp.com/test-beer.php?keyword=".$txtin;
			return $result;
		}
		else
		{
			while ($obj_result = mysqli_fetch_array($query))
			{
				$result = $result."\n".$obj_result["devicetest"].$obj_result["teststatus"];
			}
			return $result;
		}
	}
 ?>