<html>
	</head>
		<style type="text/css">
			div{
				padding: 25px 50px 75px 100px;
				text-align: center;
				
			}
			.submit:hover{
				background-color: yellow;
				font-size:20px;
			}
			b:hover{
				color:red;
				font-size:20px;
				background-image: linear-gradient(aqua, yellow);
			}
			hr{
				color:royalblue;
			}
			b{
				color:sienna;
			}
			h3{
				color:darkslateblue;
				text-align: center;
			}
		</style>		
	</head>
	
	<body bgcolor="darkkhaki">
	<hr>
	<hr>
	<h3>Please enter your details</h3>
	<div>
		<form action="Give Order.php" method="post">
			<b>Name &nbsp&nbsp&nbsp&nbsp&nbsp : &nbsp&nbsp&nbsp</b> <input type = "text" name = "name"><br><br>
			<b>Address &nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp</b> <input type = "text" name = "address"><br><br>
			<b>Area &nbsp: &nbsp&nbsp&nbsp</b>
						<?php
							$conn1 = new mysqli('localhost','root','','restaurant');
							if($conn1->connect_error)
								die("Connection Failed : ".$conn1->connect_error);
							else 
							{
								$query1 = "SELECT * from area";
								$result = $conn1->query($query1);
								echo "<select name='area'>";
								//$i=1;
								while ($row = mysqli_fetch_assoc($result))
								{
									echo "<option value=\"".$row["AreaCode"]."\">".$row["AreaName"]."</option>";
								}    
								echo "</select>";
								$conn1->close();
							}
						?>
			
						
			<br><br>
			<b>Phone No : &nbsp&nbsp&nbsp</b> <input type = "number" name = "phone"><br><br>
			<b>Password : &nbsp&nbsp&nbsp</b> <input type = "password" name = "password"><br><br>
			<input type="submit" value="Submit" name="submit"><br>
		</div>
		<hr>
		<hr>
</html>