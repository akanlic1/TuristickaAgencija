<?php
	session_start();
	$postoji = isset($_SESSION['valid']) ? true : false;
	$admin = isset($_SESSION['admin']) ? true : false;
	$dodaj = isset($_GET['dodaj']) ? true : false;
	$obrisi = isset($_GET['obrisi']) ? true : false;
	$uredi = isset($_GET['uredi']) ? true : false;

	$dsn = 'mysql:dbname=wtbaza;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try{
        $konekcija = new PDO($dsn, $user, $password);
     } catch (PDOException $e) {
          echo 'Konekcija nije uspjela: ' . $e->getMessage();
        }

    $konekcija->exec("set names utf8");


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Nagradna igra</title>
  <link rel="stylesheet" type="text/css" href="Stil.css">
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
	<div id="tabelaDio">
		<?php

		$msg='';

		if($obrisi){
			 $query = $konekcija->prepare("delete from korisnici where id=?");
	         $query->bindValue(1, $_GET['korisnik_id'], PDO::PARAM_STR);
	         $query->execute();
	     
	         if (!$query) {
	              $error = $konekcija->errorInfo();
	              print "SQL greška: " . $error[2];
	              exit();
	         }

	        $msg = "Korisnik uspjesno izbrisan";
	        $obrisi = false;
		}

		if (isset($_POST['dodaj']))
			{
		      if(empty($_POST['username']) || empty($_POST['password']))
		        $msg = "Popunite sva polja";
		      else{

		        $username = htmlEntities($_POST['username'], ENT_QUOTES);
		        $password = htmlEntities($_POST['password'], ENT_QUOTES);
		        
		         $query = $konekcija->prepare("insert into korisnici set username=?, password=?");
		         $query->bindValue(1, $username, PDO::PARAM_STR);
		         $query->bindValue(2, md5($password), PDO::PARAM_STR);
		         $query->execute();
		     
		         if (!$query) {
		              $error = $konekcija->errorInfo();
		              print "SQL greška: " . $error[2];
		              exit();
		         }

		        $msg = "Korisnik uspjesno dodan";
		        $dodaj = false;
		      }
			}

			if (isset($_POST['uredi']))
			{
		      if(empty($_POST['username']))
		        $msg = "Unesite username";
		      else{

		        $username = htmlEntities($_POST['username'], ENT_QUOTES);
		        if(empty($_POST['password'])){
		        	 $query = $konekcija->prepare("update korisnici set username=? where id=?");
			         $query->bindValue(1, $username, PDO::PARAM_STR);
			         $query->bindValue(2, $_GET['korisnik_id'], PDO::PARAM_INT);
		        }
		        else{
		        	$password = htmlEntities($_POST['password'], ENT_QUOTES);
		        	$query = $konekcija->prepare("update korisnici set username=?, password=? where id=?");
			         $query->bindValue(1, $username, PDO::PARAM_STR);
			         $query->bindValue(2, md5($password), PDO::PARAM_STR);
			         $query->bindValue(3, $_GET['korisnik_id'], PDO::PARAM_INT);
		        }

		        $query->execute();

		         if (!$query) {
		              $error = $konekcija->errorInfo();
		              print "SQL greška: " . $error[2];
		              exit();
		         }

		        $msg = "Korisnik uspjesno uredjen";
		        $uredi = false;
		      }
			}

			echo "<h2>" . $msg . "</h2>";
			if(!$dodaj)
				echo "<div class='adminButton'><a href='admin.php?dodaj=true'>Dodaj korisnika</a></div>";
		 	else{ ?>
			<div id="login">
			<h2><span class="fontawesome-lock"></span>Dodaj korisnika</h2>
	        <form action="admin.php?dodaj=true" method="post">
	          <fieldset>
	            <p><label for="username">Username</label></p>
	            <p><input type="text" name="username" placeholder="username"></p>
	            <p><label for="password">Password</label></p>
	            <p><input type="password" name="password" placeholder="password"></p>
	            <p><input type="submit" value="Dodaj" name="dodaj"></p>
	          </fieldset>
	        </form>
	      	</div>
	      	<?php }?>

	      	<?php if($uredi){
		 		 $query = $konekcija->prepare("select username, password from korisnici where id=?");
		         $query->bindValue(1, $_GET['korisnik_id'], PDO::PARAM_STR);
		         $query->execute();
		     
		         if (!$query) {
		              $error = $konekcija->errorInfo();
		              print "SQL greška: " . $error[2];
		              exit();
		         }

		        foreach ($query as $user) {
		        	$username = $user['username'];
		        }

		    ?>
			<div id="login">
			<h2><span class="fontawesome-lock"></span>Uredi korisnika</h2>
	        <form action="admin.php?uredi=true&korisnik_id=<?=$_GET['korisnik_id']?>" method="post">
	          <fieldset>
	            <p><label for="username">Username</label></p>
	            <p><input type="text" name="username" placeholder="username" value=<?=$username?>></p>
	            <p><label for="password">Password</label></p>
	            <p><input type="password" name="password" placeholder="password"></p>
	            <p><input type="submit" value="Uredi" name="uredi"></p>
	          </fieldset>
	        </form>
	      	</div>
	      	<?php }?>
		<h2>Lista korisnika</h2>
		<table>
			<tr id="prviRed">
				<td>username</td>
				<td></td>
			</tr>
			<?php 

	    	$query = $konekcija->query("select id, username, password from korisnici");
	    
			 if (!$query) {
			      $error = $konekcija->errorInfo();
			      print "SQL greška: " . $error[2];
			      exit();
			 }

			foreach ($query as $korisnik) {
				if($korisnik['username']!='admin')
				echo "<tr>
				<td>".$korisnik['username']."</td>
				<td><div class='adminButton'><a href='admin.php?obrisi=true&korisnik_id=".$korisnik['id']."'>Obriši</a>
				<a href='admin.php?uredi=true&korisnik_id=".$korisnik['id']."'>Uredi</a></div></td>
				</tr>";
			}
			?>

		</table>
	</div>
	<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>
</div>

</body>
</html>