<?php
include ("header.php");
include ('leftside.php');
?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Suppliers Info</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i>Suppliers Info</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div id="SupplierTableContainer" style="width: 100%;"></div>
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
			$('#SupplierTableContainer').jtable({
				title: 'Suppliers Info',
				paging: true,
				sorting: true,
				defaultSorting: 'supplier_name DESC',
				actions: {
					listAction: 'suppliersInfoAction.php?action=list',
					createAction: 'suppliersInfoAction.php?action=create',
					updateAction: 'suppliersInfoAction.php?action=update',
					deleteAction: 'suppliersInfoAction.php?action=delete'
				},
				fields: {
					supplier_id:{
							key: true,
							edit:false,
							list:false,
							title:'Index',
							width:'10%'
						},
					supplier_name: {
						title:'Supplier Name',
						width:'30%',
						inputClass: 'validate[required]'
					},
					email: {
						title: 'Email',
						width: '30%',
						inputClass: 'validate[required]'
					},
					phone: {
						title: 'Phone',
						width: '15%',
						inputClass: 'validate[required] custom[number] minSize[10] maxSize[11]'
					},
					region: {
						title: 'Region',
						width: '15%',
						inputClass: 'validate[required]'
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
			$('#SupplierTableContainer').jtable('load');

		});

	</script>
<?php
include ('footer.php');
?>