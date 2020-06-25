function mobileViewUpdate () {
  var viewportWidth = $(window).width();
    if (window.matchMedia("(min-width: 600px)").matches==false) {
      $("#carousel").hide();
      $("#toggle").removeAttr("style");
      $("#search").removeAttr("style");
      $(".search.icon").hide();
      $("#cacher_users").hide();
      $("#pub-col").removeClass("seven wide column").addClass("sixteen wide column");
      $(".ui.modal").removeAttr("style");
      $("#settings-col").removeClass("ten wide centered column").addClass("fourteen wide centered column");
      $("#form-col").removeClass("ten wide centered column").addClass("fourteen wide centered column");
    }
    else{
      $("#carousel").show();
      $("#toggle").css("width","15%");
      $("#search").css("width","25%");
      $("#search").css("margin-left","5%")
                  .addClass("ui search");
      $(".search.icon").show();
      $("#cacher_users").show();
      $("#pub-col").removeClass("sixteen wide column").addClass("seven wide column");
      $("ui.modal").css("width","60%");
      $("#settings-col").removeClass("fourteen wide centered column").addClass("ten wide centered column");
        $("#form-col").removeClass("fourteen wide centered column").addClass("ten wide centered column");

    }
  }
  $(window).resize(mobileViewUpdate);
