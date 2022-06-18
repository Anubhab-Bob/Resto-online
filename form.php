<html>
	</head>
		<style type="text/css">
			div{
				padding: 25px 50px 75px 100px;
				text-align: center;
				background-image: linear-gradient(limegreen, yellow);
			}
			
			b{
				color:red;
				font-size:20px;
				background-image: linear-gradient(aqua, yellow);
			}
		</style>
		
	</head>
		<body bgcolor="aqua">
		
		<div>
		<h2>Login page</h2>
		<h3>For existing customer</h3>
		<form action="Login Details.php" method="post">
			<b>Customer ID : </b><input type="number" name="cid"><br><br>
			<b>Password :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b><input type="password" name="pass"><br><br>
			<div align="center">
                <input type = "submit" name="Sign In" value="Submit">
            </div>
		</form>
		<hr>
		
		<h3>For non existing customer</h3>
		<a href="Register.php"><b>Sign up</b></a>
		</div>

		<br><br>
		<a href="Admin.php"><b>Admin</b></a>
		</div>
	
</html>
