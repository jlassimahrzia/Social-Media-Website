<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>

    </script>
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
</style>
      <?php
          require "db_config.php";
          require "class/user.php" ;

      function TestInput($ch){
		      $ch=trim($ch);
		      $ch=htmlspecialchars($ch);
		      $ch=stripslashes($ch);

		      return $ch ;
      }

      if(!empty($_POST)){

        $Username=TestInput($_POST['Username'] );
        $Email=TestInput($_POST['Email']);
        $Password=TestInput($_POST['Password']);
        $Password2=TestInput($_POST['Password2']);
        $photo=TestInput($_POST['photo']) ;

        $valide=true ;
        //Username
        if(empty($Username)){
			       $erUsername="You should enter your Username"  ;
             $valide=false ;
		    }
        else if(!preg_match("/^[a-zA-Z]*$/",$Username)){
		        $erUsername="You have to write only alphanbets and spaces ";
            $valide=false ;
        }
        else if (strlen($Username)<=2){
          $erUsername="This Username is too short" ;
          $valide=false ;
        }

        //email
        if(empty($Email)){
			       $erEmail="You should enter your Email"  ;
             $valide=false ;
		    }
        else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
			       $erEmail="It is necessary to respect to the syntax of an email  ----@---.--";
             $valide=false ;
		   }
       if(empty($Password)){
			      $erPassword="You should enter your password"  ;
            $valide=false ;
		        }
	    else if(strlen($Password)<8) {
			      $erPassword="the password must at least 8 characters"  ;
            $valide=false ;
          }
      if(empty($Password2)){
     			      $erPassword2="You should retype your password"  ;
                $valide=false ;
     		        }
     	    else if($Password!=$Password2) {
     			      $erPassword2="the password is uncorrect"  ;
                $valide=false ;
            }

      if(empty($photo)){
      			$erphoto="You should enter your profile picture"  ;
            $valide=false ;
      		}
      else{
      			$tab = explode(".", $photo);
      			if(($tab[1]!="jpg")&&($tab[1]!="png")&&($tab[1]!="jpeg")){
      			$erphoto="It's not a picture"  ;
            $valide=false ;
      			}
      		}

          if($valide){
          		// Il n'y a pas d'erreurs
                	try {
          			// On prépare la requête
          			// ON recherche si l'utilisateur existe déjà dans la base
          			// La recherche se fait par username ou email
                   	$req = $db_config->prepare("SELECT email FROM user WHERE email=:umail");
                  	$req->execute(array(':umail'=>$Email));

          		 	//On récupère le résultat
          		 	$ligne=$req->fetch(PDO::FETCH_ASSOC);

          			//Si l'utilisateur existe on prépare les messages d'erreurs
          	        if($ligne['email']==$Email) {
                      	$erEmail= "Sorry, email already exists";
                        $valide=false ;
                    }

               } catch(PDOException $e) {
          		echo $e->getMessage();
               }
            }
          if($valide){
               $user = new user($db_config)  ;
               $user->ajouterUser($Username,$Email,$Password,$Password2,$photo) ;
             }
    }
      ?>

  </head>
  <body>
  <header class="header" >
    <div class="container_one" >
      <div class="ui modal">
        <h1 class="ui teal header">
          Select a photo
        </h1>
        <div class="image content">
          <div id="desctiption">
            <h2 class="ui grey header">Upload your profile picture</h2>
            <h4>You can upload your profile picture from your device :</h4>
            <div class="ui action large input">
              <input type="text" placeholder="Click here" readonly>
              <input type="file">
              <div class="ui icon button">
                <i class="attach icon"></i>
              </div>
            </div>
            <h4 style="margin-top:20%;">Or just select one of our photos from here <i class="pointing right large icon"></i></h4>
          </div>
          <div class="ui grid">
          <div class="two columns row">
              <div class="right floated column">
                <div class="ui shape">
                  <div class="sides" >
                    <div class="active side">
                      <div class="ui card">
                      <img src="img/photo1.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo2.jpg" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo8.jpg" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo3.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo4.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo5.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo6.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo7.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo9.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                      <div class="ui card">
                      <img src="img/photo10.png" alt="">
                      </div>
                    </div>
                    <div class="side">
                    <div class="ui card">
                    <img src="img/photo3.png" alt="">
                    </div>
                  </div>
                  </div>
              </div>

              <i class="big long arrow left icon" id="flip-left" style="margin-left:50%;"></i>
              <i class="big long arrow right icon" id="flip-right" ></i>
            </div>
        </div>
          <div class="">
          </div>
          </div>
        </div>

        <div class="actions">
          <div class="ui black deny button">
            Cancel
          </div>
          <div class="ui positive right labeled icon button">
            Finish
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>
        <div class="ui three column  centred grid" id=" header_one" >
          <div class="column">
          </div>

          <div class="column ">
          <div class="img-logo">
              <img src="img/logo.png" alt="logo" class="pos-img">
          </div>

            <div class="site-logo" id="titre">
              <label >YouPost</label>
            </div>
            <form action="inscription.php" method="post">
              <div class="register">
                <div class="ui form">
                  <?php
       if(isset($erUsername)){
         echo "<div class='ui pointing below label' id='erreure'>" ;
             echo $erUsername;
           echo "</div>" ;

           echo "<script>" ;
           echo "  $(document).ready(function(){
                  $('.Username').css('border','solid 2px #990000')
                  }); " ;
           echo "</script>" ;
       }
       ?>
                  <div class="required field">
                    <div class="ui left icon input">
                      <input id="black-input" type="text" placeholder="Username"
                      onblur="remettreNormalement(this)" onclick="changerCouleur(this)" name="Username" class="Username" />
                      <i class="user icon"></i>
                    </div>
                  </div>
                  <?php
       if(isset($erEmail)){
         echo "<div class='ui pointing below label' id='erreure'>" ;
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
                      <input id="black-input" type="text" placeholder="Email"
                      onblur="remettreNormalement(this)" onclick="changerCouleur(this)" name="Email" class="Email">
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
                  <div class="required field" >
                    <div class="ui left icon input">
                      <input id="black-input" type="password" placeholder="Password"
                      onblur="remettreNormalement(this)" onclick="changerCouleur(this)" name="Password" class="Password">
                      <i class="lock icon"></i>
                    </div>
                  </div>
                  <?php
       if(isset($erPassword2)){
         echo "<div class='ui pointing below label' id='erreure'>" ;
             echo $erPassword2;
           echo "</div>" ;

           echo "<script>" ;
           echo "  $(document).ready(function(){
                  $('.Password2').css('border','solid 2px #990000')
                  }); " ;
           echo "</script>" ;
       }
       ?>
                  <div class="required field">

                    <div class="ui left icon input">
                      <input id="black-input" type="password" placeholder="Retype password"
                      onblur="remettreNormalement(this)" onclick="changerCouleur(this)" name="Password2" class="Password2">
                      <i class="lock icon"></i>
                    </div>
                    </div>

                    <?php
                    if(isset($erphoto)){
                    echo "<div class='ui pointing below label' id='erreure'>" ;
                    echo $erphoto;
                    echo "</div>" ;

                    echo "<script>" ;
                    echo "  $(document).ready(function(){
                    $('#photo').css('border','solid 2px #990000');
                    $('.photo').css('border','solid 2px #990000');
                    }); " ;
                    echo "</script>" ;
                    }
                    ?>
                    <div class="required field" >

                      <div class="ui left icon input">
                      <div class="ui action large input" >
                        <input class="photo" id="black-input" type="text" placeholder="Click here"  onblur="remettreNormalement(this)" onclick="changerCouleur(this)" readonly>
                        <input type="file" name="photo" >
             <div class="ui icon button"  id="photo">
               <i class="attach icon" ></i>
             </div>
                      </div>

                    </div>
                  </div>
                <div class="ui grid">
                  <div class="row"></div>
                  <div class="four column row">
                    <div class="right floated column">
                      <div class="ui right floated medium buttons">
                        <input type="submit" class="ui grey button signin" value="SignUp" />
                </form>
                        <div class="or"></div>
                        <button class="ui green button photo-choose"><a href="login.php">SignIn</a></button>
                      </div>
                    </div>
                  </div>
                </div>

          <div class="ui horizontal inverted divider divider_clear">
            YouPost
          </div>


</div>
          <!--Div de login est caché il apparait quand on clique sur le bouton SignIn-->

      <!--div du model qui va apparraitre pour choisir la photo de profil -->

          </div>
        </div>
    </div>
  </div>
    <canvas  class="header_background" width="819" height="620" style=" width: 100%; height= 100%;"></canvas>
  </header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.1.0/particles.min.js"></script>
  <script>
      //Script du changement de register à login
      $(document).ready(function(){


        //choisir une photo quand je clique sur Next
      /*  $(".photo-choose").click(function(){
          $('.ui.modal')
            .modal('show');
      });*/
        //script de l'upload d'une photo
        $("input:text").click(function() {
          $(this).parent().find("input:file").click();
        });

        $('input:file', '.ui.action.input')
        .on('change', function(e) {
          var name = e.target.files[0].name;
          $('input:text', $(e.target).parent()).val(name);
        });
        $('#flip-left').click(function(){
          $('.ui.shape').shape('flip left');
        })
        $('#flip-right').click(function(){
          $('.ui.shape').shape('flip right');
        })

      });


      //Script d'annimation background
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
