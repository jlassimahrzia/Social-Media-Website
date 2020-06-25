<?php
class image {

		private $db;

    function __construct($DB_con)
		{
		  $this->db = $DB_con;
		}

    public function ajouterImg($iduser,$titre,$image){

$sql = "INSERT INTO images (id_user,url_image,titre) VALUES ($iduser,  '$image','$titre')";
$req = $this->db->exec($sql);
    /*  try
{


$sql = "INSERT INTO images(id_user,url_image,titre) VALUES(:uiduser, :uimage, :utitre)";
$req = $this->db->prepare($sql);

// puis on relie ensemble les valeurs réelles et les paramètres fictifs avec la méthode bindparam()
$req->bindparam(":uiduser",$iduser);
$req->bindparam(":uimage",$titre);
$req->bindparam(":utitre",$image );

// Enfin on exécute la requête (avec la méthode execute() et non plus query() ou exec() )
$req->execute();

return $req;
}
catch(PDOException $e)
{
echo $e->getMessage();
}*/

    }

    public function afficherImg(){

        $sql = 'SELECT * FROM images';
        $req = $this->db->query($sql);
        while ($ligne = $req->fetch()) {
        /*$sql = 'SELECT username FROM user WHERE id=$ligne['id_user']';
        $req = $this->db->query($sql);*/

				$idimg=$ligne['id_img'];
        $idu=$ligne['id_user'];

        $req1=$this->db->query("SELECT photo,username FROM user WHERE id='$idu'");
        while ($ligne1 = $req1->fetch()) {
          $username=$ligne1['username'];
          $photo=$ligne1['photo'];
        }

        echo "<div class='ui card' style='width:100%'>" ;
        echo  "<div class='content'>" ;
        echo "   <div class='right floated meta'>14h</div>" ;
          echo"  <img class='ui avatar image' src='img/$photo'>".$username;
          echo "<h4>".$ligne['titre']."</h4>";
        echo"  </div>";
        echo"<div class='image'>";
          echo "<img class='ui image' src='img/".$ligne['url_image']."'>";
        echo'</div>' ;
    /*echo "  <div class='content'>";
      echo'  <span class="right floated">';
      echo'    <i class="heart outline like icon"></i>';
      echo'    17 likes';
        echo '</span>' ;
      echo '  <i class="comment icon"></i> '  ;
      echo   '  3 comments' ;
      echo '</div>'  ;*/
			echo"<div class='extra content'>";
				echo "<div class='ui large transparent left icon input'>";
				echo "<form method='post' action='home.php'>";
				echo"  <input type='text' placeholder='Add Comment...' name='cmtImg'>" ;
				echo"  <input type='text' value='$idimg' name='idImg' style='display:none'>" ;
				echo  "</div>";
			    echo"  <button type='submit' class='ui  right floated button' value='comment' name='commentaireImg' style='background: #529ecc ;
							    color:white ;'/>Comment</button>";
				echo "</form>";

echo"</div>";

	$req2 = $this->db->query( "SELECT * FROM comentaireimg WHERE id_img='$idimg'");
			while ($ligne3=$req2->fetch()) {
				$iduC=$ligne3['id_user'];
				$req4=$this->db->query("SELECT photo,username FROM user WHERE id='$iduC'");
				while ($ligne4 = $req4->fetch()) {
					$usernameC=$ligne4['username'];
					$photoC=$ligne4['photo'];
				}
				echo "<div class='segment' style='margin-left:1%;'>";
					echo    "<img class='ui avatar image' src='img/$photoC'> ".$usernameC ;
					echo   "<p>".$ligne3['comentaire']."</p>";
				echo"</div>";
			}

  echo '</div>' ;
      }
    }
}
?>
