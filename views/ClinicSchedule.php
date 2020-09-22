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
	$id1=0;
	$slots1=slot1($_SESSION['cid']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Clinic Schedule</title>
	<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
	<link rel="stylesheet"type="text/css"href="CSS/doctorhomepage.css">
</head>
<body>
	<button class="button"onclick="window.location='../php/LogoutControl.php'">Logout</button>
	<button class="button"onclick="window.location='ClinicHomePage.php'">Home Page</button>
	<div class="div1">
		<h2>Schedule</h2>
	</div>
		<div class="table">
			<table class="table table-hover table-bordered ">
				<thead>
				    <tr class="thead-dark">
						<th scope="col">SI#</th>
						<th scope="col">Slot 1</th>
						<th scope="col">Date</th>
						<th scope="col">Actions</th>
				    </tr>
				</thead>
				<?php foreach ($slots1 as $slot1) { $id1++;?>
					<tbody>
					    <tr>
					    	<th><?php echo $id1; ?></th>
					    	<!--<th><?php //echo $schedule["id"]; ?></th>-->
							<td><?php echo $slot1["slot1"]; ?></td>
							<td><?php echo $slot1["date"]; ?></td>
							<td>
								<a href="../php/ClinicControls.php?sdeleteid=<?php echo $slot1['id'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure to delete?');">Delete</a>
							</td>
					    </tr>
					</tbody>
				<?php } ?>
			</table>
		</div>
</body>
</html>