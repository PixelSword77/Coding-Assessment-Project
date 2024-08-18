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

<header><h1>Dev Flower Company</h1></header>

<div class="row">
	<div class="colum" style="background-color:#bbb;"
		<header><h2>Products</h2></header>
		<?php
			include 'product_table.php';
			ShowProductTable();
		?>
	</div>
	<div class="colum" style="background-color:#aaa;"
		<header><h2>Cart</h2></header>
		<?php include 'cart.php' ?>
	</div>
</div>

</body>
</html>
