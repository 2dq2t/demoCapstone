<?php
include ("header.php");
include ('leftside.php');
include '../includes/mysqli_connect.php' ;
include '../includes/functions.php';
?>
<div id="page-wrapper">

	<?php
		 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		 	$errors = array();
		 	
		 	if (!empty($_POST['txtSupplierName'])) {
		 		$supplier_name = mysqli_real_escape_string($dbc, strip_tags($_POST['txtSupplierName']));
		 	} else {
		 		$errors[] = 'name';
		 	}
		 	
		 	if (isset($_POST['txtEmail']) && filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)) {
		 		$email = mysqli_real_escape_string($dbc, $_POST['txtEmail']);
		 	} else {
		 		$errors[] = 'email';
		 	}
		 	
		 	if (isset($_POST['txtPhone']) && preg_match("/^[0-9]{10,11}$/", $_POST['txtPhone'])) {
		 		$phone_number = $_POST['txtPhone'];
		 	} else {
		 		$errors[] = 'phone';
		 	}
		 	
		 	if (!empty($_POST['txtRegion'])) {
		 		$region = mysqli_real_escape_string($dbc, strip_tags($_POST['txtRegion']));
		 	} else {
		 		$errors[] = 'region';
		 	}
		 	
		 	if (empty($errors)) {
		 		// Neu khong co loi xay ra, bat dau chen du lieu vao CSDL
		 		$query = "INSERT INTO suppliers (supplier_name, email, phone, region) 
		 				VALUES ('{$supplier_name}', '{$email}', $phone_number, '{$region}')";
		 		$result = mysqli_query($dbc, $query);
		 		
		 		if (mysqli_affected_rows($dbc) == 1) {
		 			$messages = "<p class='alert alert-success text-center'>The supplier was added successful.</p>";
		 			$_POST = array();
		 		} else {
		 			$messages = "<p class='alert  alert-danger text-center'>The supplier could not added due to a system error.</p>";
		 		}
		 	} else {
		 		$messages = "<p class='alert alert-danger text-center'>Please fill in all the required fields.</p>";
		 	}
		 	
		 }
	?>
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Add Supplier</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Add Supplier</li>
				</ol>
			</div>
		</div>
		<?php if (!empty($messages)) echo $messages; ?>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtSupplierName">Supplier Name</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtSupplierName" name="txtSupplierName" type="text" placeholder="Enter supplier name" value="<?php if (isset($_POST['txtSupplierName'])) echo strip_tags($_POST['txtSupplierName']) ;?>">
						 </div>
						  <?php
							if (isset ( $errors ) && in_array ( 'name', $errors )) {
								echo "<span class='label label-danger'>Please fill in the supplier name</span>";
							}
							?>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtEmail">Email</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Enter email" value="<?php if (isset($_POST['txtEmail'])) echo strip_tags($_POST['txtEmail']) ;?>">
						 </div>
						  <?php
							if (isset ( $errors ) && in_array ( 'email', $errors )) {
								echo "<span class='label label-danger'>Please fill in the email</span>";
							}
							?>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtPhone">Phone</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtPhone" name="txtPhone" type="tel" placeholder="Enter phone number" value="<?php if (isset($_POST['txtPhone'])) echo strip_tags($_POST['txtPhone']) ;?>">
						 </div>
						  <?php
							if (isset ( $errors ) && in_array ( 'phone', $errors )) {
								echo "<span class='label label-danger'>Please enter valid phone (10 or 11 digit number)</span>";
							}
							?>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtRegion">Region</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtRegion" name="txtRegion" type="text" placeholder="Enter region" value="<?php if (isset($_POST['txtRegion'])) echo strip_tags($_POST['txtRegion']) ;?>">
						 </div>
						  <?php
							if (isset ( $errors ) && in_array ( 'region', $errors )) {
								echo "<span class='label label-danger'>Please fill in the region</span>";
							}
							?>
					</div>
					<div class=form-group>
						<input type="submit" id="addSupplier" value="Add" class="btn btn-default col-lg-offset-4">
						<input type="reset" id="reset" value="Reset" class=" btn btn-default">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /#container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php 
include ('footer.php');
?>