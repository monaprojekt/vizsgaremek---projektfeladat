<?php
	ob_start();
	session_start();
	require_once 'connect.php';
	if(!isset($_SESSION['belepve']) or $_SESSION['belepve'] == false)
	{
		header("Location: index.php");
		exit();
	}
	
	$alk_fnev_hiba=$alk_pw_hiba=$jog_ID_hiba=$jog_s_hiba=$alk_aj_hiba=$alk_nev_hiba=$alk_beoszt_hiba=$alk_jv_0_hiba=$alk_szhely_hiba=$alk_szido_hiba=$alk_mail_hiba=$alk_tel_hiba=$alk_vez_hiba=$alk_p_hiba=$alk_s_hiba="";
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{	
		$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
		// ha a post megküldte a változót, ami nem üres, akkor létrejön a $alk_fnev változó és egyenlő lesz a kapott értékkel
		if (isset($_POST['alk_fnev']) && !empty($_POST['alk_fnev']))
		{
			$alk_fnev=$_POST['alk_fnev'];
		}
		else
		{
			$alk_fnev_hiba="Kötelező mező!";
		}
		if (isset($_POST['alk_pw1']) && isset($_POST['alk_pw2']) && strlen($_POST['alk_pw1'])>6 && $_POST['alk_pw1'] == $_POST['alk_pw2'])
		{
			$alk_pw=$_POST['alk_pw1'];
		}
		else
		{
			$alk_pw_hiba="Jelszóhiba!";		
		}
		if (isset($_POST['jog_ID']) && !empty($_POST['jog_ID']))
		{
			$jog_ID=$_POST['jog_ID'];
		}
		else
		{
				
		}
		if (isset($_POST['jog_s']) && $_POST['jog_s']<>"" )
		{
			$jog_s=$_POST['jog_s'];
		}
		else
		{
			$jog_s_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_aj']) && !empty($_POST['alk_aj']))
		{
			$alk_aj=$_POST['alk_aj'];
		}
		else
		{
			$alk_aj_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_nev0']))
		{
			$alk_nev0=$_POST['alk_nev0'];
		}
		else
		{
				
		}
		if (isset($_POST['alk_nev']) && !empty($_POST['alk_nev']))
		{
			$alk_nev=$_POST['alk_nev'];
		}
		else
		{
			$alk_nev_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_jv_0']) && !empty($_POST['alk_jv_0']))
		{
			$alk_jv_0=$_POST['alk_jv_0'];
		}
		else
		{
			$alk_jv_0_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_jv_1']))
		{
			$alk_jv_1=$_POST['alk_jv_1'];
		}
		else
		{
				
		}
		if (isset($_POST['alk_szhely']) && !empty($_POST['alk_szhely']))
		{
			$alk_szhely=$_POST['alk_szhely'];
		}
		else
		{
			$alk_szhely_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_szido']) && !empty($_POST['alk_szido']))
		{
			$alk_szido=$_POST['alk_szido'];
		}
		else
		{
			$alk_szido_hiba="Kötelező mező!";			
		}	
		if (isset($_POST['alk_mail']) && !empty($_POST['alk_mail']))
		{
			$alk_mail=$_POST['alk_mail'];
		}
		else
		{
			$alk_mail_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_tel']) && !empty($_POST['alk_tel']))
		{
			$alk_tel=$_POST['alk_tel'];
		}
		else
		{				
			$alk_tel_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_beoszt']) && !empty($_POST['alk_beoszt']))
		{
			$alk_beoszt=$_POST['alk_beoszt'];
		}
		else
		{
			$alk_beoszt_hiba="Kötelező mező!";	
		}
		if (isset($_POST['alk_vez']) && $_POST['alk_vez']<>"")
		{
			$alk_vez=$_POST['alk_vez'];
		}
		else
		{
			$alk_vez_hiba="Kötelező mező!";			
		}
		if (isset($_POST['alk_p']) && $_POST['alk_p']<>"")
		{
			$alk_p=$_POST['alk_p'];
		}
		else
		{
			$alk_p_hiba="Kötelező mező!";				
		}
		if (isset($_POST['alk_s']) && !empty($_POST['alk_s']))
		{
			$alk_s=$_POST['alk_s'];
		}
		else
		{
			$alk_s_hiba="Kötelező mező!";		
		}
		if (isset($_POST['alk_mj']))
		{
			$alk_mj=$_POST['alk_mj'];
		}
		else
		{
					
		}
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
		<title>Új alkalmazott</title>
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
				<a href="alk_ad.php" class="navbar-brand">Új alkalmazott</a>				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">					
					
					<div class="navbar-nav ms-auto">      
						<a href="alk.php" class="nav-item nav-link">Vissza</a>        	
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>

				</div>	

			</div>
		</nav>

		<div class="container-fluid table table-responsive">
			<form action="alk_ad.php" method="post" class="row">
			<br>
			<table class="table table-responsible" align="center" style="width: 45% !important">
					<hr>
					<tr>
						<td>Felhasználónév:</td>
						<td><input type="text" name="alk_fnev" /> * <?php echo $alk_fnev_hiba; ?></td>
					</tr>
					<tr>
						<td>Jelszó:</td>
						<td><input type="password" name="alk_pw1" /> * Minimum 7 karakter<?php echo $alk_pw_hiba; ?></td>
					</tr>
					<tr>
						<td>Jelszó:</td>
						<td><input type="password" name="alk_pw2" /> * Minimum 7 karakter<?php echo $alk_pw_hiba; ?></td>
					</tr>
					<tr>
						<?php
						$lekerdezesjog = $db->query("SELECT * FROM `jogok`")
						?>
						<td>Jog:</td>
						<td>
							<select name="jog_ID" size="1">
								<?php foreach($lekerdezesjog as $sorjog){?>
								<option value="<?php echo $sorjog['jog_ID'] ?>"><?php echo $sorjog['jog_nev'] ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jog státusz:</td>
						<td>
							<select name="jog_s" size="1">
								<option value="1">Aktív</option>
								<option value="0">Nem aktív</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Adóazonosító jel:</td>
						<td><input type="text" name="alk_aj" /> * <?php echo $alk_aj_hiba; ?></td>
					</tr>
					<tr>
						<td>Név előjel:</td>
						<td><input type="text" name="alk_nev0" /></td>
					</tr>
					<tr>
						<td>Név:</td>
						<td><input type="text" name="alk_nev" />  * <?php echo $alk_nev_hiba; ?></td>
					</tr>
					<tr>
						<td>Jogviszony kezdete:</td>
						<td><input type="date" name="alk_jv_0" /> * <?php echo $alk_jv_0_hiba; ?></td>
					</tr>
					<tr>
						<td>Jogviszony vége:</td>
						<td><input type="date" name="alk_jv_1" /></td>
					</tr>
					<tr>
						<td>Születés helye:</td>
						<td><input type="text" name="alk_szhely" />  * <?php echo $alk_szhely_hiba; ?></td>
					</tr>
					<tr>
						<td>Születési idő:</td>
						<td><input type="date" name="alk_szido" />  * <?php echo $alk_szido_hiba; ?></td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td><input type="email" name="alk_mail" /> * <?php echo $alk_mail_hiba; ?></td>
					</tr>
					<tr>
						<td>Telefonszám:</td>
						<td><input type="text" name="alk_tel" /> * <?php echo $alk_tel_hiba; ?></td>
					</tr>
					<tr>
						<td>Beosztás:</td>
						<td><input type="text" name="alk_beoszt" /> * <?php echo $alk_beoszt_hiba; ?></td>
					</tr>
					<tr>
						<td>Vezető:</td>
						<td><input type="radio" name="alk_vez" value="1" /> Igen <input type="radio" name="alk_vez" value="0" /> Nem * <?php echo $alk_vez_hiba; ?></td>
					</tr>
					<tr>
						<td>Portás:</td>
						<td><input type="radio" name="alk_p" value="1" /> Igen <input type="radio" name="alk_p" value="0" /> Nem * <?php echo $alk_p_hiba; ?></td>
					</tr>
					<tr>
						<td>Státusz:</td>
						<td><input type="text" name="alk_s" /> * <?php echo $alk_s_hiba; ?></td>
					</tr>
					<tr>
						<td>Megjegyzés:</td>
						<td><input type="text" name="alk_mj" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input name="hozzaad" type="submit" value="Mentés" /></td>
					</tr>
				</table> 

			</form>
		</div>	

		<div class="container-fluid table table-responsible">
		<?php	
		
			if(isset($_POST['hozzaad']))
			{	
				//annak ellenőrzése, hogy az összes változó létrejött-e
				//if(isset($alk_fnev) && isset($alk_pw) && isset($jog_nev) && isset($jog_s) && isset($alk_aj) && isset($alk_nev0) && isset($alk_nev) && isset($alk_jv_0) && isset($alk_jv_1) && isset($alk_szhely) && isset($alk_szido) && isset($alk_mail) && isset($alk_tel) && isset($alk_beoszt) &&  isset($alk_vez) && isset($alk_p) && isset($alk_regido) && isset($alk_s) && isset($alk_mj))
				
				if(isset($alk_fnev) && isset($alk_pw) && isset($jog_ID) && isset($jog_s) && isset($alk_aj) && isset($alk_nev0) && isset($alk_nev) && isset($alk_jv_0) && isset($alk_jv_1) && isset($alk_szhely) && isset($alk_szido) && isset($alk_mail) && isset($alk_tel) && isset($alk_beoszt) &&  isset($alk_vez) && isset($alk_p) && isset($alk_s) && isset($alk_mj))
				{
					
					//lekérdezés: a most felvitt új alkalmazott szerepel-e az adatbázisban
					if($lekerdezes = $db->query ("SELECT * FROM `alkalmazott` WHERE `alk_fnev` = '".$alk_fnev."'"))
					{
										
						//ha nem szerepel, akkor...
						if (!$lekerdezes->num_rows)
						{
											
							//jelszó titkosítása
							$alk_pw = md5($alk_pw);
											
											
							//sor hozzáadása az adatbázishoz + az időhöz aktuális idő rendelése
							if($db->query("
										
								INSERT INTO `alkalmazott` (`alk_ID`, `alk_fnev`, `alk_pw`, `jog_ID`, `jog_s`, `alk_aj`, `alk_nev0`, `alk_nev`, `alk_jv_0`, `alk_jv_1`, `alk_szhely`, `alk_szido`, `alk_mail`, `alk_tel`, `alk_beoszt`, `alk_vez`, `alk_p`, `alk_regido`, `alk_s`, `alk_ki`, `alk_mj`)
								VALUES (NULL, '".$alk_fnev."', '".$alk_pw."', '".$jog_ID."', '".$jog_s."', '".$alk_aj."', '".$alk_nev0."', '".$alk_nev."', '".$alk_jv_0."', '".$alk_jv_1."', '".$alk_szhely."', '".$alk_szido."', '".$alk_mail."', '".$alk_tel."', '".$alk_beoszt."', '".$alk_vez."', '".$alk_p."', current_timestamp(), '".$alk_s."', '0', '".$alk_mj."');
												
								"))
							{
								//kiírása annak, hogy hány sort adott hozzá az adatbázishoz
								//echo $db->affected_rows."<br />";
								echo "Sikeres felvitel. ".$db->affected_rows." alkalmazott hozzáadásra került az adatbázishoz.";
							}
							//felszabadítja a lekerdezes változót, kiüríti a memóriából
							$lekerdezes->free();

						}
                                                else
						{
							echo ('Az adatbázisban már van ilyen alkalmazott!');
						}
					}
					
				}
                                else
				{
					//hibaüzenet
					echo ('Hibás kitöltés!');
				}	
				
			}					
			
			$db->close();
					
		?>
		</div>
			
	</body>
</html>