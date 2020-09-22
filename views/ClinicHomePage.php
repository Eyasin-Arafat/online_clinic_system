<?php
	include '../php/ClinicControls.php';
	//session starts
	session_start();
	if(isset($_SESSION['cid']))
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
			Clinic Home Page
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<link rel="stylesheet"type="text/css"href="CSS/doctorhomepage.css">
	</head>
	<body>
		<button class="button"onclick="window.location='../php/LogoutControl.php'">Logout</button>
		<div class="div1">
			<h2>Home Page</h2>
		</div>
		<label class="l1">User Id :<?php echo $_SESSION['cid'] ?><label>
		<div class="sidebar">                <!--https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav_dropdown-->
			<a href="ClinicSitDoctorPatient.php">Sit Doctor Patient</a>
			<a href="ClinicSchedule.php">Schedule</a>
		</div>
		<form method="post" class="setschedule">
			<div class="setschedule-content">
				<h5>Update Schedule</h5>
				<div class="setschedule-list">
					<input name="cid" value="<?php echo $_SESSION['cid']; ?>"readonly><br><br>

					<input type="radio" name="time" value="08am - 10am"> 08am - 10am<br><br>
					<input type="radio" name="time" value="02pm - 05pm"> 02pm - 05pm<br><br>
					<input type="radio" name="time" value="08pm - 10pm"> 08pm - 10pm<br><br>

					<input type="date" name="date" required><br><br>
					<label class="errcbox"><?php echo "Please select at least one time"; ?></label><br>
					<button name="schedule" class="prescrive" >Schedule</button>
				</div>
			</div>
		</form>
	</body>
</html>