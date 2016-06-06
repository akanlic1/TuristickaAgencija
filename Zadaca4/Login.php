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

if (isset($_POST['prijava']))
{
	
     $username = htmlEntities($_POST['username'], ENT_QUOTES);
     $password = htmlEntities($_POST['password'], ENT_QUOTES);

     $query = $konekcija->prepare("select id, username, password from korisnici where username=? and password=?");
     $query->bindValue(1, $username, PDO::PARAM_STR);
     $query->bindValue(2, md5($password), PDO::PARAM_STR);
     $query->execute();
   
     if (!$query) {
          $error = $konekcija->errorInfo();
          print "SQL greška: " . $error[2];
          exit();
     }
    

    $row_count = $query->rowCount();
    if($row_count == 1){
    	$user = $query->fetch(PDO::FETCH_ASSOC);
    	if($user['username'] == 'admin')
    		$_SESSION['admin'] = true;
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['id'] = $user['id'];	
		$_SESSION['username'] = $user['username'];	
		$_SESSION['password']= md5($user['password']);	
		$msg = "Uspjesno ste se prijavili";
    }
    else{
    	$msg = "Neuspjesna prijava";
    }
	
}

$postoji = isset($_SESSION['valid']) ? true : false;
$admin = isset($_SESSION['admin']) ? true : false;
	
if(isset($_POST['reset'])){
	$password = htmlEntities($_POST['password'], ENT_QUOTES);
	$query = $konekcija->prepare("update korisnici set password=? where id=?");
     $query->bindValue(1, md5($password), PDO::PARAM_STR);
     $query->bindValue(2, $_SESSION['id'], PDO::PARAM_INT);
     $query->execute();
   
     if (!$query) {
          $error = $konekcija->errorInfo();
          print "SQL greška: " . $error[2];
          exit();
     }

     $msg = "Uspjesno ste promijenili password";
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
	echo "<h2>" . $msg . "</h2>";

	if(!$postoji){ ?>
      <div id="login">

        <h2><span class="fontawesome-lock"></span>Sign In</h2>

        <form action="Login.php" method="post">

          <fieldset>

            <p><label for="username">Username</label></p>
            <p><input type="text" name="username" placeholder="username"></p>

            <p><label for="password">Password</label></p>
            <p><input type="password" name="password" placeholder="password"></p>

            <p><input type="submit" value="Prijava" name="prijava"></p>

          </fieldset>

        </form>

      </div>
	<?php } 
	else{ ?>

		<div id="login">

        <h2><span class="fontawesome-lock"></span>Promijeni password</h2>

        <form action="Login.php" method="post">

          <fieldset>

            <p><label for="password">Novi password</label></p>
            <p><input type="password" name="password" placeholder="password"></p>

            <p><input type="submit" value="Promijeni" name="reset"></p>

          </fieldset>

        </form>

      </div>

	<?php }?>
 
</div>
</div>
<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>

</body>
</html>



