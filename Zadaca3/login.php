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
ob_start();
	require_once('Login.php');
    $msg = '';

    $sadrzaj=file('users.txt');
	$array=explode('|',$sadrzaj[0]);
	
	$ime=$array[0];
	$lozinka=$array[1];
	
	if (isset($_POST['prijava']) && $_POST['username']==$ime && md5($_POST['password'])==$lozinka)
	{
		session_start();
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['username'] = $ime;	
		$_SESSION['password']=$lozinka;	
		
		$msg="Uspješno ste se prijavili";

	}
	
	
	ob_end_clean();
?>

<div id="okvir">
	<div id="zaglavlje">
		<div class="wrap">
  			<div class="logoWrap"></div>
		</div>
		<h1>Turistička agencija</h1>
		<div id="meni">
			<ul>
				<li><a href="Naslovnica.html">Naslovnica</a> |</li>
				<li><a href="Nagradna.html">Nagradna igra</a> |</li>
				<li><a href="Linkovi.html">Linkovi</a> |</li>
				<li><a href="Kontakt.html">Kontakt</a> |</li>
        <li class="aktivna">Login </li>
			</ul>
		</div>
 </div>
<div class="container">

      <div id="login">

        <h2><span class="fontawesome-lock"></span>Sign In</h2>

        <form action="login.php" method="post">

          <fieldset>

            <p><label for="username">Username</label></p>
            <p><input type="text" id="username" placeholder="username"></p>

            <p><label for="password">Password</label></p>
            <p><input type="password" id="password" placeholder="password"></p>

            <p><input type="submit" value="Sign In"></p>

          </fieldset>

        </form>

      </div> <!-- end login -->

 
</div>
</div>
<p id = "copyright">Copyright &copy; 2016. Aida Kanlić</p>

</body>
</html>



