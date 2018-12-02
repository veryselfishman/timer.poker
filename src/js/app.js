var timeinterval;
var t = 0;
var interval;
var startingInterval;
var currentTime;
var round = 1;

const blinds = [10, 20, 50, 100, 200, 400, 600, 800, 1000];

startingInterval = "0:30";
interval = startingInterval;

$("#round").text("Round " + round);
$("#blinds").text(blinds[round - 1] + " / " + blinds[round - 1] / 2);
$("#countdown").text(startingInterval);

function togglePause(toPause) {
  if ($("#playPause").hasClass("pause")) {
    timerManager(false);
    $("#playPause")
      .addClass("play")
      .removeClass("pause")
      .text("PLAY");
  } else {
    timerManager(true);
    $("#playPause")
      .addClass("pause")
      .removeClass("play")
      .text("PAUSE");
  }
}

function timerManager(flag) {
  if (flag) {
    timeinterval = setInterval(function() {
      currentTime = interval;
      countdown(currentTime);
    }, 1000);
  } else {
    clearInterval(timeinterval);
  }
}

function countdown(currentTime) {
  var timer = currentTime.split(":");
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10);
  --seconds;
  minutes = seconds < 0 ? --minutes : minutes;
  seconds = seconds < 0 ? 59 : seconds;

  if (minutes === 0 && seconds < 11) {
    $("#countdown").addClass("text-danger");
  }

  seconds = seconds < 10 ? "0" + seconds : seconds;
  //minutes = (minutes < 10) ?  minutes : minutes;
  $("#countdown").html(minutes + ":" + seconds);
  interval = minutes + ":" + seconds;

  if (minutes === 0 && seconds === "00") {
    round++;
    $("#round").text("Round " + round);
    $("#blinds").text(blinds[round - 1] + " / " + blinds[round - 1] / 2);
    $("#countdown").removeClass("text-danger");
    interval = startingInterval;
  }
}

$(document).ready(function() {
  timerManager(true);

  //========================================================================

  //NON TIMER RELATED

  // Navigation
  $(".nav-link").on("click", function(e) {
    e.preventDefault();
    $(".nav-link").removeClass("active");
    $(this).addClass("active");
    // Get section
    let screen = $(this).attr("href");
    $("section").removeClass("active");
    $(screen).addClass("active");
  });
});
