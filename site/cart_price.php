<html>
<body>
<meta name="Flowers" content="width=device.width, initial-scale=1">

<?php
	function ShowTotal($total_subtotal)
	{
		$total = $total_subtotal;
		
		echo "<table border='1'>
		<tr>
			<th>" . "Total:" . "</th>
			<th>\$" . number_format($total, 2) . "</th>
		</tr>";
	}
?>

</body>
</html>
