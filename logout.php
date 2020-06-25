<?php

require "db_config.php";
require "class/user.php" ;
$user = new user($db_config)  ;

//On déconnecte l'utilisateur
	$user->logout();
	//Puis on le redirige vers la page de connexion
	$user->redirect('login.php');

?>
