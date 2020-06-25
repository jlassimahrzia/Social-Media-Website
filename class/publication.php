
<?php
class publication {

		private $db;

    function __construct($DB_con)
		{
		  $this->db = $DB_con;
		}

    public function ajouterPub($iduser,$titre,$texte){


      try
{

$sql = "INSERT INTO publication(id_user,titre,texte) VALUES(:uiduser, :utitre, :utexte)";
$req = $this->db->prepare($sql);

// puis on relie ensemble les valeurs réelles et les paramètres fictifs avec la méthode bindparam()
$req->bindparam(":uiduser",$iduser);
$req->bindparam(":utitre",$titre);
$req->bindparam(":utexte",$texte );

// Enfin on exécute la requête (avec la méthode execute() et non plus query() ou exec() )
$req->execute();

return $req;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

    }


    public function afficherPub(){

        $sql = 'SELECT * FROM publication';
        $req = $this->db->query($sql);

        while ($ligne = $req->fetch()) {
        /*$sql = 'SELECT username FROM user WHERE id=$ligne['id_user']';
        $req = $this->db->query($sql);*/
				$idp=$ligne['id_pub'];
				$req2 = $this->db->query( "SELECT * FROM commentaire WHERE id_pub='$idp'");


        $idu=$ligne['id_user'];
        $req1=$this->db->query("SELECT photo,username FROM user WHERE id='$idu'");

        while ($ligne1 = $req1->fetch()) {
          $username=$ligne1['username'];
          $photo=$ligne1['photo'];
        }

				$id_pub=$ligne['id_pub'];

        echo  "<div class='ui card' style='width:100%'>" ;
        echo    "<div class='content'>";
          echo    "<div class='right floated meta'>14h</div>" ;
          echo    "<img class='ui avatar image' src='img/$photo'> ".$username ;
          echo"  </div>";
          echo "<div class='segment' style='margin-left:1%;'>";
          echo"  <div class='ui container'>";
          echo "<h4>".$ligne['titre']."</h4>";
          echo   "<p>".$ligne['texte']."</p>";
            echo"</div>";
          echo"</div>";
          /*echo "<div class='content'>";
          echo  "<span class='right floated'>";

          echo"<input type='button' value='like' class='ui inverted red button ' style='width:40px;height:20px;font-size:10px;padding:1px;'>";
            echo"  <i class='heart outline like icon'></i>";
            echo"likes";
            echo"</span>";
            echo"<i class='comment icon'></i>";
            echo "3 comments";
          echo "</div>" ;*/
          echo"<div class='extra content'>";
            echo "<div class='ui large transparent left icon input'>";
            echo "<form method='post' action='home.php'>";
            echo"  <input type='text' placeholder='Add Comment...' name='cmt'>" ;
						echo"  <input type='text' value='$id_pub' name='id' style='display:none'>" ;
  echo  "</div>";
            echo"  <button type='submit' class='ui  right floated button' value='comment' name='commentaire' style='background: #529ecc ;
				    color:white ;'/>Comment</button>";
						echo "</form>";


						

echo"</div>";
					while ($ligne3 = $req2->fetch()) {
						$iduC=$ligne3['id_user'];
		        $req4=$this->db->query("SELECT photo,username FROM user WHERE id='$iduC'");
		        while ($ligne4 = $req4->fetch()) {
		          $usernameC=$ligne4['username'];
		          $photoC=$ligne4['photo'];
		        }
					  echo "<div class='segment' style='margin-left:1%;'>";
							echo    "<img class='ui avatar image' src='img/$photoC'> ".$usernameC ;
							echo   "<p>".$ligne3['commentaire']."</p>";
						echo"</div>";
					}

    echo"  </div>";
        }

    }

}
?>
