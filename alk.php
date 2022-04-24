<?php
	ob_start();
	session_start();
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
		<title>Alkalmazottak</title>
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
				<a href="alk.php" class="navbar-brand">Alkalmazottak</a>
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">					
					<div class="navbar-nav">
						<a href="alk_list.php" class="nav-item nav-link">Listázás</a>
						<a href="alk_mod.php" class="nav-item nav-link">Módosítás</a>
						<a href="alk_ad.php" class="nav-item nav-link">Új alkalmazott</a>
						<a href="alk_tor.php" class="nav-item nav-link">Kiléptetés</a>
						<a href="alk_arch.php" class="nav-item nav-link">Archiválás</a>
					</div>
					<div class="navbar-nav ms-auto">
						<a href="home.php" class="nav-item nav-link">Vissza</a>            	
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>
				</div>
				
			</div>
		</nav>

		<div class="container g-0">
              		<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3"></div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                        <br>
					<img class="img-thumbnail" src="hev4.jpg" alt="">
				</div>
                                <div class="col-sm-3 col-md-3 col-lg-12"></div>
				<div class="col-12 col-sm-12 col-lg-12 text-center">
					<br>
					<p>A jellegzetes zöld vonatok kiemelkedő pontossággal, évente 70-80 millió utast szállítanak kora hajnaltól késő estig. A fővárosban és annak környékén több telephelyen, megközelítőleg <a href="https://fb.watch/cpcqtnpkvE/"><b>1200 kollégánk</b></a> azért dolgozik, hogy utasaink időben és biztonságban érjenek úti céljukhoz.</p>
					<hr>
					<footer class="blockquote-footer">Forrás: https://www.mav-hev.hu/hu/bemutatkozas</footer>
				</div>
			</div>
			
    	</div>

  	</body>

</html>