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
		<title>Gépjárművek törlése</title>
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
				<a href="g.tor.php" class="navbar-brand">Gépjárművek törlése</a>				
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<!-- <div class="collapse navbar-collapse" id="navbarCollapse">										
					<div class="container-fluid">
						<form action="g_tor.php" method="post">
								<table class="table-responsive">
									<tr>
										<td class="nav-item text-warning">Rendszám:</td>
										<td><input type="text" name="Keres_szoveg" /></td>
										<td align="center"><input name="Keres" type="submit" value="Keres" /></td>
									</tr>
								</table>							
						</form>
					</div>		 -->	

					<div class="navbar-nav ms-auto">
						<a href="alk.php" class="nav-item nav-link">Vissza</a>              	
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>
				<!-- </div>	 -->

			</div>
		</nav>

		<div class="container-fluid table table-responsive">
		<div class="container-fluid">
			<form action="g_tor.php" method="post">
				<div class="row-responsible">
					<a>Rendszám:</a>
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
				$_SESSION['g_rsz_keres'] = $_POST['Keres_szoveg'];	
				if($lekerdezes = $db->query ("SELECT * FROM `gjarmu` WHERE `g_rsz` = '".$_POST['Keres_szoveg']."'"))
				{										
					if ($lekerdezes->num_rows)
					{																			
						echo '<table>';
							echo '<br>';
							echo '<thead>';
								echo ' <tr>';
									
									echo '<th>Rendszám</th>';
									echo '<th>Forgalmi engedély</th>';
									echo '<th>Típus</th>';
									echo '<th>Státusz</th>';
									echo '<th>Törölt</th>';
									echo '<th>Megjegyzés</th>';
												
								echo ' </tr>';
							echo '</thead>';
										
							echo '<tbody>';
								foreach($lekerdezes as $sor)
								{
									echo '<tr>';
											
										echo '<td>'.$sor['g_rsz'].'</td>';
										echo '<td>'.$sor['g_feng'].'</td>';
										echo '<td>'.$sor['g_tip'].'</td>';
										echo '<td>'.$sor['g_s'].'</td>';
										echo '<td>'.$sor['g_t'].'</td>';
										echo '<td>'.$sor['g_mj'].'</td>';
																							
									echo '</tr>';
								}
								$_SESSION['g_rsz_torolt'] = $sor['g_rsz'];
							echo '</tbody>';

						echo '</table>';

						//Törlés nyomógomb		
						echo '<div class="container-fluid">';
							echo '<form action="g_tor.php" method="post">';
								echo '<br>';
								echo '<input name="Torles" type="submit" value="Törlés" />';
							echo '</form>';
						echo '</div>';
												
					}
                                        else
					{
						echo "Nincs találat!";
					}
									
				}
		
			}
			if (isset($_POST['Torles'])){
				if($db->query("UPDATE `gjarmu` SET `g_t`=1 WHERE `g_rsz` = '".$_SESSION['g_rsz_keres']."'"))
				{
					if ($db->affected_rows==0)
					{
						echo "A gépjármű korábban már törölve lett!";
					}
					else
					{
						echo $db->affected_rows." db, ".$_SESSION['g_rsz_torolt']." rendszámú gépjármű törlése megtörtént!";
					}					
				}
                                else
				{
					echo "Az adatbázishoz történő kapcsolódás sikertelen. A törlés nem ment végve!";
				}
			}
			$db->close();
			
		?>
		</div>

	</body>

</html>