<?php
	include 'CSS/bootstrap.php';
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
	$id=0;
	//data from patient records table//
	$precords=patientrecords($_SESSION['pid']);
?>
<html>
	<head>
		<title>
			Prescription
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
	</head>
	<button class="button"name="home"onclick="window.location='../php/LogoutControl.php'">Logout</button>
	<button type="button"name="home"class="button"onclick="window.location='PatientHomePage.php'">Home Page</button>
	<button class="button"onclick="window.location='PatientNotification.php'">Noification</button>
	<body>
		<div class="div1">
			<h2>Prescription</h2>
		</div>
		<!-- table starts-->
		<div class="table">
			<table class="table table-hover table-bordered ">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Doctor id</th>
			      <th scope="col">Doctor name</th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Time</th>
			      <th scope="col">Date</th>
			      <th scope="col">Symptom</th>
			      <th scope="col">Diseases</th>
			      <th scope="col">Test</th>
			      <th scope="col">Test clinic</th>
			      <th scope="col">Report</th>
				  <th scope="col">Medicines</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($precords as $value) { $id++ ?>
			  		<tr>
						<th><?php echo $id ?></th>
						<td><?php echo $value['did'] ?></td>
						<td><?php echo $value['dname'] ?></td>
						<td><?php echo $value['cname'] ?></td>
						<td><?php echo $value['time'] ?></td>
						<td><?php echo $value['date'] ?></td>
						<td><?php echo $value['symptom'] ?></td>
						<td><?php echo $value['diseases'] ?></td>
						<td><?php echo $value['test'] ?></td>
						<td><?php echo $value['testclinic'] ?></td>
						<td><?php echo $value['report'] ?></td>
						<td><?php echo $value['medicines'] ?></td>
				    </tr>
			  	<?php } ?>
			  </tbody>
			</table>
		</div>
		<!--table ends-->
	</body>
</html>