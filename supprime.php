<?php
require "db_config.php";
require "class/user.php" ;
$user = new user($db_config)  ;


  $user->supprime();
  //Puis on le redirige vers la page de connexion
  $user->redirect('login.php');

?>

?>
