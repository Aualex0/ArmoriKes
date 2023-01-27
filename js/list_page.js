(function ($, window) {
  var switchCurrent = function (that, newEl) {
    // remove all the class current
    $(".current").removeClass("current");

    $(that).addClass("current");
    $(".view").eq(newEl).addClass("current");
    curIndex = newEl;
  };

  var height = $("body").height(),
    width = $("body").width(),
    $sliderContainer = $(".content"),
    $slideContainer = $(".view"),
    $nav = $("nav"),
    $list = $("li"),
    current = "current",
    // to keep a live nodeList, jQuery object is static
    elCurrent = document.getElementsByClassName(current),
    curIndex = 0;

  // set the class current to the first
  if (!$sliderContainer.find(elCurrent).length) {
    $sliderContainer.find($slideContainer).eq(0).addClass(current);
  }
  if (!$nav.find(elCurrent).length) {
    $nav.find($list).eq(0).addClass(current);
  }
  $("#prevButton").css("display", "none");

  timeBetweenScroll = 800;

  // mousewheel event

  document.addEventListener(
    "wheel",
    function (event) {
      //bind mousewheel after a certain time
      var dir = event.deltaY < 0 ? "UP" : "DOWN";

      // bool
      (isLastLi = curIndex == 7), (isFirstLi = curIndex == 0);

      var indexNew;
      if (dir == "UP") {
        pos = isFirstLi ? (indexNew = curIndex) : (indexNew = curIndex - 1);
      } else if (dir == "DOWN") {
        pos = isLastLi ? (indexNew = curIndex) : (indexNew = curIndex + 1);
      }
      updateView($list.eq(indexNew), indexNew);

      // unbind the mousewheel event to avoid multiple slide at once
      $(window).off("scroll");

      // avoid propagation and default behavior
      return false;
    },
    { passive: "true" }
  );

  // Buttons
  $("#nextButton").on("click", function () {
    var indexNew = curIndex + 1;
    updateView($list.eq(indexNew), indexNew);
  });

  $("#prevButton").on("click", function () {
    var indexNew = curIndex - 1;
    updateView($list.eq(indexNew), indexNew);
  });

  // Click event
  $("nav").on("click", "li", function () {
    var indexNew = $(this).index();
    updateView($list.eq(indexNew), indexNew);
  });

  // Swipe event
  let touchstartY = 0;
  let touchendY = 0;

  function checkDirection() {
    // bool
    (isLastLi = curIndex == 7), (isFirstLi = curIndex == 0);
    if (touchendY < touchstartY)
      pos = isLastLi ? (indexNew = curIndex) : (indexNew = curIndex + 1);
    if (touchendY > touchstartY)
      pos = isFirstLi ? (indexNew = curIndex) : (indexNew = curIndex - 1);
    updateView($list.eq(indexNew), indexNew);
  }

  document.addEventListener("touchstart", (e) => {
    touchstartY = e.changedTouches[0].screenY;
  });

  document.addEventListener("touchend", (e) => {
    touchendY = e.changedTouches[0].screenY;
    if (touchstartY != touchendY) {
      checkDirection();
    }
  });

  function updateView(that, indexNew) {
    // switch the current
    switchCurrent(that, indexNew);

    // move to the current slide
    $sliderContainer.css("bottom", indexNew * height);

    //show or hide arrows
    if (curIndex == 0) {
      $("#prevButton").css("display", "none");
    } else {
      $("#prevButton").css("display", "initial");
    }
    if (curIndex == 7) {
      $("#nextButton").css("display", "none");
    } else {
      $("#nextButton").css("display", "initial");
    }
  }

  // redefine the height and width when resizing
  $(window).on("resize", function () {
    height = $("body").height();
    width = $("body").width();
    $sliderContainer.css(
      "bottom",
      $(elCurrent).closest($slideContainer).index() * height
    );
  });
})(jQuery, window);

//MàJ des boutons Next&Prev
