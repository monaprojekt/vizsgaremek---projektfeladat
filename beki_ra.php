<?php
    session_start();
    require_once 'connect.php';
    header('Content-Type: application/json; charset=utf-8');

    if( !isset( $_GET['alk_fnev'] )  ||  !isset( $_GET['alk_be'] ) ||  !isset( $_GET['alk_ki'] ) ||  !isset( $_GET['alk_ip'] ) ||  !isset( $_GET['alk_ses'] ))
    {
	$tomb = array( 'hiba' => "hiányos adatok" ,  'uzenet' => "megadandó paraméterek: alk_fnev, alk_be, alk_ki, alk_ip, alk_ses" ) ;
    }
    else
    {
		$alk_fnev	= $_GET['alk_fnev'] ;
		$alk_be 	= $_GET['alk_be'] ;
		$alk_ki		= $_GET['alk_ki'] ;
		$alk_ip		= $_GET['alk_ip'] ;
		$alk_ses	= $_GET['alk_ses'] ;		
		
		if($db->query("											
			INSERT INTO `beki` (`beki_ID`, `alk_fnev`, `alk_be`, `alk_ki`, `alk_ip`, `alk_ses`)
			VALUES (NULL, '".$alk_fnev."', '".$alk_be."', '".$alk_ki."', '".$alk_ip."', '".$alk_ses."');							
			"))
		{
			$tomb = array( 'hiba' => "" ,  'uzenet' => "Sikeres felvitel az adatbázisba." ) ;
		}
		else
		{
			$tomb = array( 'hiba' => "adatbázis beírás hiba" ,  'uzenet' => "Sikertelen felvitel az adatbázisba." ) ;	
		}			
	}	
    $json = json_encode( $tomb , JSON_UNESCAPED_UNICODE ) ;
    print $json ;
?>