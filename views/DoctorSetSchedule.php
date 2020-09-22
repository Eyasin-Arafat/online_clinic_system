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
	$uid=$_SESSION['did'];
	$clinics=clinics();
	$schedules=schedule($_SESSION['did']);
?>
<html>
	<head>
		<title>
			Doctor Set Schedule
		</title>
		<link rel="stylesheet"type="text/css"href="CSS/doctorcss.css">
		<link rel="stylesheet"type="text/css"href="CSS/setschedule.css">
		<!--clinic date time starts-->
		<script>
			//for slot 1//
		function cname1()
		{
			http=new XMLHttpRequest();
			var search_word=document.getElementById("cname").value;
			http.onreadystatechange=function()
			{
				if (http.readyState==4 && http.status==200) 
				{
					//alert(http.responseText);
					//alert(document.getElementById("cname").value);
					document.getElementById("date").innerHTML=http.responseText;

					
				}
				else if (http.status==404) 
				{
					alert("not found");
				}
			}
			http.open("GET","../php/SetDateS1.php?sk="+search_word,true);
			http.send();
		}
		function date1()
		{
			http=new XMLHttpRequest();
			var search_word=document.getElementById("date").value;
			http.onreadystatechange=function()
			{
				if (http.readyState==4 && http.status==200) 
				{
					//alert(http.responseText);
					//alert(document.getElementById("date").value);
					document.getElementById("time").innerHTML=http.responseText;
				}
				else if (http.status==404) 
				{
					alert("not found");
				}
			}
			http.open("GET","../php/SetTimeS1.php?tk="+search_word,true);
			http.send();
		}
	</script>
	<!--clinic date time ends-->
	</head>
	<body>
		<button class="button"onclick="window.location='../php/LogoutControl.php'">Logout</button>
		<button type="button"name="home"class="button"onclick="window.location='DoctorHomePage.php'">Home Page</button>
		<div class="div1">
			<h2>Set Schedule</h2>
		</div>
		<!--for slot 1-->
		<div class="div2">
			<label class="err"><?php echo $err_mgss; ?></label>
			<h3>Find Clinic</h3>
			<form method="post" action="">
				<div class="div3">
					<label>Your User Id</label><br>
					<input type="text" class="field" name="uid" value="<?php echo $_SESSION['did']; ?>"readonly><br>
					<label>Clinic Name</label><br>
					<select class="field" name="cname" id="cname" onchange="cname1()" required>
						<option selected disabled value=" ">Clinics..</option>
						<?php foreach ($clinics as $value) { ?>
							<option value="<?php echo $value['cname'] ?>" ><?php echo $value['cname'] ?></option>
						<?php } ?>
					</select><br>

					<label>Date</label><br>
					<select class="field"name="date" id="date" onchange="date1()" required>
						<option selected disabled value=" ">Date..</option>
					</select><br>

					<label>Time</label><br>
					<select class="field"name="time" id="time" required>
						<option selected disabled value=" ">Time..</option>
					</select><br><br>
					<!--submit button here -->
					<button name="slot1"class="submit" onclick=location.href='../php/DoctorsControls.php'>Add Clinic</button>
				</div>
			</form>	
		</div>
		<div class="table">
		<table class="table table-hover table-bordered ">
			<thead>
			    <tr class="thead-dark">
					<th scope="col">SI#</th>
					<th scope="col">Clinic name</th>
					<th scope="col">Time</th>
					<th scope="col">Date</th>
					<th scope="col">Divission</th>
					<th scope="col">District</th>
					<th scope="col">Thana</th>
					<th scope="col">Action</th>
			    </tr>
			</thead>
			  	<tbody>
			  		<?php foreach ($schedules as $value) {$id++;?>
			  			<tr>
			  				<td><?php echo $id ?></td>
			  				<td><?php echo $value['cname']?></td>
			  				<td><?php echo $value['time']?></td>
			  				<td><?php echo $value['date']?></td>
			  				<td><?php echo $value['divission']?></td>
			  				<td><?php echo $value['district']?></td>
			  				<td><?php echo $value['thana']?></td>s
			  				<td>
								<a href="../php/DoctorsControls.php?schedule=<?php echo $value['id'] ?>" class="btn btn-danger float-right"style="width: 70px" onclick="return confirm ('Are you sure to delete?');">Delete</a>
							</td>
						</tr>
			  		<?php } ?>
						
			  	</tbody>
			</table>
		</div>
		<!--search bar & table ends-->
	</body>
</html>