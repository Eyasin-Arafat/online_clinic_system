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
	$doctors=schedule();
?>
<html>
	<head>
		<title>
			Take Appointment
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<script>
			//search here//
			function search_name() 
			{
				var search_input = document.getElementById('search_input_name').value.toUpperCase();
				var table = document.getElementById('doctor_appointment_list');
				var tr = table.getElementsByTagName('tr');
				for(var i=0; i<tr.length; i++)
				{
					var td = tr[i].getElementsByTagName('td')[1];
					if (td) 
					{
						var textvalue = td.textContent || td.innerHTML;
						if (textvalue.toUpperCase().indexOf(search_input) > -1) 
						{
							tr[i].style.display = "";
						}
						else
						{
							tr[i].style.display = "none";
						}
					}
				}
			}
			function search_id() 
			{
				var search_input = document.getElementById('search_input_id').value.toUpperCase();
				var table = document.getElementById('doctor_appointment_list');
				var tr = table.getElementsByTagName('tr');
				for(var i=0; i<tr.length; i++)
				{
					var td = tr[i].getElementsByTagName('td')[0];
					if (td) 
					{
						var textvalue = td.textContent || td.innerHTML;
						if (textvalue.toUpperCase().indexOf(search_input) > -1) 
						{
							tr[i].style.display = "";
						}
						else
						{
							tr[i].style.display = "none";
						}
					}
				}
			}
			//search here ends//
		</script>
	</head>
	<button type="button"name="home"class="button"onclick="window.location='PatientHomePage.php'">Home Page</button>
	<button class="button"onclick="window.location='PatientNotification.php'">Noification</button>
	<body>
		<div class="div1">
			<h2>Take Appointment</h2>
		</div>
		<!--search & table starts-->
		<!--search by name-->
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="search doctor name..." id="search_input_name" onkeyup="search_name()">
			</div>
		</div>
		<!--search by id-->
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="search doctor id..." id="search_input_id" onkeyup="search_id()">
			</div>
		</div>

		<div class="table">
			<table class="table table-hover table-bordered " id="doctor_appointment_list">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">Doctor id</th>
			      <th scope="col">Doctor name</th>
			      <th scope="col">Clinic id</th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Time</th>
			      <th scope="col">Date</th>
			      <th scope="col">Divission</th>
			      <th scope="col">District</th>
			      <th scope="col">Thana</th>
			      <th scope="col">Select</th>
				
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($doctors as $value) { ?>
			  		<tr>
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
					    	<a href="../php/PatientsControl.php?reqid=<?php echo $value['id'] ?> & pid=<?php echo $_SESSION['pid'] ?>" class="btn btn-primary float-right"style="width: 75px" onclick="return confirm ('Are you sure want to request?');">Request</a>
				      	</td>
				    </tr>
			  	<?php } ?>
				    
			  </tbody>
			</table>
		</div>
		<!--search & table ends-->
	</body>
</html>