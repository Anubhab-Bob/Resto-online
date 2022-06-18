<html>
	<style type="text/css">
			div{
				color:blue;
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

    <?php
	
		function calculate($number, $prices) {
			return $_POST["quantity_".$number] * $prices[$_POST["item".$number]][1];
		}
        // Defining variables to store the input values 
        $it1 = $_POST["item1"];
		$qt1 = $_POST["quantity_1"];
        $it2 = $_POST["item2"];
		$qt2 = $_POST["quantity_2"];
        $it3 = $_POST["item3"];
		$qt3 = $_POST["quantity_3"];
        $it4 = $_POST["item4"];
		$qt4 = $_POST["quantity_4"];
        $it5 = $_POST["item5"];
		$qt5 = $_POST["quantity_5"];
        //print_r($_POST);
		
		$conn1 = new mysqli('localhost','root','','restaurant');
		if($conn1->connect_error)
			die("Connection Failed : ".$conn1->connect_error);
		else 
		{
			$query1 = "SELECT * from items";
			$result = $conn1->query($query1);
			//$i=1;
			$details = array();
			while ($row = mysqli_fetch_array($result))
			{
				$details[$row[0]] = array($row[1], $row[2]);
			}
			$conn1->close();
		//	print_r($details);
		}
		$i = 1;
		$total = 0;
		while($i <= 5) {
			$total = $total + calculate($i, $details);
			$i = $i + 1;
		}
    ?>
	<div>
    <form action="Successful.php" method=POST>
    <h4><ins><big>Customer Details :</big></ins></h4>
    <b> Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : &nbsp&nbsp&nbsp&nbsp <input type = "text" name = "name" value="<?php echo $_POST["name"];?>" readonly>
    <br><br>

    <b>Address &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp <input type = "text" name = "address" value="<?php echo $_POST["address"];?>" readonly><br><br>

    <b>Area &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp&nbsp <input type = "text" name = "area" value="<?php echo $_POST["area"];?>" readonly><br><br>

	<b>Phone No. &nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp&nbsp <input type = "number" name = "phone" value="<?php echo $_POST["phone"];?>" readonly><br><br>
	
	<b>Password &nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp&nbsp <input type = "text" name = "password" value="<?php echo $_POST["pass"];?>" readonly><br><br>
    <hr>    

    <h4><ins><big>Order Details :</big></ins></h4>

    <table align="center" border="2" bgcolor="#f1f1c1">
        <tr>
            <td><b>Item</b></td>
            <td><b>Quantity</b></td>
            <td><b>Amount</b></td>
        </tr>
		<?php
			$i = 1;
			while($i <= 5) {
				echo "<tr>";
				echo "<td>".$details[$_POST["item".$i]][0]."</td>";
				echo "<td>".$_POST["quantity_".$i]."</td>";
				echo "<td>".calculate($i, $details)."</td>";
				echo "</tr>";
				$i = $i + 1;
			}
		?>
        <tr>
            <td colspan="2"><b>Total</b></td>
            <td><b><?php echo $total;?></b></td>
        </tr>
	</table>
	<b>Total : <input type = "text" name = "total" value="<?php echo $total;?>" readonly>
    <br><br></b>
	</div>
    <div align="center">
        <input type = "submit" name="submit" value="Confirm Order">
    </div>
    </form>
</html>