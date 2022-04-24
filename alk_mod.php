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
		<title>Alkalmazottak módosítása</title>
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
				<a href="alk_mod.php" class="navbar-brand">Alkalmazottak módosítása</a>				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<!-- <div class="collapse navbar-collapse" id="navbarCollapse">					
					<div class="container-fluid">
						<form action="alk_mod.php" method="post">
							<div class="row-responsible">
									<div class="col-6 col-sm-6  col-lg-4" class="nav-item">Felhasznalónév:</div>
									<div class="col-6 col-sm-6  col-lg-4" class="nav-item"><input type="text" name="Keres_szoveg" /></div>
									<div class="col-12 col-sm-12  col-lg-4" class="nav-item"><input name="Keres" type="submit" value="Keres" /></div>
							</div>
							<table class="table-responsive">
								<tr>
									<td class="nav-item text-warning">Felhasznalónév:</td>
									<td><input type="text" name="Keres_szoveg" /></td>
									<td align="center"><input name="Keres" type="submit" value="Keres" /></td>
								</tr>
							</table>							
						</form>
				</div>	  -->
								
				<div class="navbar-nav ms-auto">   
					<a href="alk.php" class="nav-item nav-link">Vissza</a>           	
					<a href="logout.php" class="nav-item nav-link">Kilépés</a>
				</div>

				<!-- </div>	 -->

			</div>
		</nav>

		<div class="container-fluid table table-responsive">
		<div class="container-fluid">
			<form action="alk_mod.php" method="post">
				<div class="row-responsible">
					<a>Felhasznalónév:</a>
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
				$_SESSION['alk_mod_keres'] = $_POST['Keres_szoveg'];
				if($lekerdezes = $db->query ("
					SELECT * 
					FROM `alkalmazott` 
					LEFT JOIN `jogok` ON `alkalmazott`.`jog_ID` = `jogok`.`jog_ID`
					WHERE `alk_fnev` = '".$_POST['Keres_szoveg']."'"))
				{
										
					if ($lekerdezes->num_rows)
					{																				
						echo '<table table-responsible >';
							echo '<br>';
							echo '<thead>';
								echo ' <tr>';
												
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
										
							echo '<tbody>';

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
                                      


							echo '</tbody>';

						echo '</table>';
						echo '<br>';
		?>
		</div>
		<br>
		
		<div class="table table-responsive">
							<form action="alk_mod.php" method="post" class="row-flex">
								<table class="table table-responsible" align="center" style="width: 35% !important";>
									<tr>
										<td>Felhasználónév:</td>
										<td><input type="text" name="alk_fnev" value= <?php echo '"'.$sor['alk_fnev'].'"'; ?> disabled /> *</td>
									</tr>
									<tr>
										<td>Új jelszó:</td>
										<td><input type="password" name="alk_pw1" /> * Minimum 7 karakter</td>
									</tr>
									<tr>
										<td>Új jelszó ismét:</td>
										<td><input type="password" name="alk_pw2" /> * Minimum 7 karakter</td>
									</tr>
									<tr>
										<?php
											$lekerdezesjog = $db->query("SELECT * FROM `jogok`")
										?>
										<td>Jog:</td>
										<td>
											<select name="jog_ID" size="1"> *
												<?php 
													foreach($lekerdezesjog as $sorjog)
													{
														?>
															<option	value=" <?php echo $sorjog['jog_ID']; ?> "
																				<?php
																					if($sor['jog_ID'] == $sorjog['jog_ID'])
																					{
																						echo "selected";
																					}
																				?>
																			>
																<?php
																	echo $sorjog['jog_nev'] 
																?>
															</option>
									        	<?php
													}
												 ?>
											</select> *
										</td>
									</tr>
									<tr>
										<td>Jog státusz:</td>
										<td>
											<select name="jog_s" size="1">
												<option 
													value="0"
													<?php
														if($sor['jog_s'] == "0" )
														{
															echo " selected";
														}
													?>
													>Nem aktív
												</option>
												<option 
													value="1"
													<?php
														if($sor['jog_s'] == "1" )
														{
															echo " selected";
														}
													?>
													>Aktív
												</option>
											</select> *
										</td>
									</tr>
									<tr>
										<td>Adóazonosító jel:</td>
										<td><input type="text" name="alk_aj" value= <?php echo '"'.$sor['alk_aj'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Név előjel:</td>
										<td><input type="text" name="alk_nev0" value= <?php echo '"'.$sor['alk_nev0'].'"'; ?> /></td>
									</tr>
									<tr>
										<td>Név:</td>
										<td><input type="text" name="alk_nev" value= <?php echo '"'.$sor['alk_nev'].'"'; ?> />  *</td>
									</tr>
									<tr>
										<td>Jogviszony kezdete:</td>
										<td><input type="date" name="alk_jv_0" value= <?php echo '"'.$sor['alk_jv_0'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Jogviszony vége:</td>
										<td><input type="date" name="alk_jv_1" value= <?php echo '"'.$sor['alk_jv_1'].'"'; ?> /></td>
									</tr>
									<tr>
										<td>Születés helye:</td>
										<td><input type="text" name="alk_szhely" value= <?php echo '"'.$sor['alk_szhely'].'"'; ?> />  *</td>
									</tr>
									<tr>
										<td>Születési idő:</td>
										<td><input type="date" name="alk_szido" value= <?php echo '"'.$sor['alk_szido'].'"'; ?> />  *</td>
									</tr>
									<tr>
										<td>E-mail:</td>
										<td><input type="email" name="alk_mail" value= <?php echo '"'.$sor['alk_mail'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Telefonszám:</td>
										<td><input type="text" name="alk_tel" value= <?php echo '"'.$sor['alk_tel'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Beosztás:</td>
										<td><input type="text" name="alk_beoszt" value= <?php echo '"'.$sor['alk_beoszt'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Vezető:</td>
										<td>
											<input type="radio" name="alk_vez" value="1" <?php  if($sor['alk_vez']){echo "checked";} ?> /> Igen 
											<input type="radio" name="alk_vez" value="0" <?php  if(!$sor['alk_vez']){echo "checked";} ?> /> Nem *
										</td>
									</tr>
									<tr>
										<td>Portás:</td>
										<td>
											<input type="radio" name="alk_p" value="1" <?php  if($sor['alk_p']){echo "checked";} ?> /> Igen 
											<input type="radio" name="alk_p" value="0" <?php  if(!$sor['alk_p']){echo "checked";} ?> /> Nem *
										</td>
									</tr>
									<tr>
										<td>Státusz:</td>
										<td><input type="text" name="alk_s" value= <?php echo '"'.$sor['alk_s'].'"'; ?> /> *</td>
									</tr>
									<tr>
										<td>Megjegyzés:</td>
										<td><input type="text" name="alk_mj" value= <?php echo '"'.$sor['alk_mj'].'"'; ?> /></td>
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
					if(!empty($_POST['jog_ID']) && !empty($_POST['alk_aj']) && !empty($_POST['alk_nev']) && !empty($_POST['alk_jv_0']) && !empty($_POST['alk_szhely']) && !empty($_POST['alk_szido']) && !empty($_POST['alk_mail']) && !empty($_POST['alk_tel']) && !empty($_POST['alk_beoszt']) && $_POST['alk_vez']<>"" && $_POST['alk_p']<>"" && !empty($_POST['alk_s']))
					{	
					
						if(strlen($_POST['alk_pw1'])>6 && $_POST['alk_pw1'] == $_POST['alk_pw2'])
						{
							$pwstr = "`alk_pw`="."'".md5($_POST['alk_pw1'])."',";
						}
						else
						{
							$pwstr = "";
						}
						
						if($db->query("
						UPDATE `alkalmazott` 
						SET $pwstr `jog_ID`='".$_POST['jog_ID']."', `jog_s`='".$_POST['jog_s']."', `alk_aj`='".$_POST['alk_aj']."', `alk_nev0`='".$_POST['alk_nev0']."', `alk_nev`='".$_POST['alk_nev']."', `alk_jv_0`='".$_POST['alk_jv_0']."', `alk_jv_1`='".$_POST['alk_jv_1']."', `alk_szhely`='".$_POST['alk_szhely']."', `alk_szido`='".$_POST['alk_szido']."', `alk_mail`='".$_POST['alk_mail']."', `alk_tel`='".$_POST['alk_tel']."', `alk_beoszt`='".$_POST['alk_beoszt']."', `alk_vez`='".$_POST['alk_vez']."', `alk_p`='".$_POST['alk_p']."', `alk_s`='".$_POST['alk_s']."', `alk_mj`='".$_POST['alk_mj']."' 
						WHERE `alk_fnev` = '".$_SESSION['alk_mod_keres']."'
						"))
						{
							if($db->affected_rows)
							{
								echo "Az alkalmazott adatainak módosítása megtörtént!";
							}
							else
							{
								echo "Az alkalmazott adatai nem módosultak!";
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