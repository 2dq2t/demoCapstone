<?php
include '../includes/mysqli_connect.php';
include '../includes/functions.php';

if (!isset($_GET['products']) && isset($_GET['supplier_id']) && filter_var($_GET['supplier_id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    // Count total quantiry
    $query = "SELECT SUM(quantity) AS quantity_percent FROM suppliers_products WHERE supplier_id =" . $_GET['supplier_id'];
    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);
    if (mysqli_num_rows($result) == 1) {
        $quantity_percent = mysqli_fetch_array($result);
    }

    $query = "SELECT sp.supplier_id, p.product_name, sp.quantity, p.price 
			FROM suppliers_products sp LEFT OUTER JOIN products p 
			ON sp.product_id = p.product_id 
			WHERE sp.supplier_id = ".$_GET['supplier_id']." ORDER BY sp.supplier_id";
    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    $rows = array();
	while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$row[0] = $r['product_name'];
		$row[1] = number_format($r['quantity'] * 100/$quantity_percent['quantity_percent'], 2);
		array_push($rows,$row);
	}
	echo json_encode($rows, JSON_NUMERIC_CHECK);
}

if (isset($_GET['products']) && isset($_GET['supplier_id']) && filter_var($_GET['supplier_id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
	$query = "SELECT sp.supplier_id, p.product_name, sp.quantity, p.price 
			FROM suppliers_products sp LEFT OUTER JOIN products p 
			ON sp.product_id = p.product_id 
			WHERE sp.supplier_id = ".$_GET['supplier_id']." ORDER BY sp.supplier_id";
    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    $rows = array();
	while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$row[0] = $r['product_name'];
		$row[1] = $r['price'];
		array_push($rows,$row);
	}
	echo json_encode($rows, JSON_NUMERIC_CHECK);
}
    
?> 
