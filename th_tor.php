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
		<title>Telephely törlése</title>
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
				<a href="th_tor.php" class="navbar-brand">Telephely törlése</a>				
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<!-- <div class="container-fluid">
					<form action="th_tor.php" method="post">
						<table class="table-responsive">
							<tr>
								<td class="nav-item text-warning">Telephely-azonosító:</td>
									<td><input type="text" name="Keres_szoveg" /></td>
									<td align="center"><input name="Keres" type="submit" value="Keres" /></td>
								</tr>
							</table>							
					</form>
				</div> -->

				<div class="navbar-nav ms-auto"> 
					<a href="th.php" class="nav-item nav-link">Vissza</a>             	
					<a href="logout.php" class="nav-item nav-link">Kilépés</a>
				</div>

			</div>
		</nav>
                
                <div class="container-fluid table table-responsive">
		<div class="container-fluid">
			<form action="th_tor.php" method="post">
				<div class="row-responsible">
					<a>Telephely-azonosító:</a>
					<a><input type="text" name="Keres_szoveg" /></a>
					<a><input name="Keres" type="submit" value="Keres" /></a>
				</div>
			</form>
		</div>		

		<div class="container-fluid table table-responsive">
			<?php
			
				$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
				if (isset($_POST['Keres_szoveg']))
				{		
					$_SESSION['th_ID_keres'] = $_POST['Keres_szoveg'];				
					if($lekerdezes = $db->query ("SELECT * FROM `telephely` WHERE `th_ID` = '".$_POST['Keres_szoveg']."'"))
					{
												
						if ($lekerdezes->num_rows)
						{
																				
							echo '<table table-responsible border="1">';
								echo '<br>';
								echo '<thead>';
								echo ' <tr>';
									
								echo '<th>Telephely-azonosító</th>';
								echo '<th>Telephely neve</th>';
								echo '<th>Irányítószám</th>';
								echo '<th>Város</th>';
								echo '<th>Cím</th>';;
								echo '<th>Gyűjtőnév</th>';;
								echo '<th>Megjegyzés</th>';;
												
								echo ' </tr>';
								echo '</thead>';
											
								echo '<tbody>';

									foreach($lekerdezes as $sor)
									{
										echo '<tr>';
												
                                            echo '<td>'.$sor['th_ID'].'</td>';
                                            echo '<td>'.$sor['th_nev'].'</td>';
                                            echo '<td>'.$sor['th_irsz'].'</td>';
                                            echo '<td>'.$sor['th_v'].'</td>';
                                            echo '<td>'.$sor['th_cim'].'</td>';
                                            echo '<td>'.$sor['th_gynev'].'</td>';
                                            echo '<td>'.$sor['th_mj'].'</td>';
																								
										echo '</tr>';
									}
									$_SESSION['th_ID_torolt'] = $sor['th_ID'];
								echo '</tbody>';

							echo '</table>';

							//Törlés nyomógomb		
							echo '<div class="container-fluid">';
								echo '<form action="th_tor.php" method="post">';
									echo '<br>';
									echo '<input name="Torles" type="submit" value="Törlés" />';
								echo '</form>';
							echo '</div>';
											
						}else
						{
							echo "Nincs találat!";
						}
										
					}
			
				}

				if (isset($_POST['Torles']))
				{
					if($db->query("UPDATE `telephely` SET `th_t`=1 WHERE `th_ID` = '".$_SESSION['th_ID_keres']."'"))
					{
						if ($db->affected_rows==0)
						{
							echo "A telephely korábban már törölve lett!";
						}
						else
						{
							echo $db->affected_rows." db, ".$_SESSION['th_ID_torolt']." azonosítószámú telephely törlése megtörtént!";
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