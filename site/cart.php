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

echo "<header><h2>Cart</h2></header>";

echo "<form action='{$_SERVER['PHP_SELF']}'> 
	<input type='hidden' name='clearCart' id='clearCart' value='clearCart'> 
	<input type='submit' value='Clear Cart'> 
</form>";

SESSION_START();

# Creates our session if it does not yet exist to store our cart
if(!(isset($_SESSION['cart']))) {
	$_SESSION['cart'] = array();
}

# Creates an HTML table using data from our session's cart and data from the products database
function ShowCart($conn) {
	echo "<table border='1'>
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Subtotal</th>
		</tr>";
	
	$total_subtotal = 0;
	
	foreach($_SESSION['cart'] as $key => $val) {
		$sql = "Select * from products_list where productCode = '$key'";
		$result = $conn -> query($sql);
		$row = mysqli_fetch_assoc($result);
		
		# Generates the subtotal of our current quantity for this key/product
		$product_subtotal = (float)$row['productPrice'] * $val;
		$total_subtotal += $product_subtotal;
		
		echo "
			<tr>
				<td>{$row['productName']}</td>
				<td>$val</td>
				<td>\$" . number_format($product_subtotal, 2) . "</td>
			</tr>";
	}
	
	return $total_subtotal;
}

# Adds to or sets the value of our products for an item when the Add to Cart button is pressed
function UpdateProductQuantity() {
	$productCode = $_GET['productCode'];
	$quantity = $_GET['quantity'];
	
	# Validates the customer's input as a valid integer before proceeding, else we throw an error message
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

# Clear the customer's sessions's cart
function ClearCart() {
	$_SESSION['cart'] = array();
}

if(isset($_GET['clearCart'])) {
	clearCart();
}

if(isset($_GET['productCode'])) {
	UpdateProductQuantity();
}


?>

</body>
</html>
