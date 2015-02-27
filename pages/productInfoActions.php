<?php
include '../includes/mysqli_connect.php';
try
{

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$q = "SELECT product_id,product_name,category,price,status FROM products ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "";
		$result = mysqli_query($dbc,$q) or die ("Query error!".mysqli_error($dbc));
		
		//Add all records to an array
		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$q = "INSERT INTO products(product_name, category,price, status) VALUES('" . $_POST["product_name"] . "', '" . $_POST["category"]. "', '" . $_POST["price"] . "',".$_POST["status"].")";
		$result = mysqli_query($dbc,$q);
		
		//Get last inserted record (to return to jTable)
		$q = "SELECT * FROM products WHERE product_id = LAST_INSERT_ID()";
		$result = mysqli_query($dbc,$q);
		$row = mysqli_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$q = "UPDATE products SET product_name = '" . $_POST["product_name"] . "', category = '" . $_POST["category"]. "', price = " . $_POST["price"] . ", status = " . $_POST["status"] . " WHERE product_id = " . $_POST["product_id"] . "";
		$result = mysqli_query($dbc,$q);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$q = "DELETE FROM products WHERE product_id = " . $_POST["product_id"];
		$result = mysqli_query($dbc,$q);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>