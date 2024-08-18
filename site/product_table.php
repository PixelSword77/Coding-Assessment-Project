<html>
<body>

<style>
	th, td {
		padding: 10px;
	}
</style>

<?php

# Function to display an HTML table of products using information from the products_list table in the products database
function ShowProductTable($conn) {
	$sql = "Select * from products_list";
	$result = $conn -> query($sql);

	echo "<table border='1'>
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Price</th>
		</tr>";

	if($result -> num_rows > 0) {
		while($row = $result -> fetch_assoc()) {
			echo "
				<tr>
					<td> {$row["productCode"]} </td>
					<td> {$row["productName"]} </td>
					<td> \${$row["productPrice"]} </td>
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
}
?>

</body>
</html>
