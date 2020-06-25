<?php
class comentaire {

		private $db;

    function __construct($DB_con)
		{
		  $this->db = $DB_con;
		}

    public function ajouterCmt($idpub,$iduser,$cmt){

      $sql = "INSERT INTO categorie (id_pub,id_user,commentaire) VALUES ($idpub,$iduser ,'$cmt')";
      $req = $this->db->exec($sql);
    }
    public function ajouterCmtImg($iduser,$idimg,$cmt){

      $sql = "INSERT INTO comentaireimg (id_user,id_img,comentaire) VALUES ($iduser ,$idimg,'$cmt')";
      $req = $this->db->exec($sql);

    }
    public function ajouterCmtVideo($iduser,$idv,$cmt){

      $sql = "INSERT INTO comentairevideo (id_user,id_video,comentaire) VALUES ($iduser ,$idv,'$cmt')";
      $req = $this->db->exec($sql);

    }

}
?>
