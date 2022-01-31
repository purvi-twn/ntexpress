<?php /*?><!DOCTYPE HTML>
<html>
<head>
<?php 
$jan='111338'; ?>
<script>
window.onload = function () {
//Better to construct options first and then pass it as a parameter
var options = {
	animationEnabled: true,
	title:{
		text: "Monthly Report"   
	},
	axisY:{
		title:"Amount in Rs."
	},
	toolTip: {
		shared: true,
		reversed: true
	},
	data: [{
		type: "stackedColumn",
		name: "Income",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: <?php echo $jan?> , label: "USA" },
			{ y: 49088, label: "Russia" },
			{ y: 62200, label: "China" },
			{ y: 90085, label: "India" },
			{ y: 38600, label: "Australia" },
			{ y: 48750, label: "SA" }
		]
	},
	{
		type: "stackedColumn",
		name: "Expenses",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: 135305 , label: "USA" },
			{ y: 107922, label: "Russia" },
			{ y: 52300, label: "China" },
			{ y: 3360, label: "India" },
			{ y: 39900, label: "Australia" },
			{ y: 0, label: "SA" }
		]
	},
	{
		type: "stackedColumn",
		name: "Zakath",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: 135305 , label: "USA" },
			{ y: 107922, label: "Russia" },
			{ y: 52300, label: "China" },
			{ y: 3360, label: "India" },
			{ y: 39900, label: "Australia" },
			{ y: 0, label: "SA" }
		]
	},
	{
		type: "stackedColumn",
		name: "Profit",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: 135305 , label: "USA" },
			{ y: 107922, label: "Russia" },
			{ y: 52300, label: "China" },
			{ y: 3360, label: "India" },
			{ y: 39900, label: "Australia" },
			{ y: 0, label: "SA" }
		]
	}]
};

$("#chartContainer").CanvasJSChart(options);
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<?php include("footer.php"); ?>
<!--<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>-->
<!--<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>-->
<script type="text/javascript" src="<?php echo $site_url; ?>js/jquery.canvasjs.min.js"></script>
</body>
</html><?php */?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var options = {
	animationEnabled: true,
	title:{
		text: "Sales at Different Regions"
	},
	axisY :{
		valueFormatString: "#0,.",
		prefix: "$",
		suffix: "k",
		title: "Sales"
	},
	toolTip: {
		shared: true
	},
	data: [{
		type: "stackedArea",
		showInLegend: true,
		name: "Central",
		xValueFormatString: "MMM YYYY",
		yValueFormatString: "$#,###",
		dataPoints: [
			{ x: new Date(2017, 0), y: 90000 },
			{ x: new Date(2017, 1), y: 83000 },
			{ x: new Date(2017, 2), y: 97000 },
			{ x: new Date(2017, 3), y: 175000 },
			{ x: new Date(2017, 4), y: 148000 },
			{ x: new Date(2017, 5), y: 93000 },
			{ x: new Date(2017, 6), y: 131000 },
			{ x: new Date(2017, 7), y: 142000 },
			{ x: new Date(2017, 8), y: 156000 },
			{ x: new Date(2017, 9), y: 134000 },
			{ x: new Date(2017, 10), y: 115000 },
			{ x: new Date(2017, 11), y: 98000 }
		]
	}, {
		type: "stackedArea",  
		name: "East",
		showInLegend: true,
		yValueFormatString: "$#,###",
		dataPoints: [
			{ x: new Date(2017, 0), y: 93000 },
			{ x: new Date(2017, 1), y: 99000 },
			{ x: new Date(2017, 2), y: 107000 },
			{ x: new Date(2017, 3), y: 110500 },
			{ x: new Date(2017, 4), y: 114000 },
			{ x: new Date(2017, 5), y: 133000 },
			{ x: new Date(2017, 6), y: 205000 },
			{ x: new Date(2017, 7), y: 192000 },
			{ x: new Date(2017, 8), y: 156000 },
			{ x: new Date(2017, 9), y: 114000 },
			{ x: new Date(2017, 10), y: 99000 },
			{ x: new Date(2017, 11), y: 135000 }
		]
	}, {
		type: "stackedArea",  
		name: "South",
		showInLegend: true,
		yValueFormatString: "$#,###",
		dataPoints: [
			{ x: new Date(2017, 0), y: 123000 },
			{ x: new Date(2017, 1), y: 117000 },
			{ x: new Date(2017, 2), y: 107000 },
			{ x: new Date(2017, 3), y: 98000 },
			{ x: new Date(2017, 4), y: 94000 },
			{ x: new Date(2017, 5), y: 103000 },
			{ x: new Date(2017, 6), y: 121000 },
			{ x: new Date(2017, 7), y: 132000 },
			{ x: new Date(2017, 8), y: 99700 },
			{ x: new Date(2017, 9), y: 104000 },
			{ x: new Date(2017, 10), y: 137000 },
			{ x: new Date(2017, 11), y: 145000 }
		]
	}, {
		type: "stackedArea",  
		name: "West",
		//indexLabel: "#total",
		yValueFormatString: "$#,###",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017, 0), y: 78000 },
			{ x: new Date(2017, 1), y: 83000 },
			{ x: new Date(2017, 2), y: 67000 },
			{ x: new Date(2017, 3), y: 88600 },
			{ x: new Date(2017, 4), y: 94000 },
			{ x: new Date(2017, 5), y: 73900 },
			{ x: new Date(2017, 6), y: 31000 },
			{ x: new Date(2017, 7), y: 42000 },
			{ x: new Date(2017, 8), y: 56000 },
			{ x: new Date(2017, 9), y: 64000 },
			{ x: new Date(2017, 10), y: 81000 },
			{ x: new Date(2017, 11), y: 105000 }
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery.canvasjs.min.js"></script>
</body>
</html>