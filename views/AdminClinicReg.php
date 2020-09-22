<?php
	include '../php/AdminControl.php';
	//session starts
	session_start();
	if(isset($_SESSION['aid']))
	{
		if (time()-$_SESSION['last_time']>1800) //30 min inactive thakle logout automatic
		{
			header("Location:../php/LogoutControl.php");
		}
		else
		{
			$_SESSION['last_time']=time();
		}
	}
	else
	{
		header("Location:Login.php");
	}
	//session ends
	$divissions=divission();
?>

<html>
	<head>
		<title>
			Admin Clinic Registration
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/adminclinicreg.css">
		<link rel="stylesheet"type="text/css"href="CSS/admincliniclist.css">
		<!--divission district thana-->
		<script>
		function divid()
		{
			http=new XMLHttpRequest();
			var search_word=document.getElementById("divission").value;
			http.onreadystatechange=function()
			{
				if (http.readyState==4 && http.status==200) 
				{
					//alert(http.responseText);
					//alert(document.getElementById("divission").value);
					document.getElementById("district").innerHTML=http.responseText;

					
				}
				else if (http.status==404) 
				{
					alert("not found");
				}
			}
			http.open("GET","../php/District.php?sk="+search_word,true);
			http.send();
		}
		function disid()
		{
			http=new XMLHttpRequest();
			var search_word=document.getElementById("district").value;
			http.onreadystatechange=function()
			{
				if (http.readyState==4 && http.status==200) 
				{
					//alert(http.responseText);
					//alert(document.getElementById("district").value);
					document.getElementById("thana").innerHTML=http.responseText;
				}
				else if (http.status==404) 
				{
					alert("not found");
				}
			}
			http.open("GET","../php/Thana.php?tk="+search_word,true);
			http.send();
		}
	</script>
	<!--divission district thana-->
	</head>
	<body>
		<div class="head">
			<label class="l1">Online Clinic</label>
			<button class="adminbtn"onclick="window.location='../php/LogoutControl.php'">Logout</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminHomePage.php'">Home</button>
		</div>
		<div class="cregister">
			<h4>Clinic Register Form</h4><hr><br>
				<form method="post" action="" id="cregister">
					<table>
						<tr>
							<td>
								<label>Clinic Id</label><br><br>
							</td>
							<td>
								<input type="text" name="cid"placeholder="Clinic id"id="field" value="<?php echo $cid ?>">
								<label class="errmgs"><?php echo $err_cid ?></label>
								<br><br>
							</td>
						</tr>
						<tr>
							<td>
								<label>Clinic Name</label><br><br>
							</td>
							<td>
								<input type="text" name="cname"placeholder="Clinic name"id="field" value="<?php echo $cname ?>">
								<label class="errmgs"><?php echo $err_cname?></label>
								<br><br>
							</td>
						</tr>		
						<tr>
							<td>
								<label>Password</label><br><br>
							</td>
							<td>
								<input type="password" name="pass"placeholder="Enter Password"id="field" value="<?php echo $pass?>">
								<label class="errmgs"><?php echo $err_pass?></label>
								<br><br>
							</td>
						</tr>		
						<tr>
							<td>
								<label>Phone Number</label><br><br>
							</td>
							<td>
								<input type="text" name="number"placeholder="01XXXXXXXXX"id="field"value="<?php echo $number?>">
								<label class="errmgs"><?php echo $err_number?></label>
								<br><br>
						</tr>		
						<tr>
							<td>
								<label>Address</label><br><br>
							</td>
							<td>
								<select name="divission" id="divission" class="address" onchange="divid()">
									<option selected disabled>Divission</option>
									<?php foreach ($divissions as $value) { ?>
									<option value="<?php echo $value['divission'] ?>" ><?php echo $value['divission'] ?></option>
								<?php } ?>
								</select>
								<select name="district" id="district" class="address" onchange="disid()">
									<option selected disabled>District</option>
								</select>
								<select name="thana" id="thana" class="address">
									<option selected disabled>Thana</option>
								</select>
								<label class="errmgs"><?php echo $err_address?></label>
								<br><br>
							</td>
						</tr>		
						</table>
					<!--submit button here -->
					<button name="submit"class="submit">Register</button>
				</form>	
			</div>
	</body>
</html>