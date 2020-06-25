<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>
    <script src="script/scriptQueries.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styleAccueil.css">
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
  </head>
  <body >
      <div id="sidebar" class="ui right vertical inverted labeled icon sidebar push menu teal">
          <a class="item"  id="home">
              <i class="home icon" ></i> Home
          </a>
          <div class="" >
              <a class="item" id="profile">
                  <i class="user icon"></i> Profile
              </a>
              <a class="item" id="settings">
                  <i class="setting icon" ></i> Settings
              </a>
              <a class="item">
                  <i class="power icon"></i> Logout
              </a>
          </div>
      </div>
      <div class="ui  icon top fixed menu" id="menu_bor">
        <div  class="ui search" style="width:25%; margin-left:5%;" id="search">
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
          <label style="color:#F0F8FF;">Hey! UserName</label>
        </a>
      </div>

      <div class="ui pusher" style="padding-top:11%;">
        <div class="ui container">


          <div class="ui grid"><!--pour la liste des utilisateurs-->

            <div class="four wide column" id="cacher_users">
              <div class="ui container" style="margin-left:-20% !important;" >
              <div class="ui  segment" style="color:#F0F8FF;background:rgba(0,0,0,.13);">
              <img class="ui circular centered small image" src="img/charapon.jpg">
              <div class="ui divider"></div>
              <div class="ui center aligned header" style="color:#F0F8FF;">achraf maghraoui</div>
            </div>
            </div>
            </div>

            <!--pour les publications!-->
            <div class="seven wide column" id="pub-col">



              <div class="ui card" style="width:100%">
                <div class="content">
                  <div class="right floated meta" data-content="">
                    <button class="ui icon button" id="delete" data-content="delete"  data-position="right center">
                      <i class="remove icon"></i>
                    </button>


                  </div>
                  <img class="ui avatar image" src="img/photo1.png"> Elliot
                </div>
              <div class="image">
                <img class="ui image" src="img/photo5.png">
              </div>
            <div class="content">
              <span class="right floated">
                <i class="heart outline like icon"></i>
                <label id="likes">17</label> likes<!--onclick sur le coeur +1-->
              </span>
              <i class="comment icon"></i>
                3 comments<!--chaque commentaire ajoutée +1-->
            </div>
            <div class="extra content">
              <div class="ui large transparent left icon input">
                <i class="heart outline icon"></i>
                <input type="text" placeholder="Add Comment...">
              </div>
              <button class="ui right floated button" style="background:#529ecc; color:white;">reply</button>
            </div>
        </div>
        <div class="ui card" style="width:100%">
          <div class="content">
            <div class="right floated meta">
              <button class="ui icon button" id="delete_deux" data-content="delete"  data-position="right center">
                <i class="remove icon"></i>
              </button>
            </div>
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
          </div>
          <button class="ui right floated button" style="background:#529ecc; color:white;">reply</button>
        </div>
    </div>
    <div class="ui card" style="width:100%">
      <div class="content">
        <div class="right floated meta">
          <button class="ui icon button" id="delete_trois" data-content="delete"  data-position="right center">
          <i class="remove icon"></i>
        </button></div><!--il faut trouver une fonction qui affiche le temps-->
        <img class="ui avatar image" src="img/photo1.png"> Elliot
      </div>
    <div class="image">
      <img class="ui video" src="">
    </div>
  <div class="content">
    <span class="right floated">
      <i class="heart outline like icon"></i>
      17 likes<!--onclick sur le coeur +1-->
    </span>
    <i class="comment icon"></i>
      3 comments<!--chaque commentaire ajoutée +1-->
  </div>
  <div class="extra content">
    <div class="ui large transparent left icon input">
      <i class="heart outline icon"></i>
      <input type="text" placeholder="Add Comment...">
      </div>
      <button class="ui right floated button" style="background:#529ecc; color:white;">reply</button>

  </div>
</div>
      </div>
      <div class="four wide column">

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
        { title: 'Achraf' },
        { title: 'United Arab Emirates' },
        { title: 'Afghanistan' }];
      $('.ui.search')
        .search({
          source: content
    });
    //script des popup
    $('#delete')
      .popup()
    ;
    $('#delete_deux')
      .popup()
    ;
    $('#delete_trois')
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


      </script>
  </body>
</html>
