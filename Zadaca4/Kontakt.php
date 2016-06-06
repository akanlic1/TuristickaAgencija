<?php
  session_start();
  $postoji = isset($_SESSION['valid']) ? true : false;
  $admin = isset($_SESSION['admin']) ? true : false;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Kontakt</title>
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
<div id="form-main">
  <div id="form-div">
    <form class="form" id="form1" method="post" action="" onsubmit="return validirajIme() && validirajEmail() && validirajKontakt() && provjeriPolja();">
      
      <p class="name">
        <input name="name" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Name" id="name" onchange="validirajIme()" />
      </p>
      
      <p class="email">
        <input name="email" type="text" class="validate[required,custom[email]] feedback-input" id="email" placeholder="Email" onchange="validirajMail()" />
      </p>
      
      <p class="text">
        <textarea name="text" class="validate[required,length[6,300]] feedback-input" id="comment" placeholder="Comment" onsubmit="validirajKomentar()" onchange="provjeriPolja()" ></textarea>
      </p>
      
    
      <div class="submit">
        <input type="submit" value="SEND" id="button-blue" onsubmit="return validirajIme() && validirajEmail() && validirajKontakt() && provjeriPolja();" />
        <div class="ease"></div>
      </div>
    </form>
  </div>

</div>
</div>
<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>

</body>
</html>
