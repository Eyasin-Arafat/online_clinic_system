<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet"type="text/css"href="CSS/logincss.css">
		<!--show password checkbox starts-->
		<script>
		function showpass() {
		  var x = document.getElementById("myinput");
		  if (x.type === "password") {
			x.type = "text";
		  } else {
			x.type = "password";
		  }
		}
		</script>
		<!--show password checkbox ends-->
	</head>
	<body>
	
		
		
		<div class="btngrp">
			<label class="ll">Online Clinic</label>
			<button type="button"name="home"class="button"onclick="window.location='HomePage.php'">Home</button>
			<button type="button"name="home"class="button"onclick="window.location='Login.php'">Login</button>
		</div>
		<form method="post" action="../php/LoginControl.php">
			<div class="login">
				<div class="err_mgs">
					<?php
						if(@$_GET['empty']==true)
						{
							echo $_GET['empty'];
						}
					?>
				</div>
				<table>
					<tr>
						<td>
							<input type="text" class="field" name="uid"placeholder="User Id">
						</td>
					</tr>
					<tr>
						<td>
							<br>
							<input type="password" class="field" name="pass" placeholder="Password"id="myinput"><br><br>
							<input type="checkbox" onclick="showpass()"> &nbsp Show Password
						</td>
					</tr>
					<tr>
						<td>
							<!--login button here -->
							<br>
							<button name="login"class="submit">Login</button><br><br>
							<label class="lbl"><b>Or Register <a href="HomePage.php">here</a></b></label>
						</td>
					</tr>
				</table>
			</div>
		</form>
		<?php include 'FAQ.php' ?>
	</body>
</html>