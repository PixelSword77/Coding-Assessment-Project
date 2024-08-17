<html>
<body>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	die("Connection failed: " . $conn -> connection_error);
}

echo "Connected successfully! <br>";

$sql = "Select * from testdata";
$result = $conn -> query($sql);

if($result -> num_rows > 0) {
	while($row = $result -> fetch_assoc()) {
		echo "Code: " . $row["productCode"] . " - Name: " . $row["productName"] . " - Price: " . $row["productPrice"] . "<br>";
	}
}
else {
	echo "No data in table";
}
$conn -> close();
?>

</body>
</html>
