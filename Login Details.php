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
<?php
	$conn = new mysqli('localhost','root','','restaurant');
	$query = "Select * from customer where cid=".$_POST["cid"]." and password='".$_POST["pass"]."'";
	$result = mysqli_query($conn,$query);
	
	if(mysqli_num_rows($result) == 0)
	{
		echo "User does not exist !!";
	}	
	else
	{
		$result = mysqli_fetch_assoc($result);
		echo "<div><form action='Give Order.php' method='POST'>
		<h3>Customer details</h3>	
		<b>Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : &nbsp&nbsp&nbsp&nbsp <textarea rows='1' cols='50' name='name' readonly>".$result["name"]."</textarea><br><br>
		Address &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp <textarea rows='1' cols='50' name='address' readonly>".$result["address"]."</textarea><br><br>
		Area &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='area' value=".$result["areaid"]." readonly><br><br>
		Phone &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='phone' value=".$result["number"]." readonly><br><br>
		Password &nbsp&nbsp&nbsp: &nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='password' value=".$result["password"]." readonly><br><br></b></div>";
		echo "<div align='center'>
		<input type = 'submit' name='submit' value='Proceed'>
		</div>";
	}
	$conn->close();
?>
<br>
<div align='center'>
	<a href="form.php">Back</a>
</div>
</html>