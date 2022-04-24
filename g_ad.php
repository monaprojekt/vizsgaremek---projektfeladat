<?php
	ob_start();
	session_start();
	require_once 'connect.php';
	if(!isset($_SESSION['belepve']) or $_SESSION['belepve'] == false)
	{
		header("Location: index.php");
		exit();
	}

	$g_rsz_hiba=$g_feng_hiba=$g_tip_hiba=$g_s_hiba=$g_t_hiba="";
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{	
		$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
		// ha a post megküldte a változót, ami nem üres, akkor létrejön a $alk_fnev változó és egyenlő lesz a kapott értékkel
		if (isset($_POST['g_rsz']) && !empty($_POST['g_rsz']))
		{
			$g_rsz=$_POST['g_rsz'];
		}
                else
		{
			$g_rsz_hiba="Kötelező mező!";
		}
		if (isset($_POST['g_feng']) && !empty($_POST['g_feng']))
		{
			$g_feng=$_POST['g_feng'];
		}
                else
		{
			$g_feng_hiba="Kötelező mező!";
		}
		if (isset($_POST['g_tip']) && !empty($_POST['g_tip'])){
			$g_tip=$_POST['g_tip'];
		}
                else
		{
			$g_tip_hiba="Kötelező mező!";
		}
		if (isset($_POST['g_s']))
                {
			$g_s=$_POST['g_s'];
		}
                else
		{						
			
		}
		if (isset($_POST['g_mj'])){
			$g_mj=$_POST['g_mj'];
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
		<title>Gépjármű felvitele</title>
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

				<a href="g_ad.php" class="navbar-brand">Gépjármű felvitele</a>
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="navbar-nav ">  
					<a href="g.php" class="nav-item nav-link">Vissza</a>            	
					<a href="logout.php" class="nav-item nav-link">Kilépés</a>
				</div>

			</div>
		</nav>
					
		<div class="container-fluid table table-responsive">
					<form action="g_ad.php" method="post" class="row" style="width: 90%;">							
						
						<table class="table table-responsible" align="center" style="width: 45% !important">
							<br>
							<tr>
								<td>Rendszám</td>
								<td><input type="text" name="g_rsz" /> * <?php echo $g_rsz_hiba; ?></td>
							</tr>
							<tr>
								<td>Forgalmi engedély:</td>
								<td><input type="text" name="g_feng" /> * <?php echo $g_feng_hiba; ?></td>
							</tr>
							<tr>
								<td>Típus:</td>
								<td><input type="text" name="g_tip" /> * <?php echo $g_tip_hiba; ?></td>
							</tr>
							<tr>
								<td>Státusz:</td>
								<td><input type="text" name="g_s" /></td>
							</tr>
							<tr>
								<td>Megjegyzés:</td>
								<td><input type="text" name="g_mj" /></td>
							</tr>
							<hr>
							<tr>
								<td colspan="2" align="center"><input name="hozzaad" type="submit" value="Mentés" /></td>
							</tr>
						</table>

					</form>
				</div>		
	
				<?php	
				
					$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
					// ha a post megküldte a változót, ami nem üres, akkor létrejön a $alk_fnev változó és egyenlő lesz a kapott értékkel

					if(isset($_POST['hozzaad']))
					{	
						//annak ellenőrzése, hogy az összes változó létrejött-e
						if(isset($g_rsz) && isset($g_feng) && isset($g_tip) && isset($g_s) && isset($g_mj))
						{
							
							//lekérdezés: a most felvitt új alkalmazott szerepel-e az adatbázisban
							if($lekerdezes = $db->query ("SELECT * FROM `gjarmu` WHERE `g_rsz` = '".$g_rsz."'"))
							{
									
								//ha nem szerepel, akkor...
								if (!$lekerdezes->num_rows)
								{
									
									//sor hozzáadása az adatbázishoz
									if($db->query("
										
										INSERT INTO `gjarmu` (`g_ID`, `g_rsz`, `g_feng`, `g_tip`, `g_s`, `g_t`, `g_mj`)
										VALUES (NULL, '".$g_rsz."', '".$g_feng."', '".$g_tip."', '".$g_s."', 0,'".$g_mj."')
										
									"))
									{
										//kiírása annak, hogy hány sort adott hozzá az adatbázishoz
										echo ("Sikeres felvitel. ".$db->affected_rows." sor hozzáadásra került az adatbázishoz.");
									}
									
								}
								else
								{
									echo ('Az adatbázisban már van ilyen gépjármű!');
							
									//felszabadítja a lekerdezes változót, kiüríti a memóriából
									$lekerdezes->free();
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
			
		</div>
		
	</body>
	
</html>