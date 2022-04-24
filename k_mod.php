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
		<title>Kulcsok adatainak módosítása</title>
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
				<a href="k_mod.php" class="navbar-brand">Kulcsok adatainak módosítása</a>				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<!-- <div class="collapse navbar-collapse" id="navbarCollapse">					
										
					<div class="container-fluid">
						<form action="k_mod.php" method="post">
								<table class="table-responsive">
									<tr>
										<td class="nav-item text-warning">Kulcsazonosító:</td>
										<td><input type="text" name="Keres_szoveg" /></td>
										<td align="center"><input name="Keres" type="submit" value="Keres" /></td>
									</tr>
								</table>							
						</form>
					</div> -->
					
					<div class="navbar-nav ms-auto">              	
						<a href="k.php" class="nav-item nav-link">Vissza</a>
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>

				<!-- </div>	-->

			</div>
		</nav>
                
                <div class="container-fluid table table-responsive">
		<div class="container-fluid">
			<form action="k_mod.php" method="post">
				<div class="row-responsible">
					<a>Kulcsazonosító:</a>
					<a><input type="text" name="Keres_szoveg" /></a>
					<a><input name="Keres" type="submit" value="Keres" /></a>
				</div>
			</form>
		</div>

		<div class="container-fluid table table-responsive">
		<?php
		
			$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
			if (isset($_POST['Keres_szoveg']))
			{	$_SESSION['k_mod_keres'] = $_POST['Keres_szoveg'];
					
				if($lekerdezes = $db->query ("
					SELECT * 
					FROM `kulcsok` 
					LEFT JOIN `telephely` ON `kulcsok`.`th_ID` = `telephely`.`th_ID`
					WHERE `k_ID` = '".$_POST['Keres_szoveg']."'
					"))
				{										
					if ($lekerdezes->num_rows)
					{																				
						echo '<table table-responsible border="1">';
							echo '<br>';
							echo '<thead>';
								echo ' <tr>';
												
									echo '<th>Kulcsazonosító</th>';
									echo '<th>Telephely neve</th>';
									echo '<th>Megnevezés</th>';
									echo '<th>Törölt</th>';
									echo '<th>Megjegyzés</th>';
																								
								echo ' </tr>';
							echo '</thead>';
										
							echo '<tbody>';
								foreach($lekerdezes as $sor)
									{
										echo '<tr>';
													
											echo '<td>'.$sor['k_ID'].'</td>';
											echo '<td>'.$sor['th_nev'].'</td>';
											echo '<td>'.$sor['k_leir'].'</td>';
											echo '<td>'.$sor['k_t'].'</td>';
											echo '<td>'.$sor['k_mj'].'</td>';
																																														
										echo '</tr>';
									}
							echo '</tbody>';
						echo '</table>';
			
	
		?>
						</div>

						<br>
						<div class="container-fluid">
							<form action="k_mod.php" method="post" class="row">
								<table class="table table-responsible" align="center" style="width: 35% !important";>
									<tr>
										<td>Kulcsazonosító:</td>
										<td><input type="text" name="k_ID" value= <?php echo $sor['k_ID']; ?> disabled /> *</td>
									</tr>
									<tr>
										<?php
											$lekerdezesth = $db->query("SELECT * FROM `telephely`")
										?>
										<td>Telephely neve:</td>
										<td>
											<select name="th_ID" size="1">
												<?php 
													foreach($lekerdezesth as $sorth)
													{
														?>
															<option	value=" <?php echo $sorth['th_ID']?> "
																				<?php
																					if($sor['th_ID'] == $sorth['th_ID'])
																					{
																						echo "selected";
																					}
																				?> 
																	>
																<?php 
																	echo $sorth['th_nev'] 
																?>
														</option>
												<?php 
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
									<td>Megnevezés:</td>
										<td><input type="text" name="k_leir" value= <?php echo '"'.$sor['k_leir'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Törölt:</td>
										<td><input type="text" name="k_t" value= <?php echo '"'.$sor['k_t'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Megjegyzés:</td>
										<td><input type="text" name="k_mj" value= <?php echo '"'.$sor['k_mj'].'"'; ?> /></td>
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
				}
		
			}

		
										
			$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
			if(isset($_POST['update']))
				{
					if($db->query("
					UPDATE `kulcsok` 
					SET  `th_ID`='".$_POST['th_ID']."', `k_leir`='".$_POST['k_leir']."', `k_t`='".$_POST['k_t']."', `k_mj`='".$_POST['k_mj']."'
					WHERE `k_ID` = '".$_SESSION['k_mod_keres']."'
					"))
					{
						if($db->affected_rows)
						{
							echo "A kulcs  adatainak módosítása megtörtént!";
						}
						else
						{
							echo "A kulcs adatai nem módosultak!";
						}	
					}
					else
					{
						echo "Az adatbázishoz történő kapcsolódás sikertelen. A módosítás nem ment végve!";
					}
				}
						
			$db->close();	
				
		?>
		</div>
				
	</body>

</html>