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
		<title>Jogok módosítása</title>
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
				<a href="jog_mod.php" class="navbar-brand">Jogok módosítása</a>				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<!-- <div class="collapse navbar-collapse" id="navbarCollapse">					
										
					<div class="container-fluid">
						<form action="jog_mod.php" method="post">
								<table class="table-responsive">
									<tr>
										<td class="nav-item text-warning">Jogazonosító:</td>
										<td><input type="text" name="Keres_szoveg" /></td>
										<td align="center"><input name="Keres" type="submit" value="Keres" /></td>
									</tr>
								</table>							
						</form>
					</div> -->
					
					<div class="navbar-nav ms-auto">              	
						<a href="jog.php" class="nav-item nav-link">Vissza</a>
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>

				<!-- </div>	-->

			</div>
		</nav>
                
                <div class="container-fluid table table-responsive">
		<div class="container-fluid">
			<form action="jog_mod.php" method="post">
				<div class="row-responsible">
					<a>Jogazonosító:</a>
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
				$_SESSION['jog_mod_keres'] = $_POST['Keres_szoveg'];
				if($lekerdezes = $db->query ("SELECT * FROM `jogok` WHERE `jog_ID` = '".$_POST['Keres_szoveg']."'"))
				{										
					if ($lekerdezes->num_rows)
					{																				
						echo '<table table-responsible border="1">';
							echo '<br>';
							echo '<thead>';
								echo ' <tr>';
												
									echo '<th>Jogazonosító</th>';
									echo '<th>Megnevezés</th>';
									echo '<th>Törölt</th>';
									echo '<th>Megjegyzés</th>';
																								
								echo ' </tr>';
							echo '</thead>';
										
							echo '<tbody>';
								foreach($lekerdezes as $sor)
									{
										echo '<tr>';
													
											echo '<td>'.$sor['jog_ID'].'</td>';
											echo '<td>'.$sor['jog_nev'].'</td>';
											echo '<td>'.$sor['jog_t'].'</td>';
											echo '<td>'.$sor['jog_mj'].'</td>';
																																														
										echo '</tr>';
									}
							echo '</tbody>';
						echo '</table>';
			
	
		?>
						</div>

						<br>
						<div class="container-fluid">
							<form action="jog_mod.php" method="post" class="row">
								<table class="table table-responsible" align="center" style="width: 35% !important";>
									<tr>
										<td>Jogazonosító:</td>
										<td><input type="text" name="jog_ID" value= <?php echo $sor['jog_ID']; ?> disabled /> *</td>
									</tr>
									<tr>
										<td>Megnevezés:</td>
										<td><input type="text" name="jog_nev" value= <?php echo '"'.$sor['jog_nev'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Megjegyzés:</td>
										<td><input type="text" name="jog_mj" value= <?php echo '"'.$sor['jog_mj'].'"'; ?> /></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><input name="update" type="submit" value="Mentés" /></td>
									</tr>
								</table> 
							</form>
						</div>
						<div class="container-fluid table table-responsible">		
		<?php
					}
                          else
					{
						echo "Nincs találat!";
					}									
				}
		
			}

		
										
			$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
			if(isset($_POST['update']))
				{
					if($_POST['jog_nev']<>"")
					{
						if($db->query("
						UPDATE `jogok` 
						SET  `jog_nev`='".$_POST['jog_nev']."', `jog_mj`='".$_POST['jog_mj']."'
						WHERE `jog_ID` = '".$_SESSION['jog_mod_keres']."'
						"))
						{
							if($db->affected_rows)
							{
								echo "A jog  adatainak módosítása megtörtént!";
							}
							else
							{
								echo "A jog adatai nem módosultak!";
							}	
						}
						else
						{
							echo "Az adatbázishoz történő kapcsolódás sikertelen. A módosítás nem ment végve!";
						}
					}
					else
					{
						echo ('Hibás kitöltés!');
					}
				}
						
			$db->close();	
				
		?>
		</div>
				
	</body>

</html>