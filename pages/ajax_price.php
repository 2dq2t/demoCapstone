<?php
include '../includes/functions.php';
include '../includes/mysqli_connect.php';
if (isset ( $_POST ['id'] )) {
	$id = $_POST ['id'];
	$query = "SELECT price FROM products WHERE product_id = $id";
	$result = mysqli_query ($dbc, $query);
	confirm_query($result, $query);
	
	while ( $row = mysqli_fetch_array ( $result ) ) {
		$price = $row ['price'];
		echo $price;
	}
}
?>
