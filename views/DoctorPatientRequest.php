<?php
	include 'CSS/bootstrap.php';
	include '../php/DoctorsControls.php';
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
	$id=0;
	$patients=patientschedule($_SESSION['did']);
?>

<html>
	<head>
		<title>
			Doctor Patient Waiting
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<script>
			//search here//
			function search() 
			{
				var search_input = document.getElementById('search_input').value.toUpperCase();
				var table = document.getElementById('patient_request_list');
				var tr = table.getElementsByTagName('tr');
				for(var i=0; i<tr.length; i++)
				{
					var td = tr[i].getElementsByTagName('td')[2];
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
	<body>
		<button class="button"onclick="window.location='../php/LogoutControl.php'">Logout</button>
		<button type="button"name="home"class="button"onclick="window.location='DoctorHomePage.php'">Home Page</button>
		<div class="div1">
			<h2>Patient Request</h2>
		</div>
		<!--search bar and table statrs-->
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="search name..." id="search_input" onkeyup="search()">
			</div>
		</div>
		<div class="table">
			<table class="table table-hover table-bordered " id="patient_request_list">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Patient id</th>
			      <th scope="col">Patient name</th>
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
			  			<td><?php echo $value['pid'] ?></td>
			  			<td><?php echo $value['pname'] ?></td>
			  			<td><?php echo $value['cid'] ?></td>
			  			<td><?php echo $value['cname'] ?></td>
			  			<td><?php echo $value['time'] ?></td>
			  			<td><?php echo $value['date'] ?></td>
			  			<td><?php echo $value['divission'] ?></td>
			  			<td><?php echo $value['district'] ?></td>
			  			<td><?php echo $value['thana'] ?></td>
				      	<td>
					      	<button type="button" class="btn btn-danger float-right"style="width: 78px"onclick="location.href='../php/DoctorsControls.php?delid=<?php echo $value['id'] ?>'">Reject</button>
					      	<button type="button" class="btn btn-primary float-right"style="width: 78px" onclick="location.href='../php/DoctorsControls.php?prid=<?php echo $value['id'] ?>'">Accept</button>
				      	</td>
				    </tr>
			  	<?php } ?>
				    
			  </tbody>
			</table>
		</div>
		<!--search bar and table ends-->


	</body>
</html>