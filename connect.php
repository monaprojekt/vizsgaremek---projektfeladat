<?php
	$db = new mysqli('172.16.3.14','client5178umona','mona76','client5178dbmona');
        //$db = new mysqli('127.0.0.1','root','','projektmunka_db');
	
	//ha hiba van az adatbázis kapcsolódáshoz, akkor logikai 1 lesz, és kiírja a hibakódot, és vége
	if($db->connect_errno)
	{		
		echo $db->connect_error;  
		die();
	}
?>