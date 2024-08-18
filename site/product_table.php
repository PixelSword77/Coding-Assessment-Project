<html>
<body>

<style>
	th, td {
		padding: 10px;
	}
</style>

<?php

function ShowProductTable() {
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
			#echo "<tr>";
			#echo "<td>" . $row["productCode"];
			#echo "<td>" . $row["productName"];
			#echo "<td>" . $row["productPrice"];
			#<td> <form action='{$_SERVER['PHP_SELF']}'> <input type='submit' value='Add To Cart'> </form>;
			#echo "<tr>";
			
			echo "
				<tr>
					<td> {$row["productCode"]} </td>
					<td> {$row["productName"]} </td>
					<td> {$row["productPrice"]} </td>
					<td> 
						<form action='{$_SERVER['PHP_SELF']}'> 
							<input type='text' name='quantity' id='quantity'> 
							<input type='hidden' name='productCode' id='productCode' value='{$row["productCode"]}'> 
							<input type='submit' value='Add To Cart'> 
						</form> 
					</td>
				</tr>
			";
		}
	}
	else {
		echo "No data in table";
	}

	echo "</table>";

	$conn -> close();
}
?>

</body>
</html>
