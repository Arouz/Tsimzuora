<?php
	function connexionBase2() {
		// Paramètre de connexion serveur
		$host = "7k6x0.myd.infomaniak.com";
		$login = "7k6x0_arouz";
		$password = 'Candidature0';
		$base = "7k6x0_canditature"; // La bdd avec laquelle vous voulez travailler
		$port = 3306;
	
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
