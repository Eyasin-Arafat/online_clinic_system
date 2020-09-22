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
	$patients=patientschedule($_SESSION['pid']);
?>
<html>
	<head>
		<title>
			Notification
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
	</head>
	<button class="button"name="home"onclick="window.location='../php/LogoutControl.php'">Logout</button>
	<button type="button"name="home"class="button"onclick="window.location='PatientHomePage.php'">Home Page</button>
	<button class="button"onclick="window.location='PatientNotification.php'">Noification</button>
	<body>
		<div class="div1">
			<h2>Notification</h2>
		</div>
		<div class="table">
			<table class="table table-hover table-bordered " id="patient_request_list">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Doctor id</th>
			      <th scope="col">Doctor name</th>
			      <th scope="col">Clinic id</th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Time</th>
			      <th scope="col">Date</th>
			      <th scope="col">Divission</th>
			      <th scope="col">District</th>
			      <th scope="col">Thana</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($patients as $value) { $id++;?>
			  		<tr>
			  			<td><?php echo $id ?></td>
			  			<td><?php echo $value['did'] ?></td>
			  			<td><?php echo $value['dname'] ?></td>
			  			<td><?php echo $value['cid'] ?></td>
			  			<td><?php echo $value['cname'] ?></td>
			  			<td><?php echo $value['time'] ?></td>
			  			<td><?php echo $value['date'] ?></td>
			  			<td><?php echo $value['divission'] ?></td>
			  			<td><?php echo $value['district'] ?></td>
			  			<td><?php echo $value['thana'] ?></td>
				      	<td>
					      	<button type="button" class="btn btn-danger float-right"style="width: 78px"onclick="location.href='../php/PatientsControl.php?delid=<?php echo $value['id'] ?>'">Delete</button>
				      	</td>
				    </tr>
			  	<?php } ?>
				    
			  </tbody>
			</table>
		</div>
		<!--search bar and table ends-->
	</body>
</html>