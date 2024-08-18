<html>
<body>
<meta name="Flowers" content="width=device.width, initial-scale=1">

<?php
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
		
		if(isset($_SESSION['cart']["RF1"]) && $_SESSION['cart']["RF1"] > 1) {
			$red_flower_discount = GetRedFlowerDiscount($conn);
			$total -= $red_flower_discount;
			
			echo "
			<tr>
				<th>" . "Red Flower Discount:" . "</th>
				<th>\$" . $red_flower_discount . "</th>
			</tr>";
		}
		
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
