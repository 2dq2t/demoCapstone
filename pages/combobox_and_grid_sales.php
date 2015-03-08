<?php 
	include '../includes/mysqli_connect.php';
	include '../includes/functions.php';
	if (isset($_POST['supplier_id'])) {
		// Count total quantiry
		$query = "SELECT SUM(quantity) AS quantity_percent FROM suppliers_products WHERE supplier_id =".$_POST['supplier_id'];
		$result = mysqli_query($dbc, $query);
		confirm_query($result, $query);
		if (mysqli_num_rows($result) == 1) {
			$quantity_percent = mysqli_fetch_array($result);
		}

		$query = "SELECT sp.supplier_id, p.product_name, sp.quantity, p.price 
			FROM suppliers_products sp LEFT OUTER JOIN products p 
			ON sp.product_id = p.product_id 
			WHERE sp.supplier_id = ".$_POST['supplier_id']." ORDER BY sp.supplier_id";
		$result = mysqli_query($dbc, $query);
		confirm_query($result, $query);

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$sales[] = array(
				'supplier_id' => $row['supplier_id'],
				'product_name' => $row['product_name'],
				'quantity' => $row['quantity'],
				'quantity_percent' => number_format($row['quantity'] * 100/$quantity_percent['quantity_percent'], 2),
				'price' => $row['price']
				);
		}

		echo json_encode($sales, JSON_NUMERIC_CHECK);
	} else {

		$query = "SELECT sp.supplier_id, p.product_name, sp.quantity, p.price 
			FROM suppliers_products sp LEFT OUTER JOIN products p 
			ON sp.product_id = p.product_id 
			ORDER BY sp.supplier_id";
		$result = mysqli_query($dbc, $query);
		confirm_query($result, $query);

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$sales[] = array(
				'supplier_id' => $row['supplier_id'],
				'product_name' => $row['product_name'],
				'quantity' => $row['quantity'],
				'quantity_percent' => $row['quantity'],
				'price' => $row['price']
				);
		}

		echo json_encode($sales);
	}
	
?>