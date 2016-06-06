<?php
	
	session_start();
	$postoji = isset($_SESSION['valid']) ? true : false;
	$admin = isset($_SESSION['admin']) ? true : false;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Naslovnica</title>
  <link rel="stylesheet" type="text/css" href="Stil.css">
  <script type="text/javascript" src="skripta.js"></script>
</head>
<body>
<div id="okvir">
	<div id="zaglavlje">
		<div class="wrap">
  			<div class="logoWrap"></div>
		</div>
		<h1>Turistička agencija</h1>
		<div id="meni">
			<ul>
				<li><a href="index.php">Naslovnica</a> |</li>
				<li><a href="Nagradna.php">Nagradna igra</a> |</li>
				<li><a href="Linkovi.php">Linkovi</a> |</li>
				<li><a href="Kontakt.php">Kontakt</a> |</li>
				<?php if($postoji){
				echo "<li><a href='Login.php'>Uredi profil</a> |</li>" .
					 "<li><a href='index.php?autor=".$_SESSION['id'] ."'>Moje novosti <div id='notifikacija'></div></a> |</li>".
					 "<li><a href='unesiNovost.php'>Unesi novost</a> |</li>";
				if($admin)
					echo "<li><a href='admin.php'>Admin</a> |</li>";
				echo "<li><a href='index.php' onclick='odjaviSe()'>Odjavi se</a> </li>";
				}
				else echo "<li><a href='Login.php'>Login</a> </li>";
				?>	
			</ul>
		</div>
	</div>
	<br>
	<br>
	<div id="sadrzaj">

<?php
	
	$dsn = 'mysql:dbname=wtbaza;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try{
        $konekcija = new PDO($dsn, $user, $password);
     } catch (PDOException $e) {
          echo 'Konekcija nije uspjela: ' . $e->getMessage();
        }

    $konekcija->exec("set names utf8");

    if(isset($_GET['autor'])){
    	$autor = $_GET['autor'];
    	 $query = $konekcija->prepare("select id, naslov, tekst, slika, UNIX_TIMESTAMP(vrijeme) vrijeme_objave, autor_id, komentarisanje from novosti where autor_id=? order by vrijeme desc");
    	 $query->bindValue(1, $autor, PDO::PARAM_INT);
     	 $query->execute();
    }
    else{
    	$query = $konekcija->query("select id, naslov, tekst, slika, UNIX_TIMESTAMP(vrijeme) vrijeme_objave, autor_id, komentarisanje from novosti order by vrijeme desc");
    }
    
	 if (!$query) {
	      $error = $konekcija->errorInfo();
	      print "SQL greška: " . $error[2];
	      exit();
	 }

	$row_count = $query->rowCount();
    if($row_count == 0)
    	echo "<h2> Niste objavili nijednu novost </h2>";

    $count = 0;
	$neparno;

	foreach ($query as $novost) {
		$count++;
		$neparno = false;
		$novihKomentara = 0;
		if($postoji){
			if($_SESSION['id'] == $novost['autor_id']){
				$komentari = $konekcija->prepare("select autor_id, procitano from komentari where novost_id=?");
				$komentari->bindValue(1, $novost['id'], PDO::PARAM_INT);
				$komentari->execute();

				if(!$komentari) {
				      $error = $konekcija->errorInfo();
				      print "SQL greška: " . $error[2];
				      exit();
				}

				foreach ($komentari as $komentar) {
					if($komentar['procitano'] == 0 && $komentar['autor_id'] != $_SESSION['id'])
						$novihKomentara++;		
				}
			}
		}

	    $tekst = array_filter(explode("|", $novost['tekst'])); //"Detaljnije" tekst je odvojen sa |

	    if($count % 2 != 0){
	    	echo "<div class='red'>
					<div class='lijevo'>";
					if($admin){
					echo"<div class='adminButton'>
						<a href='index.php' onclick='obrisiNovost(".$novost['id'].");'>Obriši</a>";
					if($novost['komentarisanje'] == 0)
					echo "<a href='' onclick='komentari(".$novost['id'].");'>Dozvoli komentare</a>";
					else echo	"<a href='' onclick='komentari(".$novost['id'].");'>Zabrani komentare</a>";
					echo	"</div>";
					}
					echo"<div clas = 'novost'>";
						if($novihKomentara!=0)
						echo "<h4>Novih komentara: " . $novihKomentara . "</h4>";
						if($novost['slika'] != null){
						echo "<img class='slika' src='" . $novost['slika'] . "' alt='slika'>";
						}
						echo "<h2 class='naslov_vijesti'>" . $novost['naslov'] . "</h2>";
						echo "<p class = 'tekst_objave'>" .  $tekst[0] . "</p>";
						echo "<div class='vrijeme'> 
								Novost objavljena " . date("d.m.Y. (h:i)", $novost['vrijeme_objave']) . 
						 	 "</div>"; 
						echo "<p class = 'detaljnije'>
						<a href='Novost.php?id=".$novost['id']."' onclick='procitajKom(".$novost['id'].");'>Saznajte više...</a>";
						echo"</p>
						</div>
					<br>
					</div>";
		}
		else{
			$neparno = true;
			echo"<div class='desno'>";
				if($admin){
					echo"<div class='adminButton'>
						<a href='index.php' onclick='obrisiNovost(".$novost['id'].");'>Obriši</a>";
					if($novost['komentarisanje'] == 0)
					echo "<a href='' onclick='komentari(".$novost['id'].");'>Dozvoli komentare</a>";
					else echo	"<a href='' onclick='komentari(".$novost['id'].");'>Zabrani komentare</a>";
					echo	"</div>";
					}
				echo"<div clas = 'novost'>";
					if($novihKomentara!=0)
						echo "<h4>Novih komentara: " . $novihKomentara . "</h4>";
					if($novost['slika'] != null){
					echo "<img class='slika' src='" . $novost['slika'] . "' alt='slika'>";
					}
					echo "<h2 class='naslov_vijesti'>" . $novost['naslov'] . "</h2>";
					echo "<p class = 'tekst_objave'>" .  $tekst[0] . "</p>";
					echo "<div class='vrijeme'> 
							Novost objavljena " . date("d.m.Y. (h:i)", $novost['vrijeme_objave']) . 
						 "</div>"; 
					echo "<p class = 'detaljnije'>
						<a href='Novost.php?id=".$novost['id']."' onclick='procitajKom(".$novost['id'].");'>Saznajte više...</a>";
					echo"</p>
					</div>
				<br>
				</div>
			</div>";

		}
	}

	if($count % 2 != 0 && !$neparno){
		print "</div>";
	}

 ?>

</div>		
</div>
<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>  

</body>
</html>
