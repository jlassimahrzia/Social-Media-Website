<?php
class profilPersonnel {

		private $db;

    function __construct($DB_con)
		{
		  $this->db = $DB_con;
		}
    public function afficherPubPer($iduser){
      $sql = "SELECT * FROM publication WHERE id_user='$iduser'";
      $req = $this->db->query($sql);
      while ($ligne = $req->fetch()) {
        $idp=$ligne['id_pub'];
				$req2 = $this->db->query( "SELECT * FROM commentaire WHERE id_pub='$idp'");

        $req1=$this->db->query("SELECT photo,username FROM user WHERE id='$iduser'");
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
        /*  echo "<div class='content'>";
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
            echo "<form method='post' action='profil.php'>";
            echo"  <input type='text' placeholder='Add Comment...' name='cmt'>" ;
						echo"  <input type='text' value='$id_pub' name='id' style='display:none'>" ;

            echo"  <input type='submit' class='ui button' value='comment' name='commentaire'/>";
						echo "</form>";
          echo  "</div>";
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
echo"</div>";}
echo"  </div>";
      }
    }

    public function afficherImgPer($iduser){
      $sql = "SELECT * FROM images WHERE id_user='$iduser' ";
      $req = $this->db->query($sql);
      while ($ligne = $req->fetch()) {
        $idimg=$ligne['id_img'];
        $req1=$this->db->query("SELECT photo,username FROM user WHERE id='$iduser'");
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
        echo"  <input type='submit' class='ui button' value='comment' name='commentaireImg'/>";
        echo "</form>";
        echo  "</div>";
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

      public function afficherVidPer($iduser){
        $sql = "SELECT * FROM videos  WHERE id_user='$iduser'";
        $req = $this->db->query($sql);
        while ($ligne = $req->fetch()) {
          $idvideo=$ligne['id_video'];
          $req1=$this->db->query("SELECT photo,username FROM user WHERE id='$iduser'");

        while ($ligne1 = $req1->fetch()) {
          $username=$ligne1['username'];
          $photo=$ligne1['photo'];
        }
        $url=$ligne['url_video'];
        echo "<div class='ui card' style='width:100%'>" ;
        echo  "<div class='content'>" ;
        echo "   <div class='right floated meta'>14h</div>" ;
          echo"  <img class='ui avatar image' src='img/$photo'>".$username;
          echo "<h4>".$ligne['titreV']."</h4>";
        echo"  </div>";
        echo"<div class='image'>";
          echo "<embed src='video/$url' style='width:100%;'></embed>";
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
        echo"  <input type='text' placeholder='Add Comment...' name='cmtV'>" ;
        echo"  <input type='text' value='$idvideo' name='idV' style='display:none'>" ;
        echo"  <input type='submit' class='ui button' value='comment' name='comentaireV'/>";
        echo "</form>";
        echo  "</div>";
  echo"</div>";

  $req2 = $this->db->query( "SELECT * FROM comentairevideo WHERE id_video='$idvideo'");
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
}}
  }
?>
