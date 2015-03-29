<?php 
	// $servername = "localhost";
	// $user = "root";
	// $pass = "";
	// $dbname = "db_sportscience";

	// // Create connection
	// $conn = new mysqli($servername, $user, $pass, $dbname);

	// // Check connection
	// if ($conn->connect_error) {
	//     die("Connection failed: " . $conn->connect_error);
	// }

	mysql_connect('localhost','root','');

	mysql_select_db('db_sportscience');
?>