<?php
include ("header.php");
include ('leftside.php');
include '../includes/mysqli_connect.php';
?>
<script type="text/javascript">
$(document).ready(function() {
	var price;
	$(".products").change(function() {
		var id=$(this).val();
		if (id < 1) {
			var price1 = document.getElementById("price");
			price1.value = "";
			return;
		}
		
		var dataString = 'id='+ id;
		$.ajax ({
			type: "POST",
			url: "ajax_price.php",
			data: dataString,
			cache: false,
			success: function(html) {
				price = html;
				console.log(price);
				if ($("#txtQuantity").val() != "" && isInt($("#txtQuantity").val())) {
// 					alert($("#txtQuantity").val());
					var quantity = $("#txtQuantity").val();
					document.getElementById("price").value = quantity * html;
				} else {
					document.getElementById("price").value = html;
				}
			} 
		});
	});
	
	var inputs = $('input[id=txtQuantity]');
	inputs.on('keyup', function(e) {
		if ($("#txtQuantity").val() != "" && isInt($("#txtQuantity").val()) && $("#price").val() != "") {
			var quantity = $(this).val();
			console.log(price);
			if(price != undefined) {
				document.getElementById("price").value = quantity * price;
			}
		} else {
			if(price != undefined) {
				document.getElementById("price").value = price;
			}
		}
	});

	function isInt(value) {
	  return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
	}
});
</script>
<div id="page-wrapper">
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = array();
		
		if (isset($_POST['supplier']) && filter_var($_POST['supplier'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
			$supplier = $_POST['supplier'];
		} else {
			$errors[] = 'supplier_name';
		}
		
		if (isset($_POST['products']) && filter_var($_POST['products'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
			$product = $_POST['products'];
		} else {
			$errors[] = 'product_name';
		}
		
		if (isset($_POST['txtQuantity']) && filter_var($_POST['txtQuantity'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
			$quantity = $_POST['txtQuantity'];
		} else {
			$errors[] = 'quantity';
		}
		
		if (isset($_POST['price']) && filter_var($_POST['price'], FILTER_VALIDATE_FLOAT)) {
			$price = $_POST['price'];
		} else {
			$errors[] = 'price';
		}
		
		if (empty($errors)) {
			// Neu khong co loi xay ra, thi insert du lieu vao CSDL
			$query = "INSERT INTO suppliers_products (supplier_id, product_id, quantity, price) 
				VALUES ({$supplier}, {$product}, {$quantity}, {$price})";
			$result = mysqli_query($dbc, $query);
			
			if (mysqli_affected_rows($dbc) == 1) {
				$messages = "<p class='alert alert-success text-center'>The product to sales was added successful.</p>";
				$_POST = array();
			} else {
				$messages = "<p class='alert  alert-danger text-center'>The product to sales could not added due to a system error.</p>";
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
				<h2 class="page-header">Add Product to Sale</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Add Product to Sale</li>
				</ol>
			</div>
		</div>
		<?php if (!empty($messages)) echo $messages; ?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtSupplier">Supplier
							Name<span id="required">&nbsp;*</span>
						</label>
						<div class="col-lg-5">
							<select class="form-control" name="supplier">
								<option value="0">-Select Supplier-</option>
								<?php
									$q = "SELECT supplier_id, supplier_name FROM suppliers";
									$r = mysqli_query($dbc, $q) or die("Query {$q} \n<br/> MySQL Error: " . mysqli_error($dbc));
									if (mysqli_num_rows($r) > 0){
										while ($supplier = mysqli_fetch_array($r, MYSQLI_NUM)) {
											echo "<option value='{$supplier[0]}'";
												if (isset($_POST['supplier']) && ($_POST['supplier'] == $supplier[0])) echo "selected='selected'";
											echo ">".$supplier[1]."</option>";
										}
									}
								?>
							</select>
						</div>
						<?php
							if (isset($errors) && in_array('supplier_name', $errors)){
								echo "<span class='label label-danger'>Please select a supplier name</span>";
							} 
						?>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtProductName">Product
							Name<span id="required">&nbsp;*</span>
						</label>
						<div class="col-lg-5">
							<select class="form-control products" name="products">
								<option value="0">-Select Product-</option>
								<?php
									$q = "SELECT product_id, product_name FROM products";
									$r = mysqli_query($dbc, $q) or die("Query {$q} \n<br/> MySQL Error: " . mysqli_error($dbc));
									if (mysqli_num_rows($r) > 0){
										while ($products = mysqli_fetch_array($r, MYSQLI_NUM)) {
											echo "<option value='{$products[0]}'";
												if (isset($_POST['products']) && ($_POST['products'] == $products[0])) echo "selected='selected'";
											echo ">".$products[1]."</option>";
										}
									}
								?>
							</select>
						</div>
						<?php
							if (isset($errors) && in_array('product_name', $errors)){
								echo "<span class='label label-danger'>Please select a product name</span>";
							} 
						?>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="txtQuantity">Quantity<span id="required">&nbsp;*</span>
						</label>
						<div class="col-lg-5">
							<input class="form-control validate[required]"
								id="txtQuantity" name="txtQuantity" type="number"
								tabindex="3" placeholder="Enter quantity name"
								value="<?php if (isset($_POST['txtQuantity'])) echo strip_tags($_POST['txtQuantity']) ;?>" />
						</div>
						<?php
							if (isset($errors) && in_array('quantity', $errors)){
								echo "<span class='label label-danger'>Please enter valid quantity.</span>";
							} 
						?>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="price">Product
							Price<span id="required">&nbsp;*</span>
						</label>
						<div class="col-lg-5">
							<input class="form-control validate[required]"
								id="price" name="price" type="text"
								tabindex="4" placeholder="Enter price" 
								value="<?php if (isset($_POST['price'])) echo strip_tags($_POST['price']) ;?>" readonly />
						</div>
						<?php
							if (isset($errors) && in_array('price', $errors)){
								echo "<span class='label label-danger'>Please enter valid price.</span>";
							} 
						?>
					</div>
					<div class=form-group>
						<input type="submit" id="addSupplierProduct" value="Add"
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
<?php
include ('footer.php');
?>