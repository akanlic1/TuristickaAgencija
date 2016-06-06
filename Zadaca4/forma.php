65<?php 
if (isset($_GET['id']))
	    $id = $_GET['id'];
if (isset($_GET['komentar_id']))
	    $komentar_id = $_GET['komentar_id'];
?>
<form action="Novost.php?id=<?=$id?>&komentar=<?=$komentar_id?>" method="post">
<textarea name="message" rows=2 cols=10 placeholder="Ostavi komentar"></textarea>
<br>
<input type="submit" value="Pošalji" name="submit">
</form>