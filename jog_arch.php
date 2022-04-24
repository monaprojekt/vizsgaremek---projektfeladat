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
		<title>Jogok archiválása</title>
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
				<a href="jog_arch.php" class="navbar-brand">Jogok archiválása</a>				
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>				
					
					<div class="navbar-nav ms-auto">  
						<a href="jog.php" class="nav-item nav-link">Vissza</a>            	
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>	

			</div>
		</nav>
		<div class="container g-0">

			<div class="row">
							
				<div class="col-sm-12 col-md-12 col-lg-12 text-center">
					<br>
					<p>A jogok archiválása során a törölt státuszú (jog_t: 1) jogok adatainak fájlba mentése és az érintett jogok adatbázisból történő törlése valósul meg.</p>
					<hr>
					<!-- <footer class="blockquote-footer">Forrás: https://www.mav-hev.hu/hu/bemutatkozas</footer> -->
				</div>
			</div>
			
    	</div>
		<div class="container-fluid table table-responsive">
			<div class="container-fluid">
		
    <?php
				
				if($lekerdezes = $db->query ("	SELECT * 
												FROM `jogok` 
												WHERE `jog_t` = 1
											"))  // a lekérdezésbe bekerül az adatbázis
				{					
					//ha egy és egynél több sor van, akkor...
					if ($lekerdezes->num_rows)
					{   
						
						echo '<table table-responsible border="1">';
							echo '<thead>';
								echo '<tr>';
													
								//táblázat fejléce
								//echo '<br>';
								echo '<th>Jogazonosító</th>';	
								echo '<th>Megnevezés</th>';	
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
													
									echo '<td>'.$sor['jog_ID'].'</td>';
									echo '<td>'.$sor['jog_nev'].'</td>';
									echo '<td>'.$sor['jog_t'].'</td>';
									echo '<td>'.$sor['jog_mj'].'</td>';
																																							
									echo '</tr>';
								}
		?>			
							<div class="container-fluid table table-responsive">			
								<div class="container-fluid">
									<form action="jog_arch.php" method="post">
										<table valign="middle" align="center">
											<tr>
																				<br>
												<td colspan="2" align="center">Biztos, hogy archiválja a jogokat?</td>
											</tr>
											<tr>
												<td align="center"><input name="arc_igen" type="submit" value="Igen" /></td>
												<td align="center"><input name="arc_nem" type="submit" value="Nem" /></td>
											</tr>
										</table>							
									</form>
								</div>
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
		</div>
  	</body>
</html>
<?php
		
	if (isset($_POST['arc_nem']))
	{
		header("Location: jog.php");
		exit();
	}
	
	if (isset($_POST['arc_igen']))
	{	
		// Kilépett alkalmazottak mentése
		if($lekerdezes = $db->query ("	SELECT * 
										FROM `jogok` 
										WHERE `jog_t` = '1'"))
		{
								
			if ($lekerdezes->num_rows)
			{
																		
				$hatarolo  =  "," ; 
				$filename  =  "jog_arch_"  .  date('Y-m-d') . ".csv" ;
				header("Content-Type: text/csv; charset=utf-8");  
				header("Content-Disposition: attachment; filename  =$filename;");  
				// Fájl létrehozása 
				$file  =  fopen ( "php://output",  "w" );
				ob_clean();
				// Oszlopfejlécek beállítása 
				$fejlec  = array('Jogazonosító',  'Megnevezés',  ' Törölt',  'Jog státusz',  'Megjegyzés');
				$fejlec = array_map("utf8_decode", $fejlec);
				fputcsv ( $file ,  $fejlec ,  $hatarolo ); 
				foreach($lekerdezes as $sor)
				{				
					$sorData = array($sor['jog_ID'], $sor['jog_nev'], $sor['jog_t'], $sor['jog_mj']); 
					$sorData = array_map("utf8_decode", $sorData);	
					fputcsv($file, $sorData, $hatarolo); 
				}
				ob_flush();
				fclose($file);
				// Klépett alkalmazottak törlése az adatbázisból
				
				if($lekerdezes = $db->query ("
					DELETE 
					FROM `jogok` 
					WHERE `jog_t` = '1'"))
				{
										
				}
				 
							
			}
		}
	}
	$db->close();

?>