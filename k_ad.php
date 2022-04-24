<?php
	ob_start();
	session_start();
	require_once 'connect.php';
	if(!isset($_SESSION['belepve']) or $_SESSION['belepve'] == false)
	{
		header("Location: index.php");
		exit();
	}

	$k_leir_hiba=$k_t_hiba=$k_mj_hiba="";
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{	
		$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
		// ha a post megküldte a változót, ami nem üres, akkor létrejön a $alk_fnev változó és egyenlő lesz a kapott értékkel
		
		if (isset($_POST['th_ID']) && !empty($_POST['th_ID']))
		{
			$th_ID=$_POST['th_ID'];
		}
		else
		{
		
		}

		if (isset($_POST['k_leir']) && !empty($_POST['k_leir']))
		{
			$k_leir=$_POST['k_leir'];
		}
		else
		{
			$k_leir_hiba="Kötelező mező!";
		}
		
		if (isset($_POST['k_t']) && ($_POST['k_t']<>""))
		{
			$k_t=$_POST['k_t'];
		}
		else
		{
			$k_t_hiba="Kötelező mező!";
		}
		
		if (isset($_POST['k_mj']))
		{
			$k_mj=$_POST['k_mj'];
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
		<title>Kulcsok felvitele</title>
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

				<a href="k_ad.php" class="navbar-brand">Kulcsok felvitele</a>
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="navbar-nav ">  
					<a href="k.php" class="nav-item nav-link">Vissza</a>            	
					<a href="logout.php" class="nav-item nav-link">Kilépés</a>
				</div>

			</div>
		</nav>
					
		<div class="container-fluid table table-responsive">
				<form action="k_ad.php" method="post" class="row">						
					<table class="table table-responsible" align="center" style="width: 45% !important">
						<br>
						<tr>
						<?php
						$lekerdezesth = $db->query("SELECT * FROM `telephely`")
						?>
							<td>Telephely neve:</td>
							<td>
							<select name="th_ID" size="1">
							<?php foreach($lekerdezesth as $sorth){?>
							<option value="<?php echo $sorth['th_ID'] ?>"><?php echo $sorth['th_nev'] ?></option>
							<?php } ?>
							</select>	
							</td>							
							
						</tr>
						<tr>
							<td>Megnevezés:</td>
							<td><input type="text" name="k_leir" /> * <?php echo $k_leir_hiba; ?> </td>
						</tr>
						<tr>
							<td>Megjegyzés:</td>
							<td><input type="text" name="k_mj" /></td>
						</tr>
						<hr>
						<tr>
							<td colspan="2" align="center"><input name="hozzaad" type="submit" value="Mentés" /></td>
						</tr>
					</table>
				</form>
		</div>		
				
		<div class="container-fluid table table-responsible">
			<?php	
				$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
				// ha a post megküldte a változót, ami nem üres, akkor létrejön a $alk_fnev változó és egyenlő lesz a kapott értékkel

				if(isset($_POST['hozzaad']))
				{	
					//annak ellenőrzése, hogy az összes változó létrejött-e
					if(isset($th_ID) && isset($k_leir)  && isset($k_mj))
					{							
						//sor hozzáadása az adatbázishoz
						if($db->query("
							
							INSERT INTO `kulcsok` (`k_ID`, `th_ID`, `k_leir`, `k_t`, `k_mj`)
							VALUES (NULL, '".$th_ID."', '".$k_leir."', '0', '".$k_mj."')
							
						"))
						{
							//kiírása annak, hogy hány sort adott hozzá az adatbázishoz
							echo ("Sikeres felvitel. ".$db->affected_rows." sor hozzáadásra került az adatbázishoz.");
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