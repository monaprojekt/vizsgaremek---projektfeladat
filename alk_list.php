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
<html>

<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Vizsgaremek: Porta adminisztrációs rendszer - szerver">
		<meta name="keywords" content="porta, projektmunka, vizsgaremek, szoftverfejlesztés">
		<meta name="author" content="Kósa Mónika Erzsébet">
		<title>Alkalmazottak listája</title>
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
				<a href="alk_list.php" class="navbar-brand">Alkalmazottak listája</a>
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
				</button>		
									
				<div class="container-fluid">
					<form action="alk_list.php" method="post" class="row";>							
						<table class="table-responsive">
							<tr>
								<div></div>

								<!-- legördülő menü -->
								<select class="form-select col xs-auto sm-auto md-auto lg-auto" name="select1" aria-label="Default select example">
									<option selected>Válassz mezőtípust!</option>
									<option value="alk_ID">Azonosító</option>
									<option value="alk_fnev">Felhasználónév</option>
									<option value="alk_aj">Adóazonosító jel</option>
									<option value="alk_nev0">Név előjel</option>
									<option value="alk_nev">Név</option>
									<option value="alk_beoszt">Beosztás</option>
									<option value="jog_ID">Jog</option>
									<option value="jog_s">Jog státusza</option>
									<option value="alk_beoszt">Jogviszony kezdete</option>
									<option value="alk_beoszt">Jogviszony vége</option>
									<option value="alk_szhely">Születési hely</option>
									<option value="alk_szido">Születési idő</option>
									<option value="alk_mail">E-mail</option>
									<option value="alk_tel">Telefonszám</option>							 
									<option value="alk_vez">Vezető</option>
									<option value="alk_p">Portás</option>
									<option value="alk_regido">Regisztrálás ideje</option>
									<option value="alk_s">Státusz</option>
									<option value="alk_ki">Kilépett</option>
									<option value="alk_mj">Megjegyzés</option>
								</select>
									<a class="col xs-auto sm-auto md-auto lg-auto">
										<input type="text" name="Keres_szoveg"/>
										<input name="Keres" type="submit" value="Keres"/></a>											
							</tr>
						</table>
					</form>
				</div>

				<div class="navbar-nav ms-auto">  
					<a href="alk.php" class="nav-item nav-link">Vissza</a>            	
					<a href="logout.php" class="nav-item nav-link">Kilépés</a>
				</div>	

			</div>
		</nav>
		
		<div class="container-fluid table table-responsive">
		<?php
			
			$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
			//megnézi, hogy a keres_szoveg változó létrejött-e már, és csak utána engedi lefutni a lentit, ahol a változót felhasználjuk
			if (isset($_POST['Keres_szoveg']))
			{						
					
				//ha nem írtunk be semmit a keres részbe, akkor kilistázza mindet (a keres_szoveg változó a ` értéket, a kiválasztott mezőt és a ` értéket veszi fel)
				if($_POST['Keres_szoveg']=="")
				{						
					$ker_szoveg = "`".$_POST['select1']."`";
					//ha írtunk bele vmit, akkor a keres_szoveg értéke a beírt érték lesz
				}else
				{
					$ker_szoveg = "'".$_POST['Keres_szoveg']."'";	
				}
					
				//echo $ker_szoveg;
						
				if($lekerdezes = $db->query ("
					SELECT * 
					FROM `alkalmazott`
					LEFT JOIN `jogok` ON `alkalmazott`.`jog_ID` = `jogok`.`jog_ID`
					WHERE `".$_POST['select1']."` = ".$ker_szoveg."
					"))
				{   // a lekérdezésbe bekerül az adatbázis
									
					//ha egy és egynél több sor van, akkor...
					if ($lekerdezes->num_rows)
					{   
											
						//$adatok=$lekerdezes->fetch_all(MYSQLI_NUM);
						$_SESSION['Alk_ker_szoveg'] = $ker_szoveg;
						$_SESSION['Alk_select1'] = $_POST['select1'];
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
						
							echo '<form action="alk_list.php" method="post" class="row">';
								echo '<tr>';
								echo '<td colspan="20" align="center"><input name="mentes" type="submit" value="Mentés fájlba" /></td>';
								echo '</tr>';
							echo '</form>';
						
						echo '</tbody>';
						echo '</table>';
									
					}
					else
					{
						echo "Nincs találat!";
					}	
				}
			}
		?>
		</div>

  	</body>

</html>
<?php
	
	//Mentés fájlba
	if(isset($_POST['mentes']))
	{	
	
		if($lekerdezes = $db->query ("	SELECT * 
												FROM `alkalmazott`
												LEFT JOIN `jogok` ON `alkalmazott`.`jog_ID` = `jogok`.`jog_ID`
												WHERE `".$_SESSION['Alk_select1']."` = ".$_SESSION['Alk_ker_szoveg']."
												"))
		{
			
			if ($lekerdezes->num_rows)
			{ 
				// Puffer törlése
				$hatarolo  =  "," ; 
				$filename  =  "alkalmazott_"  .  date('Y-m-d') . ".csv" ;
				
				header("Content-Type: text/csv; charset=utf-8");  
				header("Content-Disposition: attachment; filename  =$filename;");  
				// Fájl létrehozása 
				$file  =  fopen ("php://output",  "w" );
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
			}
		}
	}	
	$db->close();
	
?>