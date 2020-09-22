<html>
	<head><title>Home Page</title>
			<link rel="stylesheet"type="text/css"href="CSS/homepage.css">
			<link rel="stylesheet" href="CSS/faq.css">

	</head>
	<body>
		<div class="btngrp">
			<label class="h1">Welcome to Online Clinic</label>

			<button type="button"name="home"class="button"onclick="window.location='HomePage.php'">Home</button>
			<button type="button"name="home"class="button"onclick="window.location='Login.php'">Login</button>
			
			<div class="dropdown">
				<button class="dropbtn">Sign up </button>

				<div class="dropdown-content">
				  <a href="DoctorRegistration.php">Doctor</a>
				  <a href="PatientRegistration.php">Patient</a>
				</div>
				
			</div> 
		</div>
		<div class="home">
			<h2>Clinic For Doctor & Patient</h2>
			<div class="maindiv"></div>
			<div class="maindiv2"></div>
			<div class="maindiv3">
				<p class="p">
					Call us at +8801747979703
					Website: www.onlineclinic.com
					<a href="https://www.facebook.com/onlineclinic.helth/">visit our facebook page</a>
					<a href="https://www.mhealth.org/Care/Conditions/COVID-19"> <br>->CORONAVIRUS (COVID-19)</a> The information you need to know
				</p>
			</div>
		</div>
		<?php include 'FAQ.php'; ?>
	</body>
</html>