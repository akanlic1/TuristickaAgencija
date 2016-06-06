<?php 
session_start();
$postoji = isset($_SESSION['valid']) ? true : false;

if (isset($_GET['novost']))
	    $novost_id = $_GET['novost'];

$dsn = 'mysql:dbname=wtbaza;host=127.0.0.1';
$user = 'root';
$password = '';
$msg='';

try{
    $konekcija = new PDO($dsn, $user, $password);
 } catch (PDOException $e) {
      echo 'Konekcija nije uspjela: ' . $e->getMessage();
    }

$konekcija->exec("set names utf8");

$query = $konekcija->prepare("select id, autor_id from novosti where id=?");
$query->bindValue(1, $novost_id, PDO::PARAM_INT);
$query->execute();

if (!$query) {
	      $error = $konekcija->errorInfo();
	      print "SQL greška: " . $error[2];
	      exit();
	 }

foreach ($query as $novost) {
	
	if($postoji){
		if($_SESSION['id'] == $novost['autor_id']){
			$komentari = $konekcija->prepare("select id, autor_id, procitano from komentari where novost_id=?");
			$komentari->bindValue(1, $novost['id'], PDO::PARAM_INT);
			$komentari->execute();

			if(!$komentari) {
			      $error = $konekcija->errorInfo();
			      print "SQL greška: " . $error[2];
			      exit();
			}

			foreach ($komentari as $komentar) {
				if($komentar['procitano'] == 0 && $komentar['autor_id'] != $_SESSION['id']){
					$msg = $msg . "usao u komentare uslov ";
					$procitajKom = $konekcija->prepare("update komentari set procitano=1 where id=?");
					$procitajKom->bindValue(1, $komentar['id'], PDO::PARAM_INT);
					$procitajKom->execute();
				}				
			}
		}
	}
}

?>