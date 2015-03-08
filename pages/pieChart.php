<?php
include ("header.php");
include ('leftside.php');
?>
<link rel="stylesheet" type="text/css" href="../css/jqx.base.css">
<script src="../js/jqxcore.js" type="text/javascript" ></script>
<script src="../js/jqxcombobox.js" type="text/javascript" ></script>
<script src="../js/jqxgrid.js" type="text/javascript" ></script>
<script src="../js/jqxlistbox.js" type="text/javascript" ></script>
<script src="../js/jqxbuttons.js" type="text/javascript" ></script>
<script src="../js/jqxscrollbar.js" type="text/javascript" ></script>
<script src="../js/jqxdata.js" type="text/javascript" ></script>
<script src="../js/jqxgrid.selection.js" type="text/javascript" ></script>
<script src="../js/jqxgrid.aggregates.js" type="text/javascript" ></script>
<script src="../js/jqxgrid.sort.js" type="text/javascript" ></script>
<script src="../js/jqxmenu.js" type="text/javascript" ></script>
<script src="../js/jqxgrid.filter.js" type="text/javascript" ></script>
<script src="../js/jqxdropdownlist.js" type="text/javascript" ></script>
<script src="../js/highcharts.js" type="text/javascript" ></script>
<script src="../js/exporting.src.js" type="text/javascript" ></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		// prepare the data
		var supplierSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'supplier_id', type: 'number'},
			{ name: 'supplier_name', type: 'string'},
			{ name: 'email', type: 'string'},
			{ name: 'phone', type: 'number'}
			],
			url: "combobox_and_grid_supplier.php",
			async: false
		};

		var supplierDataAdapter = new $.jqx.dataAdapter(supplierSource);

		$("#suppliers").jqxComboBox(
		{
			width: 300,
			height: 25,
			source: supplierDataAdapter,
			
			promptText: 'Select an Supplier',
			selectedIndex: -1,
			displayMember: 'supplier_name',
			valueMember: 'supplier_id'
		});

		bindGrid();
		
		$("#suppliers").bind('select', function (event) {
			var supplier_id = event.args.item.value;
			bindGrid(supplier_id);
			pieChart(supplier_id);
			chartByProductPrice(supplier_id);
		});

		function bindGrid(supplier_id) {
			// prepare the data
			var salesSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'supplier_id', type: 'string', values: { source: supplierDataAdapter.records,  name: 'supplier_name' }},
				{ name: 'product_name', type: 'string'},
				{ name: 'quantity', type: 'number'},
				{ name: 'price', type: 'number'}
				],
				type: 'POST',
				data: {supplier_id:supplier_id},
				url: "combobox_and_grid_sales.php"
			};

			var salesdataAdapter = new $.jqx.dataAdapter(salesSource);

			$("#sales").jqxGrid({ 
				width: 850,
				height: 300,
				showstatusbar: true,
				sortable: true,
				filterable: true,
                statusbarheight: 50,
                showaggregates: true,
				source: salesdataAdapter,
				columns: 
				[
					{datafield: "supplier_id", text: "Supplier", width: '45%'},
					{datafield: "product_name", text: "Product Name", width: '25%', aggregates: ['count']},
					{datafield: "quantity", text: "Quantity", width: '15%', aggregates: ['min', 'max'],
                      aggregatesrenderer: function (aggregates) {
                          var renderstring = "";
                          $.each(aggregates, function (key, value) {
                              var name = key == 'min' ? 'Min' : 'Max';
                              renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value +'</div>';
                          });
                          return renderstring;
                      }
					},
					{datafield: "price", text: "Price", cellsformat: 'f2', width: '15%', aggregates: ['sum', 'avg']}
				]
			});
		}

		var optionsQuantity = {
			chart: {
                renderTo: 'chartContainer',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Supplier Sales'
            },
            tooltip: {
               pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        // formatter: function() {
                        //     return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        // }
                    	format: '<b>{point.name}</b>: {point.percentage:.2f} %',
	                    // style: {
	                    //     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                    // }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Agricultural',
                data: []
            }],
			exporting: {
				url: 'exporting-server/php/index.php'
			}
        }

        function pieChart(supplier_id) {
        	var url = "salesChartData.php?supplier_id=" + supplier_id;

        	$.getJSON(url, function(json) {
				optionsQuantity.series[0].data = json;
	        	chart = new Highcharts.Chart(optionsQuantity);
        	});
        }


        // Chart by the price of products 
        var optionsPrice = {
            chart: {
                renderTo: 'priceChartContainer',
                type: 'column',
            },
            title: {
                text: 'Product Price',
            },
            subtitle: {
                text: '',
            },
            xAxis: {
            	type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Price'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.2f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
            },
            legend: {
                enabled: false
            },
            series: [{
            	name: "Product",
            	colorByPoint: true,
            	data: []
            }]
        }

        function chartByProductPrice(supplier_id) {
	        $.getJSON("salesChartData.php?products=&supplier_id="+supplier_id, function(json) {
	        	optionsPrice.series[0].data = json;
		        chart = new Highcharts.Chart(optionsPrice);
	        });
    	}
	});
</script>
<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Statistic by Pie Chart</h2>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Pie Chart</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<label>Sales Statistic</label>
			<div class="col-lg-10 col-lg-offset-1">
				<div id="suppliers"></div>
				<div id="sales" style="margin-top: 20px; position: relative; left: 0px; top: 0px;"></div>
				<div id='chartContainer' style="margin-top: 50px; width: 850px; height: 400px; position: relative; left: 0px; top: 0px;"></div>
				<div id='priceChartContainer' style="margin-top: 50px; width: 850px; height: 400px; position: relative; left: 0px; top: 0px;"></div>
			</div>
		</div>
	</div>
	<!-- /#container-fluid -->
	<br/>
<br/>
<br/>
<br/>
</div>

<!-- /#page-wrapper -->
<?php 
include ('footer.php');
?>