<?php

$conn1 = new mysqli('localhost','root','','restaurant');
if($conn1->connect_error)
	die("Connection Failed : ".$conn1->connect_error);
else 
{
	$from = $_POST["from3"];
	
	$query1 = "SELECT
    SUM(bill.amount) as y,
    employee.name as label
FROM
    employee,
    online_order,
    bill
WHERE
    employee.employee_id = online_order.employee_id AND online_order.billno = bill.billno
	AND bill.order_date between '2016-01-17' and '2016-08-23'

GROUP BY
    online_order.employee_id";
	$result = $conn1->query($query1);
	$dataPoints = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		array_push($dataPoints, $row);
	}
	$conn1->close();
}
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Weekly report of delivery person"
	},
	axisY: {
		title: "Revenue (in Rs)",
		prefix: "Rs",
		//suffix:  "k"
	},
	data: [{
		type: "bar",
		yValueFormatString: "Rs #,##0",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>