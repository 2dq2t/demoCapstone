<?php
include ("header.php");
include ('leftside.php');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Product Info</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i>Product Info</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div id="ProductTableContainer" style="width: 100%;"></div>
			</div>
		</div>
	</div>
	<!-- /#container-fluid -->
</div>
<!-- /#page-wrapper -->

<script type="text/javascript" src="../jtable/jquery.jtable.min.js"></script>
<script type="text/javascript" language="javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#ProductTableContainer').jtable({
				title: 'Product Info',
				paging: true,
				sorting: true,
				defaultSorting: 'product_name DESC',
				actions: {
					listAction: 'productInfoActions.php?action=list',
					createAction: 'productInfoActions.php?action=create',
					updateAction: 'productInfoActions.php?action=update',
					deleteAction: 'productInfoActions.php?action=delete'
				},
				fields: {
					product_id:{
							key: true,
							edit:false,
							list:false,
							title:'Index',
							width:'10%'
						},
					product_name: {
						title:'Product Name',
						width:'30%',
						inputClass: 'validate[required]'
					},
					category: {
						title: 'Category',
						width: '30%',
						inputClass: 'validate[required]'
					},
					price: {
						title: 'Price',
						width: '15%',
						inputClass: 'validate[required] custom[number] min[0]'
					},
					status: {
						title: 'Status',
						width: '15%',
						inputClass: 'validate[required]custom[interger] min[0]'
					}
				},
				formCreated: function (event, data) {
	                data.form.validationEngine();
	            },
	            //Validate form when it is being submitted
	            formSubmitting: function (event, data) {
	                return data.form.validationEngine('validate');
	            },
	            //Dispose validation logic when form is closed
	            formClosed: function (event, data) {
	                data.form.validationEngine('hide');
	                data.form.validationEngine('detach');
	            }
			});

			//Load person list from server
			$('#ProductTableContainer').jtable('load');

		});

	</script>
<?php
include ('footer.php');
?>