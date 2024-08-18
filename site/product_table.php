<html>
<body>

<style>
	th, td {
		padding: 10px;
	}
</style>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "products";
$tablename = "products_list";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	die("Connection failed: " . $conn -> connection_error);
}

echo "Connected successfully! <br>";

$sql = "Select * from " . $tablename;
$result = $conn -> query($sql);

echo "<table border='1'>
	<tr>
		<th>Code</th>
		<th>Name</th>
		<th>Price</th>
	</tr>";

if($result -> num_rows > 0) {
	while($row = $result -> fetch_assoc()) {
		#echo "Code: " . $row["productCode"] . " - Name: " . $row["productName"] . " - Price: " . $row["productPrice"] . "<br>";
		echo "<tr>";
		echo "<td>" . $row["productCode"];
		echo "<td>" . $row["productName"];
		echo "<td>" . $row["productPrice"];
		echo "<tr>";
	}
}
else {
	echo "No data in table";
}

echo "</table>";

$conn -> close();
?>

</body>
</html>
