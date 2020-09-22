<?php 
include '../db/db_connect.php';
$uid="";
$pass="";
$status="";
if (isset($_POST['submit'])) {
	$uid=$_POST['uid'];
	$pass=$_POST['pass'];
	$pass=password_hash($pass, PASSWORD_DEFAULT);
	$status=$_POST['status'];
	$query="INSERT INTO `users`(`id`, `userid`, `password`, `status`) VALUES (NULL,'$uid','$pass','$status')";
	execute($query);
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>admin</title>
</head>
<body>
	<form action="" method="post">
		userid
		<input type="text" name="uid"><br>
		pass
		<input type="text" name="pass"><br>
		status
		<input type="text" name="status"><br>
		<input type="submit" name="submit">
	</form>
</body>
</html>