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
		<title>Telephelyek listája</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="stilus.css">
                <link rel="icon" type="image/x-icon" href="favicon.png">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        </head>
		
	<body>
	 	<nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-fixed-top">
				
		 	<div class="container-fluid">			
				<a href="th_list.php" class="navbar-brand">Telephelyek listája</a>				
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
					
					<div class="container-fluid">
						<form action="th_list.php" method="post" class="row" style="width: 90%;>							
							<table class="table-responsive">
								<tr>
									<div></div>	
									<select class="form-select col xs-auto sm-auto md-auto lg-auto" name="select2" aria-label="Default select example">
										<option selected>Válassz mezőtípust!</option>
										<option value="th_ID">Telephely-azonosító</option>
										<option value="th_t">Törölt</option>
										<option value="th_nev">Telephely neve</option>
										<option value="th_irsz">Irányítószám</option>
										<option value="th_v">Város</option>
										<option value="th_cim">Cím</option>
										<option value="th_gynev">Gyűjtőnév</option>
										<option value="th_mj">Megjegyzés</option>
									</select>
									<a class="col xs-auto sm-auto md-auto lg-auto">
										<input type="text" name="Keres_szoveg"/>
										<input name="Keres" type="submit" value="Keres"/></a>											
								</tr>
							</table>
						</form>
					</div>

					<div class="navbar-nav ms-auto">  
						<a href="th.php" class="nav-item nav-link">Vissza</a>            	
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
					$ker_szoveg = "`".$_POST['select2']."`";						
				}
				else //ha írtunk bele vmit, akkor a keres_szoveg értéke a beírt érték lesz
				{
					$ker_szoveg = "'".$_POST['Keres_szoveg']."'";	
				}
				
				//echo $ker_szoveg;
				if($lekerdezes = $db->query ("
												SELECT * 
												FROM `telephely` 
												WHERE `".$_POST['select2']."` = ".$ker_szoveg."
											"))  // a lekérdezésbe bekerül az adatbázis
				{					
					//ha egy és egynél több sor van, akkor...
					if ($lekerdezes->num_rows)
					{   
										
						//$adatok=$lekerdezes2->fetch_all(MYSQLI_NUM);
						$_SESSION['Th_ker_szoveg'] = $ker_szoveg;
						$_SESSION['Th_select2'] = $_POST['select2'];					
						echo '<table table-responsible border="1">';
							echo '<thead>';
								echo '<tr>';
													
								//táblázat fejléce
								echo '<br>';
								echo '<th>Telephely-azonosító</th>';	
								echo '<th>Törölt</th>';	
								echo '<th>Telephely neve</th>';	
								echo '<th>Irányítószám</th>';	
								echo '<th>Város</th>';	
								echo '<th>Cím</th>';	
								echo '<th>Gyűjtőnév</th>';	
								echo '<th>Megjegyzés</th>';	
																								
								echo ' </tr>';
							echo '</thead>';
										
							//adatok kiírása
							echo '<tbody>';									
												
							//sorokra darabolás
							foreach($lekerdezes as $sor)
								{				
									echo '<tr>';
													
									echo '<td>'.$sor['th_ID'].'</td>';
									echo '<td>'.$sor['th_t'].'</td>';
									echo '<td>'.$sor['th_nev'].'</td>';
									echo '<td>'.$sor['th_irsz'].'</td>';
									echo '<td>'.$sor['th_v'].'</td>';
									echo '<td>'.$sor['th_cim'].'</td>';
									echo '<td>'.$sor['th_gynev'].'</td>';
									echo '<td>'.$sor['th_mj'].'</td>';
																																							
									echo '</tr>';
								}
								
								echo '<form action="th_list.php" method="post" class="row">';
									echo '<tr>';
									echo '<td colspan="8" align="center"><input name="mentes" type="submit" value="Mentés fájlba" /></td>';
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
	// Mentés fájlba
	if(isset($_POST['mentes']))
	{
		if($lekerdezes = $db->query ("	SELECT * 
										FROM `telephely` 
										WHERE `".$_SESSION['Th_select2']."` = ".$_SESSION['Th_ker_szoveg']."
										"))  // a lekérdezésbe bekerül az adatbázis
		
		{
			if ($lekerdezes->num_rows)
			{ 
				$hatarolo  =  "," ; 
				$filename  =  "telephelyek_"  .  date('Y-m-d') . ".csv" ; 
				header("Content-Type: text/csv; charset=utf-8");  
				header("Content-Disposition: attachment; filename  =$filename;");  
				// Fájl létrehozása 
				$file  =  fopen ( "php://output",  "w" );
				ob_clean();
				// Oszlopfejlécek beállítása 
				$fejlec  = array('Telephely-azonosító',  'Törölt',  'Telephely neve',  'Irányítószám',  'Város',  'Cím',  'Gyűjtőnév',  'Megjegyzés');
				$fejlec = array_map("utf8_decode", $fejlec);
				fputcsv ( $file ,  $fejlec ,  $hatarolo ); 
				foreach($lekerdezes as $sor)
				{				
					$sorData = array($sor['th_ID'], $sor['th_t'], $sor['th_nev'], $sor['th_irsz'], $sor['th_v'], $sor['th_cim'], $sor['th_gynev'], $sor['th_mj']); 
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