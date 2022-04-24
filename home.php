<?php
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
		<title>HÉV telephelyek</title>
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
				<a href="https://www.mav-hev.hu/hu/bemutatkozas" class="navbar-brand">MÁV-HÉV Zrt.</a>
				
				<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div></div>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="alk.php" class="nav-item nav-link">Alkalmazottak</a>
						<a href="jog.php" class="nav-item nav-link">Jogok</a>
						<a href="g.php" class="nav-item nav-link">Gépjárművek</a>
						<a href="k.php" class="nav-item nav-link">Kulcsok</a>
						<a href="th.php" class="nav-item nav-link">Telephelyek</a>
					</div>
					
                                        <div class="navbar-nav ms-auto">
                                                  <a Kapcsolat: href="mailto:info@monasoft.hu" style="color: #FFFAF0">Kapcsolat: info@monasoft.hu</a>
                                        </div>

					<div class="navbar-nav ms-auto">              	
						<a href="#" class="nav-item nav-link"><?php print 'Üdv, '.$_SESSION['username'].'!';?></a>
						<a href="logout.php" class="nav-item nav-link">Kilépés</a>
					</div>
				</div>
				
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-6 col-lg-8 text-center">
					<p>A MÁV-HÉV Zrt. – vállalati átalakulási folyamatot követően – hivatalosan 2017. február 23-tól lett a MÁV-csoport teljesjogú leányvállalata. A vállalat és jogelődjei <b>132 éve</b> szolgálják ki Budapest és agglomerációja utazóközönségét <b>öt viszonylaton</b> (H5 Szentendre, H6 Ráckeve, H7 Csepel, H8 Gödöllő, H9 Csömör) közel 100 kilométeres vonalhálózaton.</p>
					<p>Társaságunk célja az utasok számára <b>gyors, megbízható és biztonságos közlekedés biztosítása</b> gazdaságilag hatékony és energiatudatos vállalati működés mellett. A MÁV-HÉV Zrt. minőségfilozófiájának alapköve, hogy folyamatainkat folyamatosan javítjuk azért, hogy tevékenységünkkel utasaink igényeinek minél jobban megfelelhessünk. Ezen küldetés szellemében végeztünk menetrendi fejlesztést a H6-os és a H8/H9-es vonalakon, dolgozunk folyamatosan a HÉV-ek megújításán, mind a járműflotta, mind az infrastruktúra tekintetében, de említhetnénk a modern, XXI. századi állomási arculat kialakítására tett lépéseinket, vagy akár a vasúti folyamataink digitalizációját, az on-line térképes járműkövetés és a jegyvásárlás lehetőségét megteremtő informatikai fejlesztésünket is.</p>
					<p>Folyamatosan fejlődünk azért, hogy a HÉV valóban XXI. századi elővárosi gyorsvasút és továbbra is Európa egyik legpontosabb vasútvállalata legyen!</p>
					<hr>
					<footer class="blockquote-footer">Forrás: https://www.mav-hev.hu/hu/bemutatkozas</footer>
				</div>
				
				<div class="col-sm-9 col-md-6 col-lg-4">
					<br>
					<img class="img-thumbnail" src="hev2.jpg" alt="">	
				</div>
    	</div>
	
	</div>

</body>

</html>