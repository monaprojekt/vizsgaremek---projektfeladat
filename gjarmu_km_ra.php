<?php
    session_start();
    require_once 'connect.php';
    header('Content-Type: application/json; charset=utf-8');

    if( !isset( $_GET['g_rsz'] )  ||  !isset( $_GET['g_km_0'] ) ||  !isset( $_GET['g_fel'] ) ||  !isset( $_GET['g_km_1'] ) ||  !isset( $_GET['g_le'] ) ||  !isset( $_GET['alk_fnev'] ))
    {
	$tomb = array( 'hiba' => "hiányos adatok" ,  'uzenet' => "megadandó paraméterek: g_rsz, g_km_0, g_fel, g_km_1, g_le, alk_fnev" ) ;
    }
    else
    {
		$g_rsz   = $_GET['g_rsz'] ;
		$g_km_0   = $_GET['g_km_0'] ;
		$g_fel   = $_GET['g_fel'] ;
		$g_km_1   = $_GET['g_km_1'] ;
		$g_le   = $_GET['g_le'] ;
		$alk_fnev   = $_GET['alk_fnev'] ;
		
		if($db->query("
											
			INSERT INTO `gjarmu_km` (`g_km_ID`, `g_rsz`, `g_km_0`, `g_fel`, `g_km_1`, `g_le`, `alk_fnev`)
			VALUES (NULL, '".$g_rsz."', '".$g_km_0."', '".$g_fel."', '".$g_km_1."', '".$g_le."', '".$alk_fnev."');
							
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