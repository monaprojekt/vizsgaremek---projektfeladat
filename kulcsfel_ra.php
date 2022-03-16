<?php
	session_start();
	require_once 'connect.php';
    header('Content-Type: application/json; charset=utf-8');

    if( !isset( $_GET['k_ID'] )  ||  !isset( $_GET['alk_fnev'] ) ||  !isset( $_GET['k_ido_0'] ) ||  !isset( $_GET['k_ido_1'] ))
    {
	$tomb = array( 'hiba' => "hiányos adatok" ,  'uzenet' => "megadandó paraméterek: k_ID, alk_fnev, k_ido_0, k_ido_1" ) ;
    }
    else
    {

		$k_ID		= $_GET['k_ID'] ;
		$alk_fnev 	= $_GET['alk_fnev'] ;
		$k_ido_0	= $_GET['k_ido_0'] ;
		$k_ido_1	= $_GET['k_ido_1'] ;
		
		
		if($db->query("
											
			INSERT INTO `kulcsfel` (`k_fel_ID`, `k_ID`, `alk_fnev`, `k_ido_0`, `k_ido_1`)
			VALUES (NULL, '".$k_ID."', '".$alk_fnev."', '".$k_ido_0."', '".$k_ido_1."');
							
			"))
		{
			$tomb = array( 'hiba' => "" ,  'uzenet' => "Sikeres felvitel az adatbázisba." ) ;
		}
		else
		{
			$tomb = array( 'hiba' => "adatbázis beírás hiba" ,  'uzenet' => "Sikerestelen felvitel az adatbázisba." ) ;	
		}
			
	}
	
	
	
    $json = json_encode( $tomb , JSON_UNESCAPED_UNICODE ) ;

    print $json ;

?>