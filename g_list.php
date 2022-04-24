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
		<title>Gépjárművek listája</title>
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
				<a href="g_list.php" class="navbar-brand">Gépjárművek listája</a>				
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
					
					<div class="container-fluid">
						<form action="g_list.php" method="post" class="row" style="width: 90%;>							
							<table class=" table-responsive>
								<tr>
									<div></div>	
									<select class="form-select col xs-auto sm-auto md-auto lg-auto" name="select2" aria-label="Default select example">
										<option selected>Válassz mezőtípust!</option>
										<option value="g_ID">Gégjármű azonosító</option>
										<option value="g_rsz">Rendszám</option>
										<option value="g_feng">Forgalmi engedély</option>
										<option value="g_tip">Típus</option>
										<option value="g_s">Státusz</option>
										<option value="g_t">Törölt</option>
										<option value="g_mj">Megjegyzés</option>
									</select>
									<a class="col xs-auto sm-auto md-auto lg-auto">
										<input type="text" name="Keres_szoveg"/>
										<input name="Keres" type="submit" value="Keres"/></a>											
								</tr>
							</table>
						</form>
					</div>

					<div class="navbar-nav ms-auto">  
						<a href="g.php" class="nav-item nav-link">Vissza</a>            	
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
				if($lekerdezes = $db->query ("SELECT * FROM `gjarmu` WHERE `".$_POST['select2']."` = ".$ker_szoveg.""))
				{   // a lekérdezésbe bekerül az adatbázis
									
					//ha egy és egynél több sor van, akkor...
					if ($lekerdezes->num_rows)
					{   
										
						//$adatok=$lekerdezes2->fetch_all(MYSQLI_NUM);
						$_SESSION['Gep_ker_szoveg'] = $ker_szoveg;
						$_SESSION['Gep_select2'] = $_POST['select2'];				
						echo '<table table-responsible border="1">';
							echo '<thead>';
								echo '<tr>';
													
								//táblázat fejléce
								echo '<br>';
								echo '<th>Gépjármű azonosító</th>';			
								echo '<th>Rendszám</th>';
								echo '<th>Forgalmi engedély</th>';
								echo '<th>Típus</th>';
								echo '<th>Státusz</th>';
								echo '<th>Törölt</th>';
								echo '<th>Megjegyzés</th>';
																								
								echo ' </tr>';
							echo '</thead>';
										
							//adatok kiírása
							echo '<tbody>';									
												
							//sorokra darabolás
							foreach($lekerdezes as $sor)
								{				
									echo '<tr>';
													
									echo '<td>'.$sor['g_ID'].'</td>';
									echo '<td>'.$sor['g_rsz'].'</td>';
									echo '<td>'.$sor['g_feng'].'</td>';
									echo '<td>'.$sor['g_tip'].'</td>';
									echo '<td>'.$sor['g_s'].'</td>';
									echo '<td>'.$sor['g_t'].'</td>';
									echo '<td>'.$sor['g_mj'].'</td>';
																														
									echo '</tr>';
								}
								echo '<form action="g_list.php" method="post" class="row">';
									echo '<tr>';
									echo '<td colspan="7" align="center"><input name="mentes" type="submit" value="Mentés fájlba" /></td>';
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
										FROM `gjarmu` 
										WHERE `".$_SESSION['Gep_select2']."` = ".$_SESSION['Gep_ker_szoveg']."
									"))
		{
			if ($lekerdezes->num_rows)
			{ 
				$hatarolo  =  "," ; 
				$filename  =  "gepjarmuvek_"  .  date('Y-m-d') . ".csv" ;
				header("Content-Type: text/csv; charset=utf-8");  
				header("Content-Disposition: attachment; filename  =$filename;");  
				// Fájl létrehozása 
				$file  =  fopen ("php://output",  "w" );
				ob_clean();
				// Oszlopfejlécek beállítása 
				$fejlec  = array('Gépjármű azonosító',  'Rendszám ',  'Forgalmi engedély',  'Típus',  'Státusz',  'Törölt',  'Megjegyzés'); 
				$fejlec = array_map("utf8_decode", $fejlec);
				fputcsv ( $file ,  $fejlec ,  $hatarolo ); 
				foreach($lekerdezes as $sor)
				{				
					$sorData = array(	$sor['g_ID'], $sor['g_rsz'], $sor['g_feng'], $sor['g_tip'], $sor['g_s'], $sor['g_t'], $sor['g_mj']); 
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