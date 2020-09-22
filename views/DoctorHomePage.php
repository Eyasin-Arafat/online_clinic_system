<?php
	//session starts
	session_start();
	if(isset($_SESSION['did']))
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
?>
<html>
	<head>
		<title>
			Doctor Home Page
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorhomepage.css">
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
	</head>
	<body>
		<button class="button"onclick="window.location='../php/LogoutControl.php'">Logout</button>
		<button type="button"name="home"class="button"onclick="window.location='DoctorHomePage.php'">Home Page</button>
		<div class="div1">
			<h2>Home Page</h2>
		</div>
		<label class="l1">Welcome Doctor :<?php echo $_SESSION['did'] ?><label>
		<div class="sidebar">                <!--https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav_dropdown-->
			<a href="DoctorProfile.php">Profile</a>
			<a href="DoctorSetSchedule.php">Set Schedule</a>
			<a href="DoctorPatientWaiting.php">Patient Wating</a>
			<a href="DoctorPatientRequest.php">Patient Request</a>
			<a href="DoctorPatientRecords.php">Patient Records</a>
		</div>
	</body>
</html>