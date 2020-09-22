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
	//data from patient records table//
	$precords=patientrecords();
	$count=count($precords);//count patientsrecords
?>
<html>
	<head>
		<title>
			Admin Patient History
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/admincliniclist.css">
		<!--search function starts-->
		<script>
			function search() 
			{
				var search_input = document.getElementById('search_input').value.toUpperCase();
				var table = document.getElementById('history');
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
			<label class="h2">Patient Records</label>
			<button class="adminbtn"onclick="window.location='../php/LogoutControl.php'">Logout</button>
			<button type="button"class="adminbtn"onclick="window.location='AdminHomePage.php'">Home</button>
		</div>
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="search patient name..." id="search_input" onkeyup="search()">
			</div>
			<div class="totalclinic">
				<label>Total Patients Record</label>
				<input class="form-control" type="text" value="<?php echo $count ?>" readonly>
			</div>
		</div>
		
		<!-- table starts-->
		<div class="table">
			<table class="table table-hover table-bordered " id="history">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Doctor name</th>
			      <th scope="col">Patient name </th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Symptom</th>
			      <th scope="col">Diseases</th>
			      <th scope="col">Test</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($precords as $value) { $id++ ?>
			  		<tr>
						<th><?php echo $id ?></th>
						<td><?php echo $value['dname'] ?></td>
						<td><?php echo $value['pname'] ?></td>
						<td><?php echo $value['cname'] ?></td>
						<td><?php echo $value['symptom'] ?></td>
						<td><?php echo $value['diseases'] ?></td>
						<td><?php echo $value['test'] ?></td>
				    </tr>
			  	<?php } ?>
			  </tbody>
			</table>
		</div>
		<!--table ends-->
	</body>
</html>