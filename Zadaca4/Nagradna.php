<?php
	session_start();
	$postoji = isset($_SESSION['valid']) ? true : false;
	$admin = isset($_SESSION['admin']) ? true : false;
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
		<h2>Dobitnici nagradne igre "S nama na Maldive" su:</h2>
		<table>
			<tr id="prviRed">
				<td>Ime</td>
				<td>Prezime</td>
				<td>Grad</td>
				<td>Datum polaska</td>
				<td>Datum dolaska</td>
			</tr>
			<tr>
				<td>Ajla</td>
				<td>Rizvan</td>
				<td>Visoko</td>							
				<td>12.07.2016.</td>
				<td>27.07.2016.</td>
			</tr>
			<tr>
				<td>Faruk</td>
				<td>Sarajlić</td>
				<td>Zenice</td>
				<td>12.07.2016.</td>
				<td>27.07.2016.</td>
			</tr>
			<tr>
				<td>Aida</td>
				<td>Kanlić</td>
				<td>Goražde</td>
				<td>12.07.2016.</td>
				<td>27.07.2016.</td>
			</tr>
			<tr>
				<td>Tarik</td>
				<td>Karić</td>
				<td>Sarajevo</td>
				<td>12.07.2016.</td>
				<td>27.07.2016.</td>
			</tr>			
		</table>
	</div>
	<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>
</div>

</body>
</html>