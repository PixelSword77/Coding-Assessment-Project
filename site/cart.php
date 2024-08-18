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

<?php

echo "<form action='{$_SERVER['PHP_SELF']}'> 
	<input type='hidden' name='clearCart' id='clearCart' value='clearCart'> 
	<input type='submit' value='Clear Cart'> 
</form>";

SESSION_START();

if(!(isset($_SESSION['cart']))) {
	$_SESSION['cart'] = array();
}

if(isset($_GET['productCode'])) {
	$productCode = $_GET['productCode'];
	$quantity = $_GET['quantity'];
	
	if($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT)) {
		if(isset($_SESSION['cart'][$productCode])) {
			$_SESSION['cart'][$productCode] += $quantity;
		}
		else {
			$_SESSION['cart'][$productCode] = $quantity;
		}
	}
	else {
		echo "Please enter a valid integer as a quantity.";
	}
}

if(isset($_GET['clearCart'])) {
	$_SESSION['cart'] = array();
}

echo '<pre>';
print_r($_SESSION['cart']);	
echo '</pre>';

?>

</body>
</html>
