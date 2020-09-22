<?php
	include '../php/PatientsControl.php';
	$divissions=divission();
?>
<html>
	<head>
		<title>Patient Registration Form</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorform.css">
		<link rel="stylesheet"type="text/css"href="CSS/homepage.css">
		<link rel="stylesheet" href="CSS/faq.css">
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
		}		function disid()
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
		<div class="btngrp1">
			<button type="button"name="home"class="button"onclick="window.location='HomePage.php'">Home</button>
			<button name="home"class="button"onclick="window.location='Login.php'">Login</button>
				<div class="dropdown">
				<button class="dropbtn">Sign up 
				</button>
				<div class="dropdown-content">
				  <a href="DoctorRegistration.php">Doctor</a>
				  <a href="PatientRegistration.php">Patient</a>
				</div>
			</div> 
		</div>
		<div class="dregister">
			<div class="para1">
				<p class="p1">
					Welcome to Online Clinic ! By signing up 
					with Onlineclinic.com, you confirm your understanding and agreement 
					that each appointment brought to you by Onlineclinic.com will have a nominal fee of <mark>BDT 20</mark>
				</p>
			</div>
			<h4>Patient Register Form</h4><hr><br>
			<form method="post" action=""id="dregister">
				<table>
					<tr>
						<td>
							<label>User Id</label><br><br>
						</td>
						<td>
							<input type="text" name="uid"placeholder="Enter User id"id="field" value="<?php echo $uid ?>">
							<label class="errmgs"><?php echo $err_uid ?></label>
							<br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>User Name</label><br><br>
						</td>
						<td>
							<input type="text" name="uname"placeholder="Enter User name"id="field" value="<?php echo $uname ?>">
							<label class="errmgs"><?php echo $err_uname?></label>
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
							<label>Gender</label><br><br>
						</td>
						<td>
							<input type="radio"name="gender"value="Male" class="gender" <?php if($gender=="Male") echo"checked"; ?> > Male &nbsp
							<input type="radio"name="gender"value="Female" class="gender" <?php if($gender=="Female") echo"checked"; ?>> Female 
							<label class="errmgs"><?php echo $err_gender?></label>
							<br><br>
						</td>
					</tr>		
					<tr>
						<td>
							<label>Email</label><br><br>
						</td>
						<td>
							<input type="text" name="email"placeholder="example@mail.com"id="field"value="<?php echo $email?>">
							<label class="errmgs"><?php echo $err_email?></label>
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
							<label>Date of Birth</label><br><br>
						</td>
						<td>
							<input type="date" name="dob" value=""id="field" >
							<label class="errmgs"><?php echo $err_dob?></label>
							<br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>Blood Group</label><br><br>
						</td>
						<td>
							<select name="bloodgroup"id="field">
								<option value="">Select Blood Group</option>
								<option <?php if($bloodgroup=="A+") echo "selected" ?> value="A+">A+</option>
								<option <?php if($bloodgroup=="A-") echo "selected" ?> value="A-">A-</option>
								<option <?php if($bloodgroup=="B+") echo "selected" ?> value="B+">B+</option>
								<option <?php if($bloodgroup=="B-") echo "selected" ?> value="B-">B-</option>
								<option <?php if($bloodgroup=="O+") echo "selected" ?> value="O+">O+</option>
								<option <?php if($bloodgroup=="O-") echo "selected" ?> value="O-">O-</option>
							</select>
							<label class="errmgs"><?php echo $err_bloodgroup?></label>
							<br><br>
						</td>
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
				<button name="submit"class="submit">Sign up</button>
				
			</form>	
		</div>
		<?php include 'FAQ.php'; ?>
	</body>
</html>