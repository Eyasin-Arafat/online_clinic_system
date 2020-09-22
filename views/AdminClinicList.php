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
	//data from clinics table
	$clinics=clinicsdata();
	$count=count($clinics);//count clinic
	$id=0;
?>
<html>
	<head>
		<title>
			Admin Clinic List
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/admincliniclist.css">
		<!--search function starts-->
		<script>
			function search() 
			{
				var search_input = document.getElementById('search_input').value.toUpperCase();
				var table = document.getElementById('clinic_table');
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
			<label class="h2">Clinic List</label>
			<button class="adminbtn"onclick="window.location='../php/LogoutControl.php'">Logout</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminClinicReg.php'">Add Clinic</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminHomePage.php'">Home</button>
		</div>
		<!--search bar & table ends-->
			<div class="search">
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="search" id="search_input" value="" placeholder="search name..." onkeyup="search()">
				</div>
				<div class="totalclinic">
					<label>Total Clinic</label>
					<input class="form-control" type="text" value="<?php echo $count ?>" readonly>
				</div>
			</div>
		<div class="table">
			<table class="table table-hover table-bordered " id="clinic_table">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Clinic id</th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Phone no.</th>
			      <th scope="col">Divission</th>
			      <th scope="col">District</th>
			      <th scope="col">Thana</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
				<?php foreach ($clinics as $clinic) {$id++; ?>
					<tbody>
						<th><?php echo $id; ?></th>
						<!--<th><?php //echo $clinic["id"]; ?></th>-->
						<td><?php echo $clinic["cid"]; ?></td>
						<td><?php echo $clinic["cname"]; ?></td>
						<td><?php echo $clinic["phonenumber"]; ?></td>
						<td><?php echo $clinic["divission"]; ?></td>
						<td><?php echo $clinic["district"]; ?></td>
						<td><?php echo $clinic["thana"]; ?></td>
						<td>
							<a href="../php/AdminControl.php?cid=<?php echo $clinic['cid'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure?');">Delete</a>
						</td>
					</tbody>
				<?php } ?>
			</table>
		</div>
		<!--search bar & table ends-->
	</body>
</html>