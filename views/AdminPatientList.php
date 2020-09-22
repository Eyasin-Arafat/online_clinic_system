<?php
	include '../php/AdminControl.php';
	include 'CSS/bootstrap.php';
	//session starts
	session_start();
	if(isset($_SESSION['aid']))
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
	$patients=patientsdata();
	$count=count($patients);//count patients
?>
<html>
	<head>
		<title>
			Admin Patient List
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/admincliniclist.css">
		<!--search function starts-->
		<script>
			function search() 
			{
				var search_input = document.getElementById('search_input').value.toUpperCase();
				var table = document.getElementById('patient_table');
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
		</script>
		<!--search function ends-->
	</head>
	<body>
		<div class="div1">
			<label class="h2">Patient List</label>
			<button class="adminbtn"onclick="window.location='../php/LogoutControl.php'">Logout</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminHomePage.php'">Home</button>
		</div>
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="search name..." id="search_input" onkeyup="search()">
			</div>
			<div class="totalclinic">
					<label>Total Patients</label>
					<input class="form-control" type="text" value="<?php echo $count ?>" readonly>
			</div>
		</div>
		<div class="table">
			<table class="table table-hover table-bordered " id="patient_table">
				<thead>
				    <tr class="thead-dark">
						<th scope="col">SI#</th>
						<th scope="col">Userid</th>
						<th scope="col">Name</th>
						<th scope="col">Gender</th>
						<th scope="col">Email</th>
						<th scope="col">Phone no.</th>
						<th scope="col">Blood grp</th>
						<th scope="col">Divission</th>
						<th scope="col">District</th>
						<th scope="col">Thana</th>
						<th scope="col">Actions</th>
				    </tr>
				</thead>
				<?php foreach ($patients as $patient) { $id++;?>
					<tbody>
					    <tr>
					    	<th><?php echo $id; ?></th>
					    	<!--<th><?php //echo $doctor["id"]; ?></th>-->
							<td><?php echo $patient["userid"]; ?></td>
							<td><?php echo $patient["username"]; ?></td>
							<td><?php echo $patient["gender"]; ?></td>
							<td><?php echo $patient["email"]; ?></td>
							<td><?php echo $patient["phonenumber"]; ?></td>
							<td><?php echo $patient["bloodgroup"]; ?></td>
							<td><?php echo $patient["divission"]; ?></td>
							<td><?php echo $patient["district"]; ?></td>
							<td><?php echo $patient["thana"]; ?></td>
							<td>
								<a href="../php/AdminControl.php?pdeleteid=<?php echo $patient['userid'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure to delete?');">Delete</a>
							</td>
					    </tr>
					</tbody>
				<?php } ?>
			</table>
		</div>
	</body>
</html>