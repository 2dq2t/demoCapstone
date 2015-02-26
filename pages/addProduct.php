<?php
include ("header.php");
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Add Product</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="#">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Add Product</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="form-horizontal" action="#">
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtProductName">Product Name</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtProductName" type="text" placeholder="Enter product name">
						 </div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtCategory">Category</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtCategory" type="text" placeholder="Enter category">
						 </div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtPrice">Price</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtPrice" type="number" placeholder="Enter price">
						 </div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtStatus">Status</label>
						<div class="col-lg-5">
						 <input class="form-control" id="txtStatus" type="text" placeholder="Enter Status">
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
</div>
<!-- /#wrapper -->
</body>
</html>