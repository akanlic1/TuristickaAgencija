<?php 
session_start();
$postoji = isset($_SESSION['valid']) ? true : false;

if (isset($_GET['komentar']))
	    $komentar_id = $_GET['komentar'];

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

$query = $konekcija->prepare("delete from komentari where id=?");
$query->bindValue(1, $komentar_id, PDO::PARAM_INT);
$query->execute();

if (!$query) {
      $error = $konekcija->errorInfo();
      print "SQL greška: " . $error[2];
      exit();
}

?>