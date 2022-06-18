<html>
<head>
		<style type="text/css">
			h2{
				color:gold;
				text-align: center;
				padding:200px;
			}			
		</style>		
	</head>
<body bgcolor="darkcyan">
<?php
    //Create connection with database
    $conn1 = new mysqli('localhost','root','','restaurant');
    //Checking if connection is successful
    if($conn1->connect_error)
        die("Connection Failed : ".$conn1->connect_error);
    else 
    {
        $cname=trim($_POST['name']);
		$add=trim($_POST['address']);
		$area=trim($_POST['area']);
		$phn=trim($_POST['phone']);
        $pass=trim($_POST['password']);
        $ttl = trim($_POST['total']);
        
        $check_existing = "SELECT * from customer where name='$cname'";
        $checkID = $conn1->query($check_existing);
        if (mysqli_num_rows($checkID)==0)
        {
            $cust = "INSERT into customer (name,address,areaid,number,total_spent,password) values ('$cname','$add',$area,$phn,$ttl,'$pass')";
            mysqli_query($conn1,$cust);
        }
        else
        {
            $checkID = mysqli_fetch_assoc($checkID);
            $total1 = $checkID["total_spent"] + $ttl;
            $sql="update customer set total_spent=$total1 where name='$cname'";
	        $result=mysqli_query($conn1,$sql);
        }
        echo "<h2>Order Successful</h2>";
        $conn1->close();
    }
?>
</body>
</html>