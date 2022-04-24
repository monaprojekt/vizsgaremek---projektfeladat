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
		<title>Alkalmazott kiléptetés</title>
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
				<a href="alk_tor.php" class="navbar-brand">Alkalmazott kiléptetése</a>				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">										
					<div class="container-fluid">
						<form action="alk_tor.php" method="post">
								<table class="table-responsiv">
									<tr>
										<td class="nav-item text-warning">Felhasználónév:</td>
										<td><input type="text" name="Keres_szoveg" /></td>
										<td align="center"><input name="Keres" type="submit" value="Keres" /></td>
									</tr>
								</table>							
						</form>
					</div>					
										
					<div class="navbar-nav ms-auto">
						<a href="alk.php" class="nav-item nav-link">Vissza</a>              	
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>
				</div>	

			</div>
		</nav>

		<div class="container-fluid table table-responsive">
		<?php			
			
			$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
			if (isset($_POST['Keres_szoveg']))
			{	
				$_SESSION['alk_fnev_keres'] = $_POST['Keres_szoveg'];
				if($lekerdezes = $db->query ("SELECT * FROM `alkalmazott` WHERE `alk_fnev` = '".$_POST['Keres_szoveg']."'"))
				{
										
					if ($lekerdezes->num_rows)
					{
																				
						echo '<table table-responsible border="1">';
							echo '<br>';
								echo '<thead>';
									echo ' <tr>';
												
										echo '<th>Alkalmazotti azonosító</th>';			
										echo '<th>Felhasználónév</th>';			
										echo '<th>Jelszó</th>';			
										echo '<th>Jogazonosító</th>';			
										echo '<th>Jog státusza</th>';			
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
										
									echo '<tbody>';

										foreach($lekerdezes as $sor)
										{
											echo '<tr>';
													
												echo '<td>'.$sor['alk_ID'].'</td>';
												echo '<td>'.$sor['alk_fnev'].'</td>';
												echo '<td>'.$sor['alk_pw'].'</td>';
												echo '<td>'.$sor['jog_ID'].'</td>';
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
										$_SESSION['alk_fnev_torolt'] = $sor['alk_fnev'];
									echo '</tbody>';

						echo '</table>';

						//Törlés nyomógomb		
						echo '<div class="container-fluid">';
							echo '<form action="alk_tor.php" method="post">';
								echo '<br>';
								echo '<input name="Torles" type="submit" value="Kiléptetés" />';
							echo '</form>';
						echo '</div>';
						echo '<br>';
										
					}else
					{
						echo "Nincs találat!";
					}
									
				}
		
			}
			
			if (isset($_POST['Torles'])){
				if($db->query("UPDATE `alkalmazott` SET `alk_ki`=1 WHERE `alk_fnev` = '".$_SESSION['alk_fnev_keres']."'"))
				{
					if ($db->affected_rows==0)
					{
						echo "Az alkalmazott korábban már ki lett léptetve!";
					}
					else
					{
						echo $db->affected_rows." db ".$_SESSION['alk_fnev_torolt']." felhasználónevű alkalmazott kiléptetve.";
					}					
				}else
				{
					echo "Az adatbázishoz történő kapcsolódás sikertelen. A törlés nem ment végve!";
				}
			}
			$db->close();
		?>
		</div>
				
	</body>

</html>