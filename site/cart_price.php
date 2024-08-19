<html>
<body>
<meta name="Flowers" content="width=device.width, initial-scale=1">

<?php
# Function to display a table containing the total of the user's cart
function ShowTotal($conn, $total_subtotal)
{
	$total = $total_subtotal;
	$red_flower_discount = 0;
	$shipping_cost = 0;
	
	echo "<table border='1'>
		<tr>
			<th></th>
			<th></th>
		</tr>";
	
	# Calculate the total amount saved from the red flower discount and reduce the total by these savings
	if(isset($_SESSION['cart']["RF1"]) && $_SESSION['cart']["RF1"] > 1) {
		$red_flower_discount = GetRedFlowerDiscount($conn);
		$total -= $red_flower_discount;
		
		#Contextually add a row to the displayed table when we are receving a red flower discount
		echo "
		<tr>
			<th>" . "Red Flower Discount:" . "</th>
			<th>\$" . $red_flower_discount . "</th>
		</tr>";
	}
	
	# Update the shipping cost based on the new total of the part post-red-flower-discount
	if($total < 50) {
		$shipping_cost = 4.95;
	}
	else if($total < 90) {
		$shipping_cost = 2.95;
	}
	
	echo "
	<tr>
		<th>" . "Shipping Cost:" . "</th>
		<th>\$" . $shipping_cost . "</th>
	</tr>";
	
	echo "
	<tr>
		<th>" . "Total:" . "</th>
		<th>\$" . number_format($total + $shipping_cost, 2) . "</th>
	</tr>";
}

# Function to calculate the money saved from the red flower discount based on the current amount of flowers in the cart and the flower price
function GetRedFlowerDiscount($conn)
{
	$red_flower_quantity = $_SESSION['cart']["RF1"];
	
	$sql = "Select * from products_list where productCode = 'RF1'";
	$result = $conn -> query($sql);
	$row = mysqli_fetch_assoc($result);
	
	$red_flower_discount = (int)($red_flower_quantity / 2) * ((float)$row['productPrice'] / 2);
	return number_format($red_flower_discount, 2);
}
?>

</body>
</html>
