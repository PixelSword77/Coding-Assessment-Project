<html>
<body>

<style>
	th, td {
		padding: 10px;
	}
</style>

<?php

function OpenDatabaseConnection() {
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "products";
	$tablename = "products_list";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn -> connect_error) {
		die("Connection failed: " . $conn -> connection_error);
	}

	#echo "Connected successfully! <br>";
	
	return $conn;
}
?>

</body>
</html>
