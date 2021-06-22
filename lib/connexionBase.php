<?php

	function connexionBase()
	{
		// Paramètre de connexion serveur
		$host = "tsimzuorxkarouz.mysql.db";
		$login= "tsimzuorxkarouz"; // Votre loggin d'accès au serveur de BDD
		$password="4ItF8vDe6Gzbo87yQV"; // Le Password pour vous identifier auprès du serveur
		$base = "tsimzuorxkarouz"; // La bdd avec laquelle vous voulez travailler

		try {
			$db = new PDO('mysql:host=' . $host . ';charset=utf8;dbname=' . $base, $login, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (Exception $e) {
			print 'Erreur : ' . $e->getMessage() . '<br />';
			print 'N° : ' . $e->getCode();
			die("Connexion au serveur impossible. ");
		}
	}

	function connexionBase2() {
		// Paramètre de connexion serveur
		$host = "cr255003-001.dbaas.ovh.net";
		$login= "tsimzuorxkarouz2"; // Votre loggin d'accès au serveur de BDD
		$password="w50hyuMz8YGZD7ugJzRA6w"; // Le Password pour vous identifier auprès du serveur
		$base = "tsimzuoradvfvaleursfoncieres"; // La bdd avec laquelle vous voulez travailler
		$port = 35166;
	
		try {
			//$db = new PDO('mysql:host=cr255003-001.dbaas.ovh.net;port=35166;dbname=tsimzuoradvfvaleursfoncieres', 'tsimzuorxkarouz2', 'w50hyuMz8YGZD7ugJzRA6w');
			$db = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $base, $login, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (Exception $e) {
			print 'Erreur : ' . $e->getMessage() . '<br />';
			print 'N° : ' . $e->getCode();
			die("Connexion au serveur impossible. ");
		}
	}
?>


