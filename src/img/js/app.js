var timeinterval;
var interval;
var startingInterval;
var currentTime;
var round = 1;
const blinds = [10, 20, 50, 100, 200, 400, 800, 1600];
var smallBlind = blinds[0] / 2;
var bigBlind = blinds[0];

startingInterval = "10:00";

function initialiseTimer(r) {
  timerManager(false);
  if (r) {
    round = r;
  } else {
    round = 1;
  }
  interval = startingInterval;

  $("#countdown").text(startingInterval);
  setBlinds();
  // change playPause button to play
  toggleBtn("play");
}

function setBlinds() {
  $("#round").text("Round " + round);

  bigBlind = blinds[round - 1];
  smallBlind = bigBlind / 2;
  $("#blinds").text(bigBlind + " / " + smallBlind);
  $("#smallBlind img").attr("src", "img/chip-" + smallBlind + ".png");
  $("#bigBlind img").attr("src", "img/chip-" + bigBlind + ".png");
  $("#countdown").removeClass("text-danger");
}

function togglePause() {
  if ($("#playPause").hasClass("pause")) {
    timerManager(false);
    toggleBtn("play");
  } else {
    timerManager(true);
    toggleBtn("pause");
  }
}

function toggleBtn(status) {
  if (status === "play") {
    $("#playPause")
      .addClass("play")
      .removeClass("pause")
      .text("PLAY");
  } else {
    $("#playPause")
      .addClass("pause")
      .removeClass("play")
      .text("PAUSE");
  }
}

function timerCtl(action) {
  timerManager(false);
  if (action == "back") {
    round--;
  } else {
    if (round < blinds.length) {
      round++;
    }
  }
  interval = startingInterval;
  initialiseTimer(round);
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
    if (round > blinds.length) {
      timerManager(false);
    }
    setBlinds();
    interval = startingInterval;
  }
}

$(document).ready(function() {
  initialiseTimer();

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
