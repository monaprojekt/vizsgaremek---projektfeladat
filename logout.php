<?php
	session_start();
	require_once 'connect.php';
		
	$ipaddress =  $_SERVER['REMOTE_ADDR'];
	$session = session_status();

		if($db->query("
			INSERT INTO `beki` 	(`alk_fnev`, `alk_be`, `alk_ki`, `alk_ip`, `alk_ses`)
			VALUES 				('".$_SESSION['username']."', '".$_SESSION['belep_ido']."', NOW(), '".$ipaddress."', '".$seisson."');
		"))
		{
			//kiírja hány sort adott hozzá az adatbázishoz
			//echo $db->affected_rows;			
		}
		
	$db->close();
	$_SESSION['belepve']=false; 
	header("Location: index.php");
	exit();
?>