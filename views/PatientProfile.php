<?php
	include '../php/PatientsControl.php';
	//session starts
	session_start();
	if(isset($_SESSION['pid']))
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
	$patients=patientsdata($_SESSION['pid']);
	$users=patientuser($_SESSION['pid']);

	//data retrieve fron users table
	foreach ($users as $user) {
		$password=$user["password"];
	}
	//data retrieve fron patient table
	foreach ($patients as $patient) {
		$userid=$patient["userid"];
		$username=$patient["username"];
		$gender=$patient["gender"];
		$email=$patient["email"];
		$number=$patient["phonenumber"];
		$dob=$patient["dob"];
		$bloodgroup=$patient["bloodgroup"];
		$divission=$patient["divission"];
		$district=$patient["district"];
		$thana=$patient["thana"];
	}
	
		
	
?>
<html>
	<head>
		<title>
			Patient Profile
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<link rel="stylesheet"type="text/css"href="CSS/doctorform.css">
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
	<button class="button"name="home"onclick="window.location='../php/LogoutControl.php'">Logout</button>
	<button type="button"name="home"class="button"onclick="window.location='PatientHomePage.php'">Home Page</button>
	<button class="button"onclick="window.location='PatientNotification.php'">Noification</button>
	<body>
		<div class="div1">
			<h2>My Profile</h2>
		</div>
		<!--Patient Profile starts-->
		<div class="dregister">
			<h4>Update your profile</h4><hr><br>
			<form method="post" action="../php/PatientsControl.php?uid=<?php echo $userid ?>" id="dregister">
				<table>
					<tr>
						<td>
							<label>User Id</label><br><br>
						</td>
						<td>
							<input type="text" name="uid" id="field" value="<?php echo $userid ?>"disabled>
							<br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>User Name</label><br><br>
						</td>
						<td>
							<input type="text" name="uname" id="field" value="<?php echo $username ?>"required>
							<br><br>
						</td>
					</tr>		
					<tr>
						<td>
							<label>New Password</label><br><br>
						</td>
						<td>
							<input type="password" name="pass"id="field" value=""required>
							<br><br>
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label>Gender</label><br><br>
						</td>
						<td>
							<input type="text" name="gender"id="field" value="<?php echo $gender ?>"disabled>
							<br><br>
						</td>
					</tr>		
					<tr>
						<td>
							<label>Email</label><br><br>
						</td>
						<td>
							<input type="text" name="email"id="field"value="<?php echo $email ?>"disabled>
							<br><br>
						</td>
					</tr>		
					<tr>
						<td>
							<label>Phone Number</label><br><br>
						</td>
						<td>
							<input type="text" name="number"id="field"value="<?php echo $number ?>"required>
							<br><br>
					</tr>		
					<tr>
						<td>
							<label>Date of Birth</label><br><br>
						</td>
						<td>
							<input type="text" name="dob" value="<?php echo $dob ?>"id="field" disabled>
							<br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>Blood Group</label><br><br>
						</td>
						<td>
							<input type="text" name="bloodgroup"id="field"value="<?php echo $bloodgroup ?>" disabled>
							<br><br>
						</td>
					</tr>	
					
					<tr>
						<td>
							<label>Address</label><br><br>
						</td>
						<td>
							<select name="divission" id="divission" class="address" onchange="divid()" required>
								<option selected value="<?php echo $divission ?>"><?php echo $divission ?></option>
								<?php foreach ($divissions as $value) { ?>
									<option value="<?php echo $value['divission'] ?>" ><?php echo $value['divission'] ?></option>
								<?php } ?>
							</select>
							<select name="district" id="district" class="address" onchange="disid()"required>
								<option selected value="<?php echo $district ?>"><?php echo $district ?></option>
							</select>
							<select name="thana" id="thana" class="address" required>
								<option selected value="<?php echo $thana ?>"><?php echo $thana ?></option>
							</select>
							<br><br>
						</td>
					</tr>		
							
					
				</table> 
				
				
				
				<!--update button here -->
				<button name="update"class="submit">Update</button>
				
			</form>	
		</div>
		<!--Patient profile ends-->	
	</body>
</html>