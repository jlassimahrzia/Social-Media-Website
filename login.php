<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="script/monscript.js"></script>
    <style >
      a{
        color: white ;
      }
      #erreure{
        background-color: #990000 ;
        color: white ;
        font-size: 15px ;
        height: 30px ;
        padding-top: 5px ;
        padding-bottom: 1px ;

      }
      #erreureEmail{
        background-color: #990000 ;
        color: white ;
        font-size: 15px ;
        height: 36px ;
        padding-top: 5px ;
        padding-bottom: 1px ;
      }
    </style>
    <?php
    require "db_config.php";
    require "class/user.php" ;



    if(isset($_POST['btn-login'])) {

      $Email=$_POST['Email'] ;
      $Password=$_POST['Password'];

      if(empty($Email)){
           $erEmail="You should enter your Email"  ;
           $valide=false ;
      }

      if(empty($Password)){
           $erPassword="You should enter your password"  ;
           $valide=false ;
     }

      $user = new user($db_config)  ;

      $valide=true ;
      $valideEmail=false;
      $validePass=false;
      if($valide){
              if ($user->login($Email,$Password))  {
			                 $user->redirect('home.php');
 		                 }

              else{
                // Il n'y a pas d'erreurs
                    try {
                  // On prépare la requête
                  // ON recherche si l'utilisateur existe déjà dans la base
                  // La recherche se fait par username ou email
                      $req = $db_config->prepare("SELECT email FROM user WHERE email=:umail  ");
                      $req->execute(array(':umail'=>$Email));

                  //On récupère le résultat
                  $ligne=$req->fetch(PDO::FETCH_ASSOC);
                if($ligne['email']==$Email){
                    $valideEmail=true;
                  }
                  $req = $db_config->prepare("SELECT password FROM user WHERE password=:upass ");
                  $req->execute(array(':upass'=>$Password));
                  $ligne=$req->fetch(PDO::FETCH_ASSOC);
                  if($ligne['password']==$Password) {
                    $validePass=true;
                  }

              }
              catch(PDOException $e) {
                echo $e->getMessage();
              }


          }
}
          $two=true ;
          if(($valideEmail==false)&&($validePass==false)){
            $two=false ;
          }
          if($two==false){
            $erEmail="Please create an account.";
          }
          if(($valideEmail==false)&&($two==true)){
            $erEmail="The email entered does not match any account";
            $tow=false ;
          }
          if(($validePass==false)&&($two==true)){
            $erPassword="The password entered does not match any account";
            $tow=false ;
          }


}

    ?>
  </head>
  <body>
  <header class="header" >
    <div class="container_one" >
        <div class="ui three column  centred grid" id=" header_one" >
          <div class="column"></div>

          <div class="column">
            <div class="img-logo">
                <img src="img/logo.png" alt="logo" class="pos-img">
            </div>
            <div class="site-logo" id="titre">
              <label >YouPost</label>
            </div>
              <div class="login">
                <form method="post" action="login.php">
                <div class="ui form">
                  <?php
       if(isset($erEmail)){
         echo "<div class='ui pointing below label' id='erreureEmail'>" ;
             echo $erEmail ;
           echo "</div>" ;

           echo "<script>" ;
           echo "  $(document).ready(function(){
                  $('.Email').css('border','solid 2px #990000')
                  }); " ;
           echo "</script>" ;
       }
       ?>
                  <div class="required field">
                    <div class="ui left icon input">
                      <input id="black-input" type="email" placeholder="Email"
                      onblur="remettreNormalement(this)" onclick="changerCouleur(this)" name="Email">
                      <i class="mail icon"></i>
                  </div>
                  </div>
                  <?php
       if(isset($erPassword)){
         echo "<div class='ui pointing below label' id='erreure'>" ;
             echo $erPassword ;
           echo "</div>" ;

           echo "<script>" ;
           echo "  $(document).ready(function(){
                  $('.Password').css('border','solid 2px #990000')
                  }); " ;
           echo "</script>" ;
       }
       ?>
                  <div class="required field">
                    <div class="ui left icon right labeled input">
                      <input id="black-input" type="password" placeholder="Password"
                      onblur="remettreNormalement(this)" onclick="changerCouleur(this)" name="Password">
                      <i class="lock icon"></i>

                  </div>
                </div>
                <div class="ui grid">
                  <div class="row"></div>
                  <div class="four column row">
                    <div class="right floated column">

                      <div class="ui right floated medium buttons">

                        <input type="submit" class="ui green button" name="btn-login" value="Connexion" />
</form>
                        <div class="or"></div>
                        <button class="ui grey button"><a href="inscription.php">SignUp</a></button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          <div class="ui horizontal inverted divider divider_clear">
            YouPost
          </div>

          </div>
        </div>
    </div>
  </div>
    <canvas  class="header_background" width="819" height="610" style=" width: 100%; height= 100%;"></canvas>
  </header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.1.0/particles.min.js"></script>
  <script>

      window.onload = function() {
        Particles.init({
          selector: '.header_background',
          color: '#75A5B7',
          maxParticles: 130,
          connectParticles: true,
          responsive: [
            {
              breakpoint: 768,
              options: {
                maxParticles: 80
              }
            }, {
              breakpoint: 375,
              options: {
                maxParticles: 50
              }
            }
          ]
        });
      };

  </script>
</body>
</html>
