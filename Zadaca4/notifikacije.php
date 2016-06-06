<?php

	session_start();
	$dsn = 'mysql:dbname=wtbaza;host=127.0.0.1';
    $user = 'root';
    $password = '';
    $notifikacije = 0;

    try{
        $konekcija = new PDO($dsn, $user, $password);
     } catch (PDOException $e) {
          echo 'Konekcija nije uspjela: ' . $e->getMessage();
        }

    $konekcija->exec("set names utf8");

    $query = $konekcija->prepare("select id from novosti where autor_id=?");
	$query->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
	$query->execute();

	if(!$query) {
	      $error = $konekcija->errorInfo();
	      print "SQL greška: " . $error[2];
	      exit();
	}

	foreach ($query as $novost){
		$komentari = $konekcija->prepare("select autor_id, procitano from komentari where novost_id=?");
		$komentari->bindValue(1, $novost['id'], PDO::PARAM_INT);
		$komentari->execute();

		if(!$komentari) {
		      $error = $konekcija->errorInfo();
		      print "SQL greška: " . $error[2];
		      exit();
		}

		foreach ($komentari as $komentar) {
			if($komentar['procitano'] == 0 && $komentar['autor_id'] != $_SESSION['id'])
				$notifikacije++;		
		}
	}

	if($notifikacije==0) print "";
	else print "(" . $notifikacije . ")";
?>