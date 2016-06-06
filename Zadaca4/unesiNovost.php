<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Kontakt</title>
  <link rel="stylesheet" type="text/css" href="Stil.css">
  <script type="text/javascript" src="skripta.js"></script>
</head>
<body>

<?php

session_start();
$postoji = isset($_SESSION['valid']) ? true : false;
$admin = isset($_SESSION['admin']) ? true : false;
$dsn = 'mysql:dbname=wtbaza;host=127.0.0.1';
$user = 'root';
$password = '';
$msg = '';

try{
    $konekcija = new PDO($dsn, $user, $password);
 } catch (PDOException $e) {
      echo 'Konekcija nije uspjela: ' . $e->getMessage();
    }

 $konekcija->exec("set names utf8");

if (isset($_POST['novost']))
{
    if(isset($_POST['naslov']) && isset($_POST['slika']) && isset($_POST['tekst'])){

      if(empty($_POST['naslov']) || empty($_POST['slika']) || empty($_POST['tekst']))
        $msg = "Popunite sva polja";
      else{
        $naslov = htmlEntities($_POST['naslov'], ENT_QUOTES);
        $tekst = htmlEntities($_POST['tekst'], ENT_QUOTES);
        $slika = htmlEntities($_POST['slika'], ENT_QUOTES);

         $query = $konekcija->prepare("insert into novosti set autor_id=?, naslov=?, tekst=?, slika=?, komentarisanje=?");
         $query->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
         $query->bindValue(2, $naslov, PDO::PARAM_STR);
         $query->bindValue(3, $tekst, PDO::PARAM_STR);
         $query->bindValue(4, $slika, PDO::PARAM_STR);
         if(isset($_POST['komentarisanje']))
         $query->bindValue(5, $_POST['komentarisanje'], PDO::PARAM_INT);
         else
         $query->bindValue(5, 0, PDO::PARAM_INT);
         $query->execute();
     
         if (!$query) {
              $error = $konekcija->errorInfo();
              print "SQL greška: " . $error[2];
              exit();
          }

        $msg = "Novost uspjesno dodana";
      }
      
    }
}

	
?>

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
<div class="container">
	
	<?php 
  echo "<h2>". $msg ."</h2>";
	if($postoji){ ?>
      <div id="login">

        <h2><span class="fontawesome-lock"></span>Unesi novost</h2>

        <form action="unesiNovost.php" method="post">

          <fieldset>

            <p><label for="naslov">Naslov</label></p>
            <p><input type="text" name="naslov"></p>

            <p><label for="slika">URL slike</label></p>
            <p><input type="text" name="slika"></p>
            <p><label for="tekst">Tekst</label></p>
            <p><textarea name="tekst" rows=4 cols=20></textarea></p>
            <p><label for="komentarisanje">Dozvoli komentare</label>
            <input type="checkbox" name="komentarisanje" value="1"></p>
            <p><input type="submit" value="Objavi" name="novost"></p>

          </fieldset>

        </form>

      </div>
	<?php } ?>

</div>
</div>
<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>

</body>
</html>



