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
	<div id="poruka"></div>
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

	 if (isset($_GET['id']))
	    $id = $_GET['id'];

	if(isset($_POST['submit'])){

		if (isset($_GET['komentar'])){
        
          $komentar_id = $_GET['komentar'];
          $odgovor = htmlEntities($_POST['message'], ENT_QUOTES);

          $query = $konekcija->prepare("insert INTO odgovori SET komentar_id=?, tekst=?, autor_id=?");
          $query->bindValue(1, $komentar_id, PDO::PARAM_INT);
          $query->bindValue(2, $odgovor, PDO::PARAM_STR);
          if($postoji)
          	$query->bindValue(3, $_SESSION['id'], PDO::PARAM_INT);
          else
          	$query->bindValue(3, null, PDO::PARAM_INT);
          $query->execute();

          if (!$query) {
          $greska = $konekcija->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
          }
        }

        else{
        	
          $id = $_GET['id'];
          $komentar = htmlEntities($_POST['message'], ENT_QUOTES);

          $query = $konekcija->prepare("insert INTO komentari SET novost_id=?, tekst=?, autor_id=?");
          $query->bindValue(1, $id, PDO::PARAM_INT);
          $query->bindValue(2, $komentar, PDO::PARAM_STR);
          if($postoji)
          	$query->bindValue(3, $_SESSION['id'], PDO::PARAM_INT);
          else
          	$query->bindValue(3, null, PDO::PARAM_INT);
          $query->execute();

          if (!$query) {
          $greska = $konekcija->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
          }
        }

    } 

     $query = $konekcija->prepare("select id, naslov, tekst, slika, UNIX_TIMESTAMP(vrijeme) vrijeme_objave, autor_id, komentarisanje from novosti where id=?");
     $query->bindValue(1, $id, PDO::PARAM_INT);
     $query->execute();
   
     if (!$query) {
          $error = $konekcija->errorInfo();
          print "SQL greška: " . $error[2];
          exit();
     }

    foreach ($query as $novost) {
    	echo"<div clas = 'novost'>";
			if($novost['slika'] != null){
			echo "<img class='slika' src='" . $novost['slika'] . "' alt='slika'>";
			}
			echo "<h2 class='naslov_vijesti'>" . $novost['naslov'] . "</h2>";
			$tekst = array_filter(explode("|", $novost['tekst']));
			echo "<p>" .  $tekst[0] . "</p>";
			if(isset($tekst[1])){
            echo "<p>" . $tekst[1] . "</p>";
            }
			echo "<div class='vrijeme'> 
					Novost objavljena " . date("d.m.Y. (h:i)", $novost['vrijeme_objave']) . 
				 "</div>";
			$autori = $konekcija->prepare("select username from korisnici where id=?");
	        	$autori->bindValue(1, $novost['autor_id'], PDO::PARAM_INT);
				$autori->execute();
				foreach ($autori as $autor) {
					echo "<p class = 'detaljnije'>
						<a href='index.php?autor=" . $novost['autor_id'] .  "'>Autor:".$autor['username']."</a>";
						echo"</p>";
				}   
		echo "</div>
		<br>
		</div>";
    }

    if($novost['komentarisanje'] == 1){
    	?>
		<div class="komentar">
		<form action="Novost.php?id=<?=$id?>" method="post">
		    <textarea name="message" rows=2 cols=10 placeholder="Ostavi komentar"></textarea>
		    <br>
		    <input type="submit" value="Pošalji" name="submit">
		</form>
		</div>
		<?php
    }

	$komentari = $konekcija->prepare("select id, tekst, autor_id, UNIX_TIMESTAMP(vrijeme) vrijeme_objave from komentari WHERE novost_id=? order by vrijeme desc");
	$komentari->bindValue(1, $id, PDO::PARAM_INT);
	$komentari->execute();

     if (!$komentari) {
          $error = $konekcija->errorInfo();
          print "SQL greška: " . $error[2];
          exit();
     }

     foreach ($komentari as $komentar) {
     	print "<div class='komentar'>";
     	if($admin){
			echo"<div class='adminButton'>
				<a href='Novost.php?id=".$id."' onclick='obrisiKomentar(".$komentar['id'].");'>Obriši komentar</a>".
				"</div>";
			}
	        if(isset($komentar['autor_id'])){
	        	$autori = $konekcija->prepare("select username from korisnici where id=?");
	        	$autori->bindValue(1, $komentar['autor_id'], PDO::PARAM_INT);
				$autori->execute();
				foreach ($autori as $autor) {
					print "<div class='autor'>" . $autor['username'] .  "</div>"; 
				}  
	        }
	        else{
	            print "<div class='autor'>Gost</div>";   
	        }
	        
	        print "<div class='datum'> Objavljeno: " . date("d.m.Y. (h:i)", $komentar['vrijeme_objave']) . "</div>";
	        print "<p>" . $komentar['tekst'] . "</p>";
	        if($novost['komentarisanje'] == 1){
	        	print "<a href='' onclick='loadForm(".$id.",".$komentar['id']."); return false;'>Odgovori</a>";
	        	print "<div id='komentarForma".$komentar['id']."'></div>";
	        }
	        $odgovori = $konekcija->prepare("select id, tekst, autor_id, UNIX_TIMESTAMP(vrijeme) vrijeme_objave from odgovori WHERE komentar_id=? order by vrijeme desc");
			$odgovori->bindValue(1, $komentar['id'], PDO::PARAM_INT);
			$odgovori->execute();

		     if (!$odgovori) {
		          $error = $konekcija->errorInfo();
		          print "SQL greška: " . $error[2];
		          exit();
		     }

		     foreach ($odgovori as $odgovor) {
		     	print "<div class='odgovor'>";
		     	if($admin){
				echo"<div class='adminButton'>
					<a href='Novost.php?id=".$id."' onclick='obrisiOdgovor(".$odgovor['id'].");'>Obriši odgovor</a>".
					"</div>";
				}
		        if(isset($odgovor['autor_id'])){
		        	$autori = $konekcija->prepare("select username from korisnici where id=?");
		        	$autori->bindValue(1, $odgovor['autor_id'], PDO::PARAM_INT);
					$autori->execute();
					foreach ($autori as $autor) {
						print "<div class='autor'>" . $autor['username'] .  "</div>"; 
					}  
		        }
		        else{
		            print "<div class='autor'>Gost</div>";   
		        }
		        
		        print "<div class='datum'> Objavljeno: " . date("d.m.Y. (h:i)", $odgovor['vrijeme_objave']) . "</div>";
		        print "<p>" . $odgovor['tekst'] . "</p>";
		        print "</div>";
		     }
	    print "</div>";
     }
?>

</div>		
</div>		
<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>  

</body>
</html>