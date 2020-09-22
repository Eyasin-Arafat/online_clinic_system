<?php
	$servername="db4free.net";
	$username="finalproject";
	$password="123456789";
	$databasename="online_clinic";

	//execute query into database
	function execute ($query)
	{
			global $servername;
			global $username;
			global $password;
			global $databasename;
			$conn=mysqli_connect($servername,$username,$password,$databasename);
			$result=mysqli_query($conn,$query);
			return $result;
	}
	//getdata from database
	function getdata ($query)
	{
		global $servername;
		global $username;
		global $password;
		global $databasename;
		$data=array();    //normal array
		$conn=mysqli_connect($servername,$username,$password,$databasename);
		$result=mysqli_query($conn,$query);
		if (mysqli_num_rows($result)>0) {
			while ($rows=mysqli_fetch_assoc($result)) {
				$entity=array();//associative array
				foreach ($rows as $key => $value) {
					$entity[$key]=$rows[$key];
				}
				$data[]=$entity;
			}
		}
		mysqli_close($conn);
		return $data;//return associative array
	}
	
?>
