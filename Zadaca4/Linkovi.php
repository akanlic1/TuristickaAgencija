<?php
	session_start();
	$postoji = isset($_SESSION['valid']) ? true : false;
	$admin = isset($_SESSION['admin']) ? true : false;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Linkovi</title>
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


	<div id="linkovi">
		<h3 id="tekst">Pitate se gdje ljetovati ove godine? Donosimo vam top 10 svjetskih lokacija za ljetni odmor. Izbor je na vama.</h3>
			
			<div class="lijevo">
			<ul class="listaLinkova">
				<li><a href="http://www.putokosvijeta.com/maldivi-romanticna-destinacija/">Maldivi</a></li>
				<li> <a href="http://www.topdestinacije.com/copacabana-plaza-rio-de-zaneiro/">Rio de Janeiro</a> </li>
				<li><a href="http://www.b92.net/putovanja/destinacije/bliski_istok.php?&nav_id=515442">Dubai</a></li>
				<li><a href="http://www.superodmor.rs/magazin/putopisi/197483/turisticka-prestonica-karipskih-ostrva--bahami">Bahami</a></li>
				<li><a href="http://www.putovanjesnova.com/2013/03/23/istanbul-sta-posjetiti-u-gradu-preko-15-miliona-stanovnika/">Istanbul</a></li>
				</ul>
				</div>
			<div class="desno">
			<ul class="listaLinkova">
				<li><a href="http://www.luxlife.rs/putovanja/destinacije/Cudo-afrike-viktorijini-vodopadi">Viktorijni vodopadi</a></li>
				<li><a href="http://www.wish.hr/2015/09/sardinija-mjesto-ekskluzivnog-turizma/">Sardinija</a></li>
				<li><a href="http://www.kako.hr/clanak/kako-opisati-palma-de-mallorcu-europsku-floridu-200.html">Palma de Mallorca</a></li>
				<li><a href="http://opusteno.rs/putovanja-f42/meksiko-kankun-cancun-grad-sa-predivnim-plazama-t11788.html">Cancun, Meksiko</a></li>
				<li><a href="http://smart-travel.hr/kuba-10-razloga-za-putovanje/">Kuba</a></li>
			</ul>
	  </div>

	</div><br><br><br><br><br>
	<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>
</div>

</body>
</html>