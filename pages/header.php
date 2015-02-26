<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/custom.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><i class="fa fa-home"></i>
					&nbsp;Home</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
				</ul>
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-search" aria-hiden="true"></span>
					</button>
				</form>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li ><a href="#"><i
							class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
							<li><a href="javascript:;" data-toggle="collapse" data-target="#supplier"><i
							class="fa fa-fw fa-truck"></i> Sale<i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="supplier" class="collapse">
							<li><a href="#"><i class="fa fa-fw fa-truck"></i>Sale Info</a></li>
							<li><a href="addProductToSale.php"><i class="fa fa-fw fa-edit"></i>Add Product to Sale</a></li>
							</ul>
							</li>
							<li><a href="javascript:;" data-toggle="collapse" data-target="#supplier"><i
							class="fa fa-fw fa-table"></i> Supplier<i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="supplier" class="collapse">
							<li><a href="#"><i class="fa fa-fw fa-table"></i>Supplier Info</a></li>
							<li><a href="addSupplier.php"><i class="fa fa-fw fa-edit"></i>Add Supplier</a></li>
							</ul>
							</li>
							<li><a href="javascript:;" data-toggle="collapse" data-target="#product"><i
							class="fa fa-fw fa-table"></i> Product<i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="product" class="collapse">
							<li><a href="#"><i class="fa fa-fw fa-table"></i>Product Info</a></li>
							<li><a href="addProduct.php"><i class="fa fa-fw fa-edit"></i>Add Product</a></li>
							</ul>
							</li>
					<li><a href="javascript:;" data-toggle="collapse" data-target="#statistic"><i
							class="fa fa-fw fa-bar-chart-o"></i> Statistic<i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="statistic" class="collapse">
							<li><a href="#"><i class="fa fa-fw fa-bar-chart-o"></i>Pie Chart</a></li>
							<li><a href="#"><i class="fa fa-fw fa-bar-chart-o"></i>Line Chart</a></li>
							</ul>
							</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>