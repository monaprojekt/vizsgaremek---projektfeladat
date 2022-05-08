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
		<title>Kulcsok</title>
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
				<a href="k.php" class="navbar-brand">Kulcsok</a>
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="k_list.php" class="nav-item nav-link">Listázás</a>
						<a href="k_mod.php" class="nav-item nav-link">Módosítás</a>
                		<a href="k_ad.php" class="nav-item nav-link">Felvitel</a>
						<a href="k_tor.php" class="nav-item nav-link">Törlés</a>
						<a href="k_arch.php" class="nav-item nav-link">Archiválás</a>
					</div>
					
					<div class="navbar-nav ms-auto">              	
						<a href="home.php "class="nav-item nav-link">Vissza</a>
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>
				</div>
			</div>
		</nav>
			
		<div class="container-fluid">

			<div class="row align-items-center">
				<div class="col-sm-3 col-md-6 col-lg-8 text-center">
					<p>Öt járműtelepen (Szentendre, Cinkota, Csepel, Dunaharaszti, Ráckeve) látunk el járműfenntartási tevékenységet (karbantartás, javítás, felújítás), a műhelyi beavatkozásokat Szentendrén, Cinkotán és Dunaharasztiban végezzük. A menetrendszerűségünk 99% feletti, a járműkiadás a koros járműpark ellenére közel 100%-os.</p>
					<hr>
					<footer class="blockquote-footer">Forrás: https://www.mav-hev.hu/hu/bemutatkozas</footer>
				</div>
				
				<div class="col-sm-9 col-md-6 col-lg-4">
					<br>
					<img class="img-thumbnail" src="kulcs2.jpg" alt="">	
				</div>
    	</div>
	</body>

</html>

