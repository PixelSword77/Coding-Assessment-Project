<html>
<body>
<meta name="Flowers" content="width=device.width, initial-scale=1">
<style>
	.row {
		display: flex;
	}
	.column {
		flex: 50%;
	}
</style>


<?php # Initialize our database connection
	include 'db_connection.php';
	$conn = OpenDatabaseConnection();
?>

<header><h1>Dev Flower Company</h1></header>

<div class="row">
	<div class="colum" style="background-color:#bbb;"
		<header><h2>Products</h2></header>
		<?php # Draw a table listing all of our products
			include 'product_table.php';
			ShowProductTable($conn);
		?>
	</div>
	<div class="colum" style="background-color:#aaa;"
		<?php # Draw our cart and total
			include 'cart.php';
			$total_subtotal = ShowCart($conn);
			
			include 'cart_price.php';
			ShowTotal($conn, $total_subtotal);
		?>
	</div>
</div>

</body>
</html>
