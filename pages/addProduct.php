<?php
include ("header.php");
include ('leftside.php');
include '../includes/mysqli_connect.php';
include '../includes/functions.php';
?>
<div id="page-wrapper">
<?php

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	// Neu gia tri ton tai, bat dau su ly form
	$errors = array ();
	
	if (! empty ( $_POST ['txtProductName'] )) {
		$product_name = mysqli_real_escape_string ( $dbc, strip_tags ( $_POST ['txtProductName'] ) );
	} else {
		$errors [] = 'productname';
	}
	
	if (! empty ( $_POST ['txtCategory'] )) {
		$category = mysqli_real_escape_string ( $dbc, strip_tags ( $_POST ['txtCategory'] ) );
	} else {
		$errors [] = 'category';
	}
	
	if (isset ( $_POST ['txtPrice'] ) && filter_var ( $_POST ['txtPrice'], FILTER_VALIDATE_FLOAT )) {
		$price = $_POST ['txtPrice'];
	} else {
		$errors [] = 'price';
	}
	
	if (isset ( $_POST ['txtStatus']) && filter_var($_POST['txtStatus'], FILTER_VALIDATE_INT) ) {
		$status = mysqli_real_escape_string ( $dbc, strip_tags ( $_POST ['txtStatus'] ) );
	} else {
		$errors [] = 'status';
	}
	
	if (empty ( $errors )) {
		// Neu khong co loi xay ra, bat dau chen du lieu vao CSDL
		$query = "INSERT INTO products (product_name, category, price, status) 
					VALUES ('{$product_name}', '{$category}', {$price}, '{$status}')";
		$result = mysqli_query ( $dbc, $query );
		confirm_query ( $result, $query );
		
		if (mysqli_affected_rows ( $dbc ) == 1) {
			$messages = "<p class='alert alert-success text-center'>The product was added successful.</p>";
			$_POST = array();
		} else {
			$messages = "<p class='alert  alert-danger text-center'>The product could not added due to a system error.</p>";
		}
	} else {
		$messages = "<p class='alert alert-danger text-center'>Please fill in all the required fields.</p>";
	}
} // End main IF
?>
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Add Product</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Add Product</li>
				</ol>
			</div>
		</div>
		<?php if (!empty($messages)) echo $messages; ?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form id="formID" class="form-horizontal" method="POST">

					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtProductName">Product
							Name<span id="required">&nbsp;*</span></label>
						<div class="col-lg-5">
							<input class="form-control validate[required]" id="txtProductName"
								name="txtProductName" type="text" tabindex="1"
								placeholder="Enter product name" value="<?php if (isset($_POST['txtProductName'])) echo strip_tags($_POST['txtProductName']) ;?>" />
						</div>
						 <?php
							if (isset ( $errors ) && in_array ( 'productname', $errors )) {
								echo "<span class='label label-danger'>Please fill in the product name</span>";
							}
							?>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtCategory">Category<span id="required">&nbsp;*</span></label>
						<div class="col-lg-5">
							<input class="form-control validate[required]" id="txtCategory" name="txtCategory"
								type="text" tabindex="2" placeholder="Enter category" value="<?php if (isset($_POST['txtCategory'])) echo strip_tags($_POST['txtCategory']) ;?>">
						</div>
						 <?php
							if (isset ( $errors ) && in_array ( 'category', $errors )) {
								echo "<span class='label label-danger'>Please fill in the category</span>";
							}
							?>
						 
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtPrice">Price<span id="required">&nbsp;*</span></label>
						<div class="col-lg-5">
							<input class="form-control validate[required] custom[number] min[0]" id="txtPrice" name="txtPrice"
								type="text" tabindex="3" placeholder="Enter price" value="<?php if (isset($_POST['txtPrice'])) echo strip_tags($_POST['txtPrice']) ;?>">
						</div>
						 <?php
							if (isset ( $errors ) && in_array ( 'price', $errors )) {
								echo "<span class='label label-danger'>Please fill in the price</span>";
							}
							?>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtStatus">Status<span id="required">&nbsp;*</span></label>
						<div class="col-lg-5">
							<input class="form-control validate[required] custom[integer] min[0]" id="txtStatus" name="txtStatus"
								type="text" tabindex="4" placeholder="Enter Status" value="<?php if (isset($_POST['txtStatus'])) echo strip_tags($_POST['txtStatus']) ;?>">
						</div>
						 <?php
							if (isset ( $errors ) && in_array ( 'status', $errors )) {
								echo "<span class='label label-danger'>Please fill in the status</span>";
							}
							?>
					</div>
					<div class=form-group>
						<input type="submit" id="addProduct" value="Add"
							class="btn btn-default col-lg-offset-4"> <input type="reset"
							id="reset" value="Reset" class=" btn btn-default">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /#container-fluid -->
</div>
<!-- /#page-wrapper -->
<script type = "text/javascript">
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});
</script>		
<?php 
include ('footer.php');
?>