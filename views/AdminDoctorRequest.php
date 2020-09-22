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

	$tempdoctors=tempdoctorsdata();
	$id=0;
?>
<html>
	<head>
		<title>
			Admin Doctor Request
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/admincliniclist.css">
	</head>
	<body>
		<div class="div1">
			<label class="h2">Doctor Request List</label>
			<button class="adminbtn"onclick="window.location='../php/LogoutControl.php'">Logout</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminHomePage.php'">Home</button>
		</div>
		<div class="table">
			<table class="table table-hover table-bordered ">
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
				<?php foreach ($tempdoctors as $tempdoctor) { $id++;?>
					<tbody>
					    <tr>
					    	<th><?php echo $id; ?></th>
					    	<!--<th><?php //echo $tempdoctor["id"]; ?></th>-->
							<td><?php echo $tempdoctor["userid"]; ?></td>
							<td><?php echo $tempdoctor["username"]; ?></td>
							<td><?php echo $tempdoctor["email"]; ?></td>
							<td><?php echo $tempdoctor["phonenumber"]; ?></td>
							<td><?php echo $tempdoctor["divission"]; ?></td>
							<td><?php echo $tempdoctor["district"]; ?></td>
							<td><?php echo $tempdoctor["thana"]; ?></td>
							<td><?php echo $tempdoctor["specialty"]; ?></td>
							<td><?php echo $tempdoctor["degree"]; ?></td>
							<td><?php echo $tempdoctor["bmdcregno"]; ?></td>
							<td>
								<a href="../php/AdminControl.php?tdeleteid=<?php echo $tempdoctor['userid'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure to delete?');">Delete</a>

								<a href="../php/AdminControl.php?acceptid=<?php echo $tempdoctor['userid'] ?>" class="btn btn-primary float-right"style="width: 70px" onclick="return confirm ('Are you sure to accept?');">Accept</a>
							</td>
					    </tr>
					</tbody>
				<?php } ?>
			</table>
		</div>
	</body>
</html>