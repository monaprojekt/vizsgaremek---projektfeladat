<?php
	ob_start();
	session_start();
	require_once 'connect.php';
	if(!isset($_SESSION['belepve']) or $_SESSION['belepve'] == false)
	{
		header("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="hu">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name='viewport' content='width=device-width, user-scalable=no' /> 
		<meta name="description" content="Vizsgaremek: Porta adminisztrációs rendszer - szerver">
		<meta name="keywords" content="porta, projektmunka, vizsgaremek, szoftverfejlesztés">
		<meta name="author" content="Kósa Mónika Erzsébet">
		<title>Alkalmazottak archiválása</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="stilus.css">
                <link rel="icon" type="image/x-icon" href="favicon.png">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	</head>

	<body>

		<nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-fixed-top w3-card-2 topnav notranslate">
			<div class="container-fluid">				
				<a href="alk_arch.php" class="navbar-brand">Alkalmazottak archiválása</a>				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">										
										
										
					<div class="navbar-nav ms-auto">
						<a href="alk.php" class="nav-item nav-link">Vissza</a>              	
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>
				</div>	

			</div>			
		</nav>

		<div class="container g-0">
			<div class="row">
							
				<div class="col-sm-12 col-md-12 col-lg-12 text-center">
					<br>
					<p>Az alkalmazottak archiválása során a kilépett státuszú (alk_ki: 1) alkalmazottak adatainak fájlba mentése és az érintett alkalmazottak adatbázisból történő törlése valósul meg.</p>
					<hr>
					<!-- <footer class="blockquote-footer">Forrás: https://www.mav-hev.hu/hu/bemutatkozas</footer> -->
				</div>
			</div>
		
    	</div>
		<div class="container-fluid table table-responsive">
		
		<?php	
			if($lekerdezes = $db->query ("
					SELECT * 
					FROM `alkalmazott`
					LEFT JOIN `jogok` ON `alkalmazott`.`jog_ID` = `jogok`.`jog_ID`
					WHERE `alk_ki` = 1
					"))
				{   // a lekérdezésbe bekerül az adatbázis
									
					//ha egy és egynél több sor van, akkor...
					if ($lekerdezes->num_rows)
					{   
						
						echo '<table table table-responsible border="1">';
						echo '<thead>';
							echo ' <tr>';
													
							//táblázat fejléce
							echo '<br>';
							echo '<th>Azonosító</th>';
							echo '<th>Felhasználónév</th>';			
							echo '<th>Jog</th>';
							echo '<th>Jog státusz</th>';
							echo '<th>Adóazonosító jel</th>';
							echo '<th>Név előjel</th>';
							echo '<th>Név</th>';
							echo '<th>Jogviszony kezdete</th>';
							echo '<th>Jogviszony vége</th>';											
							echo '<th>Születési hely</th>';
							echo '<th>Születési idő</th>';
							echo '<th>E-mail</th>';
							echo '<th>Telefonszám</th>';
							echo '<th>Beosztás</th>';
							echo '<th>Vezető</th>';
							echo '<th>Portás</th>';
							echo '<th>Regisztráció ideje</th>';
							echo '<th>Státusz</th>';
							echo '<th>Kilépett</th>';
							echo '<th>Megjegyzés</th>';											
							echo ' </tr>';
						echo '</thead>';
										
						//adatok kiírása
						echo '<tbody>';									
												
						//sorokra darabolás
						foreach($lekerdezes as $sor)
						{				
							echo '<tr>';
								
							echo '<td>'.$sor['alk_ID'].'</td>';
							echo '<td>'.$sor['alk_fnev'].'</td>';
							echo '<td>'.$sor['jog_nev'].'</td>';
							echo '<td>'.$sor['jog_s'].'</td>';
							echo '<td>'.$sor['alk_aj'].'</td>';
							echo '<td>'.$sor['alk_nev0'].'</td>';
							echo '<td>'.$sor['alk_nev'].'</td>';
							echo '<td>'.$sor['alk_jv_0'].'</td>';
							echo '<td>'.$sor['alk_jv_1'].'</td>';
							echo '<td>'.$sor['alk_szhely'].'</td>';
							echo '<td>'.$sor['alk_szido'].'</td>';
							echo '<td>'.$sor['alk_mail'].'</td>';
							echo '<td>'.$sor['alk_tel'].'</td>';
							echo '<td>'.$sor['alk_beoszt'].'</td>';
							echo '<td>'.$sor['alk_vez'].'</td>';
							echo '<td>'.$sor['alk_p'].'</td>';
							echo '<td>'.$sor['alk_regido'].'</td>';
							echo '<td>'.$sor['alk_s'].'</td>';
							echo '<td>'.$sor['alk_ki'].'</td>';
							echo '<td>'.$sor['alk_mj'].'</td>';
																							
							echo '</tr>';
						}
					
		?>			
						<div class="container-fluid" >
							<form action="alk_arch.php" method="post">
                                     <table valign="middle" align="center">
										<tr>
											<br>
                                            <td colspan="2" align="center">Biztos, hogy archiválja az alkalmazottakat?</td>
										</tr>
										<tr>
											<td align="center"><input name="arch_igen" type="submit" value="Igen" /></td>
											<td align="center"><input name="arch_nem" type="submit" value="Nem" /></td>
										</tr>
									</table>							
							</form>
						</div>
		<?php	
					}
					else
					{
						echo "Nincs archiválandó!";
					}
				}
				
		?>
		</div>
	</body>
</html>
<?php	
	if (isset($_POST['arch_nem']))
	{
		header("Location: alk.php");
		exit();
	}
	
	if (isset($_POST['arch_igen']))
	{	
		// Kilépett alkalmazottak mentése
		if($lekerdezes = $db->query ("	SELECT * 
										FROM `alkalmazott` 
										LEFT JOIN `jogok` ON `alkalmazott`.`jog_ID` = `jogok`.`jog_ID`
										WHERE `alk_ki` = '1'"))
		{
								
			if ($lekerdezes->num_rows)
			{
				// Puffer törlése
																
				$hatarolo  =  "," ; 
				$filename  =  "alk_arch_"  .  date('Y-m-d') . ".csv" ;
				header("Content-Type: text/csv; charset=utf-8");  
				header("Content-Disposition: attachment; filename  =$filename;");  
				// Fájl létrehozása 
				$file  =  fopen ( "php://output",  "w" );
				ob_clean();
				// Oszlopfejlécek beállítása 
				$fejlec  = array( 	'Azonosító',  'Felhasználónév',  ' Jog',  'Jog státusz',  'Adóazonosító jel',  'Név előjel',  'Név',  'Jogviszony kezdete',
									'Jogviszony vége', 'Születési hely', 'Születési idő', 'E-mail', 'Telefonszám', 'Beosztás', 'Vezető', 'Portás',
									 'Regisztráció ideje', 'Státusz', 'Kilépett', 'Megjegyzés'
								);
				$fejlec = array_map("utf8_decode", $fejlec);
				fputcsv ( $file ,  $fejlec ,  $hatarolo ); 
				foreach($lekerdezes as $sor)
				{				
					$sorData = array(	$sor['alk_ID'], $sor['alk_fnev'], $sor['jog_nev'], $sor['jog_s'], $sor['alk_aj'], $sor['alk_nev0'], $sor['alk_nev'], $sor['alk_jv_0'], 
										$sor['alk_jv_1'], $sor['alk_szhely'], $sor['alk_szido'], $sor['alk_mail'], $sor['alk_tel'], $sor['alk_beoszt'], $sor['alk_vez'],
										$sor['alk_p'], $sor['alk_regido'], $sor['alk_s'], $sor['alk_ki'], $sor['alk_mj']
									); 
					$sorData = array_map("utf8_decode", $sorData);	
					fputcsv($file, $sorData, $hatarolo); 
				}
				ob_flush();
				fclose($file);
				// Klépett alkalmazottak törlése az adatbázisból
				
				if($lekerdezes = $db->query ("
					DELETE 
					FROM `alkalmazott` 
					WHERE `alk_ki` = '1'"))
				{
				
				}
				
			}
							
		}
	}
	
	$db->close();
		
?>