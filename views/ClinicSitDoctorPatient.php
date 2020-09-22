<?php
	include 'CSS/bootstrap.php';
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
	$id=0;
	//data from patient records table//
	$precords=patientrecords($_SESSION['cid']);
?>
<html>
	<head>
		<title>
			Doctor See Patient
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<link rel="stylesheet"type="text/css"href="CSS/doctorhomepage.css">
	</head>
	<body>
		<button class="button"onclick="window.location='../php/LogoutControl.php'">Logout</button>
		<button class="button"onclick="window.location='ClinicHomePage.php'">Home Page</button>
		<div class="div1">
			<h2>Doctor & Patient</h2>
		</div>
		<!-- table starts-->
		<div class="table">
			<table class="table table-hover table-bordered ">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Doctor name</th>
			      <th scope="col">Patient name </th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Time</th>
			      <th scope="col">Date</th>
			      <th scope="col">Symptom</th>
			      <th scope="col">Diseases</th>
			      <th scope="col">Test</th>
			      <th scope="col">Report</th>
				  <th scope="col">Medicines</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($precords as $value) { $id++ ?>
			  		<tr>
						<th><?php echo $id ?></th>
						<td><?php echo $value['dname'] ?></td>
						<td><?php echo $value['pname'] ?></td>
						<td><?php echo $value['cname'] ?></td>
						<td><?php echo $value['time'] ?></td>
						<td><?php echo $value['date'] ?></td>
						<td><?php echo $value['symptom'] ?></td>
						<td><?php echo $value['diseases'] ?></td>
						<td><?php echo $value['test'] ?></td>
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