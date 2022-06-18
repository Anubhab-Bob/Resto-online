<?php
    
	$from1 = $_POST["from1"];
	$to1 = $_POST["to1"];
	$from2 = $_POST["from2"];
	$to2 = $_POST["to2"];
	$value = $_POST["value"];
	
    //Create connection with database
    $conn = new mysqli('localhost','root','','restaurant');
    //Checking if connection is successful
    if($conn->connect_error)
        die("Connection Failed : ".$conn->connect_error);

    //Storing the query string in a variable
    $query2 = "SELECT off.ofid as Order_ID, c.name as Customer_Name, b.amount, e.name as Service_Boy, c.address, AreaName from offline_order off, customer c, bill b, employee e, area a where off.employee_id=e.employee_id AND off.billno=b.billno AND c.areaid=a.AreaCode AND b.cid=c.cid AND b.order_date between '".$from1."' and '".$to1."'";

	$query1="SELECT
    online_order.onid as `Order ID`,
    customer.name as Customer,
    bill.amount as Amount,
    employee.name as Employee,
    customer.address as Address,
	area.AreaName as Area
FROM
    online_order,
    customer,
    bill,
    employee,
	area
WHERE
    customer.areaid = area.AreaCode and bill.type = 'ONLINE' AND online_order.billno = bill.billno AND bill.cid = customer.cid AND online_order.employee_id = employee.employee_id AND bill.order_date BETWEEN '".$from2."' and '".$to2."'";
    
	$query3 = "SELECT
    AREA.AreaName as Area,
    customer.name as Name,
    customer.address as Address,
    customer.total_spent as Total,
    customer.number as Phone
FROM
    AREA,
    customer
WHERE
    AREA.AreaCode = customer.areaid AND AREA.AreaCode IN(
    SELECT
        AREA.AreaCode
    FROM
        AREA,
        bill,
        customer
    WHERE
        bill.cid = customer.cid AND AREA.AreaCode = customer.areaid
    GROUP BY
        AREA.AreaCode
    HAVING
        AVG(bill.amount) > ".$value."
)
ORDER BY area.AreaName ASC
";
	
	//Querying and storing output in a variable
    $result2 = $conn->query($query2);
	$result1 = $conn->query($query1);
	$result3 = $conn->query($query3);
	
    //Displaying Query Output
    echo "<h1>Query : Generate report on in-house order information from ".$from1." to ".$to1."</h1>
        <br><br>";
    echo "<table style='border: solid 5px crimson; background-color: #f1f1c1; padding: 15px;'>";
    echo "<tr><th>Order_ID</th><th>Customer_Name</th><th>Amount</th><th>Service_Boy</th><th>Address</th><th>AreaName</th></tr>";
    while($row = mysqli_fetch_array($result2))
    {
        echo "<tr>";
        echo "<td>".$row['Order_ID']."</td>";
		echo "<td>".$row['Customer_Name']."</td>";
        echo "<td>".$row['amount']."</td>";
        echo "<td>".$row['Service_Boy']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['AreaName']."</td>";
        echo "</tr>";
    }
    echo "</table>";
	echo "<br><br><br><hr><br>";
	
	//Displaying Query Output
    echo "<h1>Query : Generate report on out-house order information from ".$from2." to ".$to2."</h1>
        <br><br>";
    echo "<table style='border: solid 5px crimson; background-color: #afafac; padding: 15px;'>";
    echo "<tr><th>Order_ID</th><th>Customer_Name</th><th>Amount</th><th>Service_Boy</th><th>Address</th><th>AreaName</th></tr>";
    while($row = mysqli_fetch_array($result1))
    {
        echo "<tr>";
        echo "<td>".$row['Order ID']."</td>";
		echo "<td>".$row['Customer']."</td>";
        echo "<td>".$row['Amount']."</td>";
        echo "<td>".$row['Employee']."</td>";
        echo "<td>".$row['Address']."</td>";
        echo "<td>".$row['Area']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><br><br><hr><br>";
    
	//Displaying Query Output
    echo "<h1>Query : Area-wise Customer details who have procured threshold amount on average</h1>
        <br><br>";
    echo "<table style='border: solid 5px crimson; background-color: #afafac; padding: 15px;'>";
    echo "<tr><th>Area</th><th>Customer_Name</th><th>Address</th><th>Phone No.</th><th>Total Spent</th>";
    while($row = mysqli_fetch_array($result3))
    {
        echo "<tr>";
        echo "<td>".$row['Area']."</td>";
		echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Address']."</td>";
        echo "<td>".$row['Phone']."</td>";
        echo "<td>".$row['Total']."</td>";
        echo "</tr>";
    }
    echo "</table>";
?>
