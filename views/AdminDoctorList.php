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
	$doctors=doctorsdata();
	$count=count($doctors);//count doctors
	$id=0;
?>

<html>
	<head>
		<title>
			Admin Doctor List
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/admincliniclist.css">
		<!--search function starts-->
		<script>
			function search() 
			{
				var search_input = document.getElementById('search_input').value.toUpperCase();
				var table = document.getElementById('doctor_table');
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
			<label class="h2">Doctor List</label>
			<button class="adminbtn"onclick="window.location='../php/LogoutControl.php'">Logout</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminHomePage.php'">Home</button>
		</div>
		<!--search & table starts-->
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" id="search_input" class="form-control" placeholder="search name..." onkeyup="search()">
			</div>
			<div class="totalclinic">
					<label>Total Doctors</label>
					<input class="form-control" type="text" value="<?php echo $count ?>" readonly>
			</div>
		</div>
		<div class="table">
			<table class="table table-hover table-bordered " id="doctor_table">
				<thead>
				    <tr class="thead-dark">
						<th scope="col">SI#</th>
						<th scope="col">Userid</th>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Phone no.</th>
						<th scope="col">Divission</th>
						<th scope="col">District</th>
						<th scope="col">Thana</th>
						<th scope="col">Specialty</th>
						<th scope="col">Degree</th>
						<th scope="col">BMDC no.</th>
						<th scope="col">Actions</th>
				    </tr>
				</thead>
				<?php foreach ($doctors as $doctor) { $id++;?>
					<tbody>
					    <tr>
					    	<th><?php echo $id; ?></th>
					    	<!--<th><?php //echo $doctor["id"]; ?></th>-->
							<td><?php echo $doctor["userid"]; ?></td>
							<td><?php echo $doctor["username"]; ?></td>
							<td><?php echo $doctor["email"]; ?></td>
							<td><?php echo $doctor["phonenumber"]; ?></td>
							<td><?php echo $doctor["divission"]; ?></td>
							<td><?php echo $doctor["district"]; ?></td>
							<td><?php echo $doctor["thana"]; ?></td>
							<td><?php echo $doctor["specialty"]; ?></td>
							<td><?php echo $doctor["degree"]; ?></td>
							<td><?php echo $doctor["bmdcregno"]; ?></td>
							<td>
								<a href="../php/AdminControl.php?ddeleteid=<?php echo $doctor['userid'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure to delete?');">Delete</a>
							</td>
					    </tr>
					</tbody>
				<?php } ?>
			</table>
		</div>
		<!--search & table ends-->
	</body>
</html>