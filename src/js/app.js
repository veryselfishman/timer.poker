var timeinterval;
var t = 0;

function togglePause(toPause) {
  if ($("#playPause").hasClass("pause")) {
    clearInterval(timeinterval);
    $("#playPause")
      .addClass("play")
      .removeClass("pause")
      .text("PLAY");
  } else {
    var deadline = new Date(Date.parse(new Date()) + t);
    initializeClock("countdown", deadline);
    $("#playPause")
      .addClass("pause")
      .removeClass("play")
      .text("PAUSE");
  }
}

function getTimeRemaining(endtime) {
  t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    total: t,
    days: days,
    hours: hours,
    minutes: minutes,
    seconds: seconds
  };
}

function getTimeRemainingNew(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    total: t,
    days: days,
    hours: hours,
    minutes: minutes,
    seconds: seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);

  var minutesSpan = clock.querySelector(".minutes");
  var secondsSpan = clock.querySelector(".seconds");

  function updateClock() {
    var t = getTimeRemaining(endtime);

    minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
    secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  timeinterval = setInterval(updateClock, 1000);
}

function setClock(hours, minutes) {}

$(document).ready(function() {
  var days = 1;
  var hours = 1;
  var minutes = 0.25;
  var seconds = 1;

  var deadline = new Date(
    Date.parse(new Date()) + days * 60 * minutes * 60 * seconds * 1000
  );

  initializeClock("countdown", deadline);

  /* MY ATTEMPT
  // ================================================================
    // Countdown Timer

  // Timer
  var interval = "10:00";
  var play = false;

  //countdown function
  function countdown(currentTime) {
    console.log(interval);
    var timer = currentTime.split(":");
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);
    --seconds;
    minutes = seconds < 0 ? --minutes : minutes;

    if (minutes < 0) clearInterval(repeat);
    seconds = seconds < 0 ? 59 : seconds;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $("#countdown").html(minutes + ":" + seconds);
    interval = minutes + ":" + seconds;
    console.log(interval);
  }

  $("#playPause").on("click", function() {
    if (play === false) {
      play = true;
      $("#playPause").text("Pause");
      var repeat = setInterval(function() {
        var currentTime = interval;
        countdown(currentTime);
      }, 1000);
    } else {
      console.log("pause!");
      clearInterval(repeat);
    }
  });
    
    MY ATTEMPT */

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
