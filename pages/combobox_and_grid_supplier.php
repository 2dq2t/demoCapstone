<?php 
	include '../includes/mysqli_connect.php';
	include '../includes/functions.php';

	$query  = "SELECT DISTINCT(s.supplier_id), s.supplier_name, s.phone, s.email 
		FROM suppliers s LEFT OUTER JOIN suppliers_products sp 
		ON s.supplier_id = sp.supplier_id";
	$result = mysqli_query($dbc, $query);
	confirm_query($result, $query);

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$suppliers[] = array(
			'supplier_id' => $row['supplier_id'],
			'supplier_name' => $row['supplier_name'],
			'email' => $row['email'],
			'phone' => $row['phone']
			);
	}

	echo json_encode($suppliers);
?>