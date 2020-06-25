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
        require "class/publication.php" ;
                //Si l'utilisateur n'est pas connecté on le redirige vers la page de connexion
         if(!$user->is_loggedin()) {
             $user->redirect('login.php');
         }

         $user_id = $_SESSION['user_session'];
         $req = $db_config->prepare("SELECT * FROM user WHERE id=:user_id");
         $req->execute(array(":user_id"=>$user_id));
         $ligne=$req->fetch(PDO::FETCH_ASSOC);
?>
<?php
    $user1 = new publication($db_config)  ;
      if(isset($_POST['share'])){
               $user_id = $_SESSION['user_session'];
               $titre=$_POST['titre'];
               $pub=$_POST['pub'];

              $user1->ajouterPub($user_id,$titre,$pub);
       }

    ?>
    <?php
    require "class/image.php" ;
    $user2 = new image($db_config)  ;
    if(isset($_POST['shareImg'])){
      $image=$_POST['image'];
      $titre=$_POST['titre'];
      $user_id = $_SESSION['user_session'];
      $user2->ajouterImg($user_id,$titre,$image);
    }

    ?>
    <?php
    require "class/comentaire.php" ;
    $user3= new comentaire($db_config)  ;
        if(isset($_POST['commentaire'])){
          $cmt=$_POST['cmt'] ;
          $id_pub=$_POST['id'];
          $user_id = $_SESSION['user_session'];
          $user3->ajouterCmt($id_pub,$user_id,$cmt);
        }

    ?>
    <?php



        if(isset($_POST['commentaireImg'])){
          $cmtImg=$_POST['cmtImg'] ;
          $id_img=$_POST['idImg'];
          $user_id = $_SESSION['user_session'];
          $user3->ajouterCmtImg($user_id,$id_img,$cmtImg);
        }

    ?>
    <?php
        require "class/video.php" ;
        $user4= new video($db_config)  ;
        if(isset($_POST['shareVideo'])){
          $titreV=$_POST['titreVideo'];
          $video=$_POST['video'];
          $user_id = $_SESSION['user_session'];
          $user4->ajouterVideo($user_id,$titreV,$video);
        }
         ?>
        <?php
          if(isset($_POST['comentaireV'])){
            $cmtV=$_POST['cmtV'];
            $idV=$_POST['idV'];
            $user_id = $_SESSION['user_session'];
            $user3->ajouterCmtVideo($user_id,$idV,$cmtV);
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
          <label style="color:#F0F8FF;">Hey!<?php print($ligne['username']); ?></label>
        </a>
      </div>

      <div class="ui pusher" style="padding-top:7%;">
        <div class="ui container">
          <div class="ui grid">
            <div class="four wide column" id="cacher_users" ></br>

  <div class="ui container" style="margin-left:-20% !important;" >
    <div class="ui  segment" style="color:#F0F8FF;background:rgba(0,0,0,.13);">
<?php $user->afficheUser(); ?>
</div>
</div>
</div>


            <!--pour les publications!-->
            <div class="seven wide column" id="pub-col">
              <!--ajout du text-->
              <div class="ui modal"  id="ajout-text" style="width:60%;padding:5px;">
                <h1 class="ui teal header" >
                  Upload some text
                </h1>
                <form method="post" action="home.php" >
                <div class="content" >
                  <div class="ui form">
                    <div class="field">
                      <input type="text" placeholder="titre" name="titre">
                    </div>
          <div class="field">

            <textarea rows="2" placeholder="publication" name="pub"></textarea>
          </div>
          </div>
          </div>

        </br>
          <input type="submit" value="Share" class="ui inverted blue button " name="share" />

        </form>
        <div class="actions">
          <div class="ui deny button" style="background:#97a1aa;">
          <label style="color:white;">Cancel</label>
          </div>
          </div>
          </div>
          <!--ajout d'une photo-->
                   <div class="ui modal"  id="ajout-photo" style="width:60%; ">
                     <h1 class="ui teal header" >
                       Upload a photo
                     </h1>
            <form method="post" action="home.php" >
                     <div class="content" style="padding:20px; ">
                       <div class="ui form">
                         <div class="field">
                           <input type="text" placeholder="titre" name="titre">
                         </div>



                  <!-- <label for="file" class="ui icon button">
                       <i class="image icon"></i>
                       photo</label>
                   <input type="file" id="file"  name="image">-->
                   <div class="required field" >

                     <div class="ui left icon input">
                     <div class="ui action large input" >
                       <input class="photo" id="black-input" type="text" placeholder="Click here"  onblur="remettreNormalement(this)" onclick="changerCouleur(this)" readonly>
                       <input type="file" name="image" >
            <div class="ui icon button"  id="photo">
              <i class="attach icon" ></i>
            </div>
                     </div>

                   </div>
                 </div>

<input type="submit" value="Share" class="ui inverted blue button " name="shareImg" />
               </div>
               </div>
             </br>


             </form>
             <div class="actions">
               <div class="ui deny button" style="background:#97a1aa;">
               <label style="color:white;">Cancel</label>
               </div>
               </div>
               </div>

<!--ajout d'un video-->
      <div class="ui modal"  id="ajout-video" style="width:60%;  ">
             <h1 class="ui teal header" >
               Upload a video
             </h1>
<form method="post" action="home.php">
             <div class="content" style="padding:20px; ">
               <div class="ui form">
                 <div class="field">
                   <input type="text" placeholder="titre" name="titreVideo">
                 </div>
       <div class="field">


          <!-- <label for="file" class="ui icon button">
               <i class="video icon"></i>
               Video</label>
           <input type="file" id="file" style="display:none">-->
           <div class="required field" >

             <div class="ui left icon input">
             <div class="ui action large input" >
               <input class="photo" id="black-input" type="text" placeholder="Click here"  onblur="remettreNormalement(this)" onclick="changerCouleur(this)" readonly>
               <input type="file" name="video" >
    <div class="ui icon button"  id="photo">
      <i class="attach icon" ></i>
    </div>
             </div>

           </div>
         </div>

<input type="submit" value="Share" class="ui inverted blue button " name="shareVideo" />
       </div>
       </div>
       </div>
     </form>


         <div class="actions">
       <div class="ui deny button" style="background:#97a1aa;">
       <label style="color:white;">Cancel</label>
       </div>

       </div>
       </div>


              <div class="ui three item menu">
                <a class="item" id="item-text" data-content="You can add some text !" data-variation="large">
                  <i class="font icon" style="font-size:40px; color:#444;"></i>

                </a>
                <a class="item" id="item-photo" data-content="You can also add a photo !" data-variation="large">
                  <i class="photo icon" style="font-size:40px; color:#d95e40;"></i>
                </a>
                <a class="item" id="item-video" data-content="New ! upload a video" data-variation="large">
                  <i class="video camera icon" style="font-size:40px; color:#748089;"></i>
                </a>
              </div>

            <!--  <div class="ui card" style="width:100%">
                <div class="content">
                  <div class="right floated meta">14h</div>
                  <img class="ui avatar image" src="img/photo1.png"> Elliot
                </div>
              <div class="image">
                <img class="ui image" src="img/photo5.png">
              </div>
            <div class="content">
              <span class="right floated">
                <i class="heart outline like icon"></i>
                17 likes
              </span>
              <i class="comment icon"></i>
                3 comments
            </div>
            <div class="extra content">
              <div class="ui large transparent left icon input">
                <i class="heart outline icon"></i>
                <input type="text" placeholder="Add Comment...">
                <button class="ui button">reply</button>
              </div>
            </div>
        </div>-->

        <?php
        $user4->afficherVideo() ;

         ?>
        <?php $user2->afficherImg(); ?>


      <!--  <div class="ui card" style="width:100%">
          <div class="content">
            <div class="right floated meta">14h</div>
            <img class="ui avatar image" src="img/photo1.png"> Elliot
          </div>
        <div class="segment" style="margin-left:1%;">
          <div class="ui container">
            <p>azasadadzdadladlalzdaldladlazldlazazasadadzdadlazdazdadazd
            adlalzdaldladlazldl
            azsasasasas</p>
          </div>
        </div>
        <div class="content">
          <span class="right floated">
            <i class="heart outline like icon"></i>
            17 likes
          </span>
          <i class="comment icon"></i>
          3 comments
        </div>
        <div class="extra content">
          <div class="ui large transparent left icon input">
            <i class="heart outline icon"></i>
            <input type="text" placeholder="Add Comment...">
            <button class="ui button">reply</button>
          </div>
        </div>
    </div>-->
    <?php

$user1->afficherPub();

    ?>


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
        <?php
            $sql='SELECT * FROM user ' ;
            $req = $db_config->query($sql);
              while ($ligne = $req->fetch()) {
                echo "{ title:'".$ligne['username']."'},";
              }
         ?>
       ];

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
    $('#item-photo').click(function(){
      $('#ajout-photo')
        .modal('show');
    })
    $('#item-video').click(function(){
      $('#ajout-video')
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
