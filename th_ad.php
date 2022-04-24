<?php
	ob_start();
	session_start();
	require_once 'connect.php';
	if(!isset($_SESSION['belepve']) or $_SESSION['belepve'] == false)
	{
		header("Location: index.php");
		exit();
	}

	$th_t_hiba=$th_nev_hiba=$th_irsz_hiba=$th_v_hiba=$th_cim_hiba=$th_gynev_hiba=$th_mj_hiba="";
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{	
		$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
		// ha a post megküldte a változót, ami nem üres, akkor létrejön a $alk_fnev változó és egyenlő lesz a kapott értékkel
		
		if (isset($_POST['th_nev']) && !empty($_POST['th_nev']))
		{
			$th_nev=$_POST['th_nev'];
		}
        else
		{
			$th_nev_hiba="Kötelező mező!";
		}
		if (isset($_POST['th_irsz']) && !empty($_POST['th_irsz']))
        {
			$th_irsz=$_POST['th_irsz'];
		}
        else
		{
			$th_irsz_hiba="Kötelező mező!";
		}
		if (isset($_POST['th_v']) && !empty($_POST['th_v']))
        {
			$th_v=$_POST['th_v'];
		}
        else
		{
			$th_v_hiba="Kötelező mező!";
		}
        if (isset($_POST['th_cim']) && !empty($_POST['th_cim']))
        {
			$th_cim=$_POST['th_cim'];
		}
        else
		{
			$th_cim_hiba="Kötelező mező!";
		}
        if (isset($_POST['th_gynev']) && !empty($_POST['th_gynev']))
        {
			$th_gynev=$_POST['th_gynev'];
		}
        else
		{
			$th_gynev_hiba="Kötelező mező!";
		}
		if (isset($_POST['th_mj']))
        {
			$th_mj=$_POST['th_mj'];
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
		<title>Telephely felvitele</title>
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

				<a href="th_ad.php" class="navbar-brand">Telephely felvitele</a>
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="navbar-nav ">  
					<a href="th.php" class="nav-item nav-link">Vissza</a>            	
					<a href="logout.php" class="nav-item nav-link">Kilépés</a>
				</div>

			</div>
		</nav>
					
		<div class="container-fluid table table-responsive">
					<form action="th_ad.php" method="post" class="row" style="width: 90%;">							
						
						<table class="table table-responsible" align="center" style="width: 45% !important">
							<br>
                            	<tr>
									<td>Telephely neve:</td>
									<td><input type="text" name="th_nev" /> * <?php echo $th_nev_hiba; ?> </td>
								</tr>
								<tr>
									<td>Irányítószám:</td>
									<td><input type="text" name="th_irsz" /> * <?php echo $th_irsz_hiba; ?> </td>
								</tr>
								</tr>
									<td>Város:</td>
									<td><input type="text" name="th_v" /> * <?php echo $th_v_hiba; ?> </td>
								</tr>
								<tr>
									<td>Cím:</td>
									<td><input type="text" name="th_cim" /> * <?php echo $th_cim_hiba; ?> </td>
								</tr>
                                <tr>
					    			<td>Gyűjtőnév:</td>
									<td><input type="text" name="th_gynev" /> * <?php echo $th_gynev_hiba; ?> </td>
								</tr>
                                <tr>
						    		<td>Megjegyzés:</td>
									<td><input type="text" name="th_mj" /></td>
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
						if(isset($th_nev) && isset($th_irsz) && isset($th_v) && isset($th_cim) && isset($th_gynev) && isset($th_mj))
						{
							
							
									
                            //sor hozzáadása az adatbázishoz
                            if($db->query("
                                
                            INSERT INTO `telephely`(`th_ID`, `th_t`, `th_nev`, `th_irsz`, `th_v`, `th_cim`, `th_gynev`, `th_mj`)
                            VALUES (NULL, '0', '".$th_nev."', '".$th_irsz."', '".$th_v."','".$th_cim."' ,'".$th_gynev."' ,'".$th_mj."')
                                
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
			
		</div>
		
	</body>
	
</html>