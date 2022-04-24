<?php
    session_start();
    require_once 'connect.php';
    header('Content-Type: application/json; charset=utf-8');

    if( !isset( $_GET['kls_sznev'] )  ||  !isset( $_GET['kls_rsz'] ) ||  !isset( $_GET['kls_be'] ) ||  !isset( $_GET['kls_ki'] ) ||  !isset( $_GET['kls_mj'] ))
    {
	$tomb = array( 'hiba' => "hiányos adatok" ,  'uzenet' => "megadandó paraméterek: kls_sznev, kls_rsz, kls_be, kls_ki, kls_mj" ) ;
    }
    else
    {
		$kls_sznev	= $_GET['kls_sznev'] ;
		$kls_rsz 	        = $_GET['kls_rsz'] ;
		$kls_be		= $_GET['kls_be'] ;
		$kls_ki		= $_GET['kls_ki'] ;
		$kls_mj		= $_GET['kls_mj'] ;
				
		if($db->query("
											
			INSERT INTO `kulsos` (`kls_ID`, `kls_sznev`, `kls_rsz`, `kls_be`, `kls_ki`, `kls_mj`)
			VALUES (NULL, '".$kls_sznev."', '".$kls_rsz."', '".$kls_be."', '".$kls_ki."', '".$kls_mj."');
							
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