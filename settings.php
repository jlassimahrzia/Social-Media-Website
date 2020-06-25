<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>
    <link rel="stylesheet" href="css/styleAccueil.css">
    <script src="script/scriptQueries.js"></script>
    <?php
        require "db_config.php";
        require "class/user.php" ;
        $user = new user($db_config)  ;
        $user_id = $_SESSION['user_session'];
        $req = $db_config->prepare("SELECT * FROM user WHERE id=:user_id");
        $req->execute(array(":user_id"=>$user_id));
        $ligne=$req->fetch(PDO::FETCH_ASSOC);

    ?>
    <?php
    function TestInput($ch){
        $ch=trim($ch);
        $ch=htmlspecialchars($ch);
        $ch=stripslashes($ch);

        return $ch ;
    }

        if(isset($_POST['change'])){
          $newEmail=TestInput($_POST['newEmail']);
          $newUsername=TestInput($_POST['newUsername']);
          $newImage=TestInput($_POST['newImage'] );
          $oldPwd=TestInput($_POST['oldPwd']);
          $newPwd=TestInput($_POST['newPwd']);
          $newPwd2=TestInput($_POST['newPwd2']);
          $valide=true ;
          $validePass=false;
          if( ( (!empty($newUsername)) && (!preg_match("/^[a-zA-Z]*$/",$newUsername) ) ) ){
  		        $erUsername="You have to write only alphanbets and spaces ";
              $valide=false ;
          }
          else if ((!empty($newUsername)) && (strlen($newUsername)<=2)){
            $erUsername="This Username is too short" ;
            $valide=false ;
          }
          if((!empty($newEmail)) &&(!filter_var($newEmail,FILTER_VALIDATE_EMAIL))){
  			       $erEmail="It is necessary to respect to the syntax of an email  ----@---.--";
               $valide=false ;
  		   }
         if((!empty($newPwd)) &&(strlen($Password)<8)) {
   			      $erPassword="the password must at least 8 characters"  ;
               $valide=false ;
          }
          if(!empty($newImage)){
          			$tab = explode(".", $newImage);
          			if(($tab[1]!="jpg")&&($tab[1]!="png")&&($tab[1]!="jpeg")){
          			$erphoto="It's not a picture"  ;
                $valide=false ;
          			}
          		}
          if(!empty($newEmail)){
            $db_config->exec(" UPDATE user SET email='$newEmail' WHERE id='$user_id' ");
          }
          if(!empty($newUsername)){
            $db_config->exec(" UPDATE user SET username='$newUsername' WHERE id='$user_id' ");
          }
          if(!empty($newImage)){
            $db_config->exec(" UPDATE user SET photo='$newImage' WHERE id='$user_id' ");
          }
          if((!empty($oldPwd))&&(!empty($newPwd))&&(!empty($newPwd2))){
            $req = $db_config->prepare("SELECT password FROM user WHERE password=:upass  ");
            $req->execute(array(':upass'=>$oldPwd));
            //On récupère le résultat
            $ligne=$req->fetch(PDO::FETCH_ASSOC);
            if($ligne['password']==$oldPwd) {
              $validePass=true;
              if($newPwd==$newPwd2){
                $db_config->exec(" UPDATE user SET password='$newPwd', password2='$newPwd' WHERE id='$user_id' ");
              }
              else{
                $erPassword2="the password is uncorrect " ;
              }
            }
            else{
              $eroldPassword="the password is uncorrect";
            }
          }

        }

    ?>
    <?php
      if(isset($_POST['supprime'])){

        $user10 = new user($db_config)  ;


          $user10->supprime($user_id);
          //Puis on le redirige vers la page de connexion
          $user10->redirect('login.php');

      }
    ?>
  </head>
  <body style="background:#36465d">
      <div id="sidebar" class="ui right vertical inverted labeled icon sidebar push menu teal">
          <a class="item"  id="home" href="home.php">
              <i class="home icon"></i> Home
          </a>
          <div class="" >
              <a class="item" id="profile" href="profil.php">
                  <i class="user icon"></i> Profile
              </a>
              <a class="item" id="settings" href="settings.php">
                  <i class="setting icon" ></i> Settings
              </a>
              <a class="item" href="logout.php">
                  <i class="power icon"></i> Logout
              </a>
          </div>
      </div>
      <div class="ui  icon top fixed menu" style="height:7%;background:#36465d;" id="menu_bor">
        <div  class="ui search" style="width:25%; margin-left:5%;" id="search"
        >
            <div class="ui transparent huge icon input">

              <input class="prompt"  placeholder="Search ..." >
              <i class="search icon" ></i>
            </div>
            <div class="results"></div>
          </div>
          <div id="carousel">
            <div class="btn-bar">
              <div id="buttons"><a id="prev" href="#"></a><a id="next" href="#"></a> </div></div>
              <div id="slides">
                  <ul>
                      <li class="slide">
                          <div class="quoteContainer">
                              <p class="quote-phrase">
                                <span > YouPost is a free popular social media</span>

                              </p>
                          </div>

                      </li>
                      <li class="slide">
                          <div class="quoteContainer">
                              <p class="quote-phrase">
                                <span >It allows users to upload text, photos and videos</span>
                              </p>
                          </div>

                      </li>
                      <li class="slide">
                              <p class="quote-phrase">
                                <span>It is simple and very easy to use</span>
                              </p>
                          </div>
                      </li>
                  </ul>
              </div>
        </a>
        <a class="item floated right" style="width:15%;" id="toggle">
          <i class="user icon" style="color:white; font-size:20px;"></i>
          <label style="color:#F0F8FF;">Hey! <?php print($ligne['username']); ?></label>
        </a>
      </div>

      <div class="ui pusher" style="padding-top:9%;">
        <div class="ui container">
          <div class="ui grid">
            <div class="ten wide centered column" id="settings-col">
              <div class="ui segment">
                <div class="header" style="height:5%;">
                  <h1 class="ui teal header">Settings</h1>
                </div>
                <div class="ui clearing divider"></div>
        <form method="post" action="settings.php">
                <div class="ui container">
                <div class="ui grid">
                  <div class="ten wide centered column" id="form-col">
                    <div class="ui form">

                      <label class="ui grey header">Email</label>
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
                      <div class="field">
                        <input type="text" placeholder='<?php print($ligne["email"])?>' name="newEmail" class="Email">
                      </div>

                        <div style="padding-bottom:30px;">
                    <label class="ui grey header">Username</label>
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
                    <div class="field">
                      <input type="text" placeholder='<?php print($ligne["username"]) ?>' name="newUsername" class="Username">
                    </div>
                    </div>
                    <label class="ui grey header">Change Photo De Profil</label>
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
                    <div class="field">

                      <div class="ui left icon input">
                      <div class="ui action large input" >
                        <input class="photo" id="black-input" type="text" placeholder="Click here"  onblur="remettreNormalement(this)" onclick="changerCouleur(this)" readonly>
                        <input type="file" name="newImage" >
             <div class="ui icon button"  id="photo">
               <i class="attach icon" ></i>
             </div>
                      </div>

                    </div>
                    </div>
                  <label class="ui grey header">Change your password</label>
                  <?php
                if(isset($eroldPassword)){
                echo "<div class='ui pointing below label' id='erreure'>" ;
                echo $eroldPassword ;
                echo "</div>" ;

                echo "<script>" ;
                echo "  $(document).ready(function(){
                  $('.oldpwd').css('border','solid 2px #990000')
                  }); " ;
                echo "</script>" ;
                }
                ?>
                  <div class="field">
                    <input type="password" placeholder="Type current password" name="oldPwd" class="oldpwd">
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
                  <div class="field">

                    <input type="password" placeholder="Type a new password " name="newPwd" class="Password">
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
                  <div class="field">
                    <input type="password" placeholder="Retype new password" name="newPwd2">
                  </div>

                  <input type="submit" value="Finish" class="ui inverted blue button " name="change" />
                </div>
                </div>
              </div></form>
              <form method="post" action="settings.php">
                <div class="ui grid">
                  <div class="ten wide centered column">

                    <button type="submit" class="ui wide button"  name="supprime">
                      disable your account
                  </button>
                </div>
              </form>
            </div>


    </div>
    </div>
    </div>
  </div>
