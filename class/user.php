<?php
class user {

	private $db;

    function __construct($DB_con)
		{
		  $this->db = $DB_con;
		}

    public function ajouterUser($uname,$umail,$upass,$upass2,$uphoto){
		   try
		   {
        /* $new_password = password_hash($upass, PASSWORD_DEFAULT);
         $new_password2 = password_hash($upass2, PASSWORD_DEFAULT);*/

         $sql = "INSERT INTO user (username,email,password,password2,photo) 
		 VALUES(:uname, :umail, :upass , :upass2 , :uphoto)";
			   $req = $this->db->prepare($sql);
         $req->bindparam(":uname", $uname);
         $req->bindparam(":umail", $umail);
         $req->bindparam(":upass", $upass);
         $req->bindparam(":upass2",$upass2);
         $req->bindparam(":uphoto", $uphoto);

         $req->execute();

			   return $req;
       }
       catch(PDOException $e)
		   {
			   echo $e->getMessage();
		   }

    }

    public function login($umail,$upass){
		   try
		   {
			  //On prépare la requête
			  $req = $this->db->prepare("SELECT * FROM user WHERE  email=:umail LIMIT 1");
			  //Un autre manière de relier les valeurs réelles et les paramètres fictifs
			  $req->execute(array(':umail'=>$umail));
			  // Récupérer une ligne avec fetch
			  $ligne=$req->fetch(PDO::FETCH_ASSOC);

			  if($req->rowCount() > 0)
			  {
				 // Si l'utilisteur existe alors
				 // On vérifie son mot de passe saisie avec le hashage enregistré dans la BD
				 if($upass==$ligne['password'])
				 {
					// Si le mot de passe est correct
					// alors on lui crée une session
					$_SESSION['user_session'] = $ligne['id'];
					return true;
				 }
				 else
				 {
					return false;
				 }
			  }
		   }
		   catch(PDOException $e)
		   {
			   echo $e->getMessage();
		   }
	   }


     public function redirect($url) {
     		header("Location: $url");
     	}

			public function is_loggedin() {
			//Il suffit de tester si la variable session $_SESSION['user_session'] existe ou non
			if(isset($_SESSION['user_session'])) {
					 return true;
			}
		}

		//Cette méthode permettra le déconnexion de l'utilisateur
	public function logout() {
		// Destruction de la session
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
   	}

public function afficheUser(){
	$sql = 'SELECT * FROM user';
	$req = $this->db->query($sql);
	while ($ligne = $req->fetch()) {

		/*echo '<div class="clear-users"></div>' ;
	echo '<div class="ui container" style="margin-left:-20% !important;" >';
	echo '<div class="ui  segment" style="color:#F0F8FF;background:rgba(0,0,0,.13);">' ;*/
	echo '<div class="ui middle aligned animated list">' ;
		echo '<div class="item">' ;
			echo '<img class="ui avatar image" src="img/'.$ligne["photo"].'">';
				echo '<label >'.$ligne["username"].'</label>';
				echo"</div>";
echo"</div>";
/*echo"</div>";
echo"</div>";*/}

}
public function supprime($iduser){
	$this->db->exec("DELETE FROM user WHERE id='$iduser' ");
}
  }
 ?>
