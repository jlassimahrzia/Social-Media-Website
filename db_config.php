<?php
	//On commence une session
	session_start();

	//Les paramètres de connexion
	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "";
	$DB_name = "projet";

	try {
		//ON crée une nouvelle connexion
		$db_config = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}

?>
