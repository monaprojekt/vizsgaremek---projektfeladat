<?php
	ob_start();
	session_start();
	require_once 'connect.php';
	
	
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
		<title>Belépés</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="stilus.css">
                <link rel="icon" type="image/x-icon" href="favicon.png">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	</head>
		
	<body>
	<!-- a login.php kapja meg a post metódus adatait, azért nem get, mert ott látszódna a címsorban a jelszó 				<form class="form-inline" action="/program/login.php" method="post">-->

	<!--<div class="container-fluid row-fluid col-sm-3 col-md-6 col-lg-8 offset-md-2"> -->
	<div class="container-fluid col-sm-6 col-md-6 col-lg-6 align-content-center">
			<h2 class="text-center text-dark mt-5">MÁV-HÉV Zrt.</h2>
        	<div class="text-center mb-5 text-dark">HÉV telephelyek</div>
       		<div class="card my-5">
		       <!-- a login.php kapja meg a post metódus adatait, azért nem get, mert ott látszódna a címsorban a jelszó -->			
			   <!---<form class="card-body cardbody-color p-lg-5" action="login.php" method="post"> -->
			   <!---<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">-->
			   <!---A htmlspecialchars() függvény a speciális karaktereket HTML entitásokká alakítja.-->
			   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

			   		<div class="text-center 0">
        				<img src="hev.jpg" class="img-fluid profile-image-pic img-thumbnail">
            		</div>

					<div class="mb-2">
						<input type="text" class="form-control" name="username" placeholder="username">
            		</div>
          
					<div class="mb-2">
              			<input type="password" class="form-control" name="password" placeholder="password">
            		</div>
					
			<div class="mb-2 text-center">
              			<input type="submit" value="Belépés">
            		</div>

                        <div class="mb-2 text-center">
                                 <label for="email">Új jelszó igénylése:</label>
                                 <a href="mailto:uj_jelszo@monasoft.hu">uj_jelszo@monasoft.hu</a>
                        </div>
						<div class="mb-2 text-center">
						<?php echo 'PHP version: ' . phpversion(); ?>
						</div>

        		</form>				
    		</div>
   	</div>

	<?php	
		//jött-e username változó a post-on, és nem üres
		//if(isset($_POST['username']) && !empty($_POST['username']))
		$username=$password="";

		$_POST = str_replace("<" , "&lt;" , $_POST ) ;   // seciális karakter védelem "<?"-re
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{ 
				$username=$_POST['username']; 
				$password=$_POST['password'];
				
													
				if(isset($username) && isset($password))
					{
						//lekérdezés: megnézzük az adatbázisban, hogy szerepel-e ilyen felhasználónév és jelszó
						if($lekerdezes = $db->query ("SELECT * FROM `alkalmazott` WHERE `alk_fnev` = '".$username."' AND `alk_pw` = '".md5($password)."'"))
						{ 
							//ha szerepel az adatbázisban akkor itt 1 lesz, mert az adatbázisban 1 sort tud kiválasztani, ellenkező esetben itt 0 lesz
							if ($lekerdezes->num_rows) 
							{
								$adatok=$lekerdezes->fetch_all(MYSQLI_BOTH);
								if ($adatok[0]['jog_ID']==1)
								{
									
									//echo '<pre>';
									//print_r($adatok);
									// azért 0 mindenhol itt, mert 1 sor adatait veszi ki a kétdimenziós tömbből
									$_SESSION['belepve']=true; 
									$_SESSION['id']=$adatok[0]['alk_ID'];   
									$_SESSION['username']=$adatok[0]['alk_fnev'];
									$_SESSION['password']=$adatok[0]['alk_pw'];
									$_SESSION['belep_ido']=date("Y-m-d H:i:s");
									//echo "<script type='text/javascript'>window.location.href = 'home.php';</script>"
									header('location: home.php');
									exit();
									
								}
								else
								{
									echo ('Nincs jogosultsága belépni!');
									
								}
							}
							else
							{  
								// nincs egyezés az adatbázissal
								echo ('Hibás felhasználónév vagy jelszó!');
							}
							$lekerdezes->free();
						}
								
					}
	
		}
		
		//ob_flush();
	?>
	
	</body>
	
</html>


