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
	//data from patient records table//
	$precords=patientrecords($_SESSION['did']);
	$testclinics=testclinics();
	$diseases=diseases();
?>
<html>
	<head>
		<title>
			Doctor Patient Records
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<script>
			function prescrive(pname,pid,pno,diseases,symptom,test,testclinic,report,medicines)
			{
				document.getElementById('bg-model').style.display='flex';
				//var pid=document.getElementById('pid').value;
				document.getElementById('pname').value=pname;
				document.getElementById('pid').value=pid;
				document.getElementById('pno').value=pno;
				document.getElementById('diseases').value=diseases;
				document.getElementById('symptom').value=symptom;
				document.getElementById('test').value=test;
				document.getElementById('tcname').value=testclinic;
				document.getElementById('report').value=report;
				document.getElementById('medicines').value=medicines;

			}
			function validateForm()
			{
				var x = document.forms["editform"]["symtom"].value;
				if (x == "") 
				{
				alert("Symtom must be filled out");
				return false;
				}
				var y = document.forms["popupform"]["report"].value;
				if (y == "") 
				{
				alert("Report must be filled out");
				return false;
				}
				var z = document.forms["popupform"]["medicines"].value;
				if (z == "") 
				{
				alert("Give some medicines");
				return false;
				}
			}
			//search here//
			function search() 
			{
				var search_input = document.getElementById('search_input').value.toUpperCase();
				var table = document.getElementById('patient_records_list');
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
		<button class="button"onclick="window.location='DoctorHomePage.php'">Home</button>
		<div class="div1">
			<h2>Patient Records</h2>
		</div>
		<!--popup page starts-->
		<div id="bg-model"class="bg-model">
			<div class="model-content">
				<div >
					<button type="button"name="close"class="close"onclick="document.getElementById('bg-model').style.display='none'";>+</button>
				</div>
				<form name="editform" action="../php/DoctorsControls.php"  method="post" onsubmit="return validateForm()">
					<div class="need">
						<label class="content">Doctor Id : </label>
						<input type="text" name="did" value="<?php echo $_SESSION['did'] ?>" id="did" class="pop" readonly><br>

						<label class="content">Patient Name : </label>
						<input type="text" value="" name="pname" id="pname" class="pop" readonly><br>

						<label class="content">Patient Id : </label>
						<input type="text" value="" name="pid" id="pid" class="pop" readonly><br>

						<label class="content">Patient no. : </label>
						<input type="text" value="" name="pno" id="pno" class="pop" readonly><br>
					</div>
					<label class="content">Symptom :</label><br>
					<input class="content-c" type="text" placeholder="Symptom" name="symtom" id="symptom"><br> 

					<label class="content">Diseases :</label><br>
					<select class="content-c"name="diseases" id="diseases">
						<option selected disabled>Diseases..</option>
						<?php foreach ($diseases as $value) {?>
							<option value="<?php echo $value['diseases'] ?>"><?php echo $value['diseases'] ?></option>
						<?php } ?>
					</select><br> 

					<label class="content">Test :</label><br>
					<input type="text" name="test" class="content-c" id="test">

					<label class="content">Test Clinic Name :</label><br>
					<select class="content-c"name="tcname" id="tcname">
						<option selected disabled>Test Clinic..</option>
						<?php foreach ($testclinics as $value) {?>
							<option value="<?php echo $value['tcname'] ?>"><?php echo $value['tcname'] ?></option>
						<?php } ?>
					</select><br>

					<label class="content">Report :</label><br>
					<input type="text" id="report" name="report" class="content-c" placeholder="write report here"><br>

					<label class="content">Medicines :</label><br>
					<textarea type="text" id="medicines" name="medicines" class="content-c" placeholder="write medicines here"></textarea><br><br>

					<input type="submit" name="edit" value="Submit" class="prescrive"onclick="return confirm ('Are you sure want to edit?');">
					<!--<a href="../control/DoctorsControls.php?cid=<?php echo $value['id'] ?>" class="prescrive" >Edit</a>
						-->
				</form>
			</div>
		</div>
		<!--popup page ends-->
		<!--search bar and table statrs-->
		<div class="search">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="search name..." id="search_input" onkeyup="search()">
			</div>
		</div>
		<div class="table">
			<table class="table table-hover table-bordered " id="patient_records_list">
			  <thead>
			    <tr class="thead-dark">
			      <th scope="col">SI#</th>
			      <th scope="col">Patient id</th>
			      <th scope="col">Patient name</th>
			      <th scope="col">Clinic name</th>
			      <th scope="col">Time</th>
			      <th scope="col">Date</th>
			      <th scope="col">Symptom</th>
			      <th scope="col">Diseases</th>
			      <th scope="col">Test</th>
			      <th scope="col">Test clinic</th>
			      <th scope="col">Report</th>
				  <th scope="col">Medicines</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($precords as $value) { $id++ ?>
			  		<tr>
						<th><?php echo $id ?></th>
						<td><?php echo $value['pid'] ?></td>
						<td><?php echo $value['pname'] ?></td>
						<td><?php echo $value['cname'] ?></td>
						<td><?php echo $value['time'] ?></td>
						<td><?php echo $value['date'] ?></td>
						<td><?php echo $value['symptom'] ?></td>
						<td><?php echo $value['diseases'] ?></td>
						<td><?php echo $value['test'] ?></td>
						<td><?php echo $value['testclinic'] ?></td>
						<td><?php echo $value['report'] ?></td>
						<td><?php echo $value['medicines'] ?></td>
						<td>
						<button type="button" class="btn btn-danger float-right"style="width: 78px"onclick="prescrive('<?php echo $value['pname']?>','<?php echo $value['pid']?>','<?php echo $value['id']?>','<?php echo $value['diseases']?>','<?php echo $value['symptom']?>','<?php echo $value['test']?>','<?php echo $value['testclinic']?>','<?php echo $value['report']?>','<?php echo $value['medicines']?>')">Edit</button>
						<!--<a href="../control/DoctorsControls.php?cid=<?php echo $value['id'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure want to edit?');">Edit</a>-->
						</td>
				    </tr>
			  	<?php } ?>
			  </tbody>
			</table>
		</div>
		<!--search bar and table ends-->

	</body>
</html>