</div>

      <script>
      $('#toggle').click(function(){
        $('.ui.sidebar').sidebar('toggle');
      })
      //script de la recherche : la variable content va contenir les #tags à chaque fois qu'on ajoute une fonction
      var content = [
        { title: 'Andorra' },
        { title: 'United Arab Emirates' },
        { title: 'Afghanistan' }];
      $('.ui.search')
        .search({
          source: content
    });
    //script des popup
    $('#item-text')
      .popup()
    ;
    $('#item-photo')
      .popup()
    ;
    $('#item-video')
      .popup()
    ;
    $(document).ready(function () {
  //rotation speed and timer
  var speed = 3000;

  var run = setInterval(rotate, speed);
  var slides = $('.slide');
  var container = $('#slides ul');
  var elm = container.find(':first-child').prop("tagName");
  var item_width = container.width();
  var previous = 'prev'; //id of previous button
  var next = 'next'; //id of next button
  slides.width(item_width); //set the slides to the correct pixel width
  container.parent().width(item_width);
  container.width(slides.length * item_width); //set the slides container to the correct total width
  container.find(elm + ':first').before(container.find(elm + ':last'));
  resetSlides();


  //if user clicked on prev button

  $('#buttons a').click(function (e) {
      //slide the item

      if (container.is(':animated')) {
          return false;
      }
      if (e.target.id == previous) {
          container.stop().animate({
              'left': 0
          }, 1500, function () {
              container.find(elm + ':first').before(container.find(elm + ':last'));
              resetSlides();
          });
      }

      if (e.target.id == next) {
          container.stop().animate({
              'left': item_width * -2
          }, 1500, function () {
              container.find(elm + ':last').after(container.find(elm + ':first'));
              resetSlides();
          });
      }

      //cancel the link behavior
      return false;

  });

  //if mouse hover, pause the auto rotation, otherwise rotate it
  container.parent().mouseenter(function () {
      clearInterval(run);
  }).mouseleave(function () {
      run = setInterval(rotate, speed);
  });


  function resetSlides() {
      //and adjust the container so current is in the frame
      container.css({
          'left': -1 * item_width
      });
  }

});
//a simple function to click next link
//a timer will call this function, and the rotation will begin

function rotate() {
  $('#next').click();
}
    //fonction des models exmple: quand je click sur home,settings...

    $('#item-text').click(function(){
      $('#ajout-text')
        .modal('show');
    })


      </script>
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
</script>
  </body>
</html>
