<?php
include ("header.php");
include ('leftside.php');
?>
<div id="page-wrapper">
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
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="form-horizontal" action="#">
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtSupplierName">Supplier Name</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtSupplierName" type="text" placeholder="Enter supplier name">
						 </div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtEmail">Email</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtEmail" type="email" placeholder="Enter email">
						 </div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtPhone">Phone</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtPhone" type="tel" placeholder="Enter phone number">
						 </div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtRegion">Region</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtRegion" type="text" placeholder="Enter region">
						 </div>
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