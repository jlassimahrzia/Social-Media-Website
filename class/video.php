<?php
class video {

		private $db;

    function __construct($DB_con)
		{
		  $this->db = $DB_con;
		}

    public function ajouterVideo($iduser,$titre,$url){

      $sql = "INSERT INTO videos (id_user,titreV,url_video) VALUES ($iduser, '$titre','$url')";
      $req = $this->db->exec($sql);
    }

    public function afficherVideo(){
      $sql = 'SELECT * FROM videos';
      $req = $this->db->query($sql);
      while ($ligne = $req->fetch()) {
      /*$sql = 'SELECT username FROM user WHERE id=$ligne['id_user']';
      $req = $this->db->query($sql);*/

      $idvideo=$ligne['id_video'];
      $idu=$ligne['id_user'];

      $req1=$this->db->query("SELECT photo,username FROM user WHERE id='$idu'");
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
        echo "<embed src='video/$url' style='width:100%''></embed>";
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
			echo  "</div>";
		  echo"  <button type='submit' class='ui  right floated button' value='comment' name='comentaireV' style='background: #529ecc ;color:white ;'/>Comment</button>";
      echo "</form>";

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
    }
  }

    }
?>
