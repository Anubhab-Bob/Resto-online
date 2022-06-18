<html> 
	<style type="text/css">
			div{
				color:black;
				background-image: linear-gradient(lightgray,darkslategray);
			}
			h3{
				text-align: center;
				color:#90EE90;
				border-style:solid;
				border-radius:25px;
				border-color:#00BFFF;
				border-width:5px;
				padding:10px;
				font-size:30px;
				background-image:linear-gradient(teal,mediumblue);
				text-shadow: 10px 2px 10px;
			}
			
			
		</style>
	<body> <div>
    <h1 align="center"><font size="10"><ins><big>Good Food Online</big></ins></font></h1>
	<hr><hr>
	<?php
		$cname=$_POST['name'];
		$add=$_POST['address'];
		$area=$_POST['area'];
		$phn=$_POST['phone'];
		$pass=$_POST['password'];
	
    echo "<hr>
	<form action='Checkout.php' method='POST'>
		<h3>Customer details</h3>	
		<b>Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : &nbsp&nbsp&nbsp&nbsp<input type='text' name='name' value='$cname' readonly><br><br>
		Address &nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp <textarea rows='1' cols='50' name='address' readonly>$add</textarea><br><br>
		Area  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp<input type='text' name='area' value='$area' readonly><br><br>
		Phone &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp<input type='text' name='phone' value='$phn' readonly><br><br>
		Password &nbsp: &nbsp&nbsp&nbsp&nbsp<input type='text' name='pass' value='$pass' readonly><br><br></b>

        <h4><ins><big>Order Details :</big></ins></h4>
		
		<b>Items : <br><br></b>";
					
						$conn1 = new mysqli('localhost','root','','restaurant');
						if($conn1->connect_error)
							die("Connection Failed : ".$conn1->connect_error);
						else 
						{
							$query1 = "SELECT * from items";
							$result = $conn1->query($query1);
							//$i=1;
							$items = array();
							while ($row = mysqli_fetch_array($result))
							{
								array_push($items, array($row[0], $row[1], $row[2])); 
							}
							$conn1->close();
							
							$i = 1;
							$numberOfItems = count($items);
							
							while($i <= 5) {
								
									echo "<select name='item".$i."'>";
								$j = 0;
								while($j < $numberOfItems) {
									$row = $items[$j];
									echo "<option value=\"".$row[0]."\">".$row[1]."    ".$row[2]."</option>";
									$j = $j + 1;
								}							
									echo "</select>";
									
									echo "<select name='quantity_".$i."'>";
									$k = 0;
									while($k <= 5) {
										echo "<option value=\"".$k."\">".$k."</option>";
										$k = $k + 1;
									}					
									echo "</select>";
								$i = $i + 1;
									echo "<br><br>";
							}
						}
					?>
		<br><br>
		</div>
        <hr>
        <br>
        <div align="center">
            <input type = "submit" name="submit" value="Proceed To Checkout">
        </div>
    </form>
</body></html>