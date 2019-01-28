var players;

$.ajax({
  type: "POST",
  url: "inc/draw.php",
  async: false,
  success: function(result) {
    players = jQuery.parseJSON(result);
  }
});

$(document).ready(function() {
  $("#randomBtn").click(function() {
    var button = $(this);
    generateNumber(0, players);

    /*create random number to define the length of the random number array
    var arrayLength = Math.floor(Math.random() * 20) + 10;
    var randNum;

    for (var i = 0; i < arrayLength; i++) {
      setTimeout(function() {
        randNum = Math.floor(Math.random() * 6);
        $("#nameDisplay").html(players[randNum]["username"]);
        console.log(players[randNum]["username"]);
      }, 1000);
    }
    */
  });

  for (var a = [], i = 0; i < 6; ++i) a[i] = i;

  // http://stackoverflow.com/questions/962802#962890
  function shuffle(array) {
    var tmp,
      current,
      top = array.length;
    if (top)
      while (--top) {
        current = Math.floor(Math.random() * (top + 1));
        tmp = array[current];
        array[current] = array[top];
        array[top] = tmp;
      }
    return array;
  }

  numbers = shuffle(a);

  function generateNumber(index, players) {
    $("#randomBtn").hide();
    var desired = numbers[index];
    var duration = 2000;
    var selected = [];
    var outputDiv = $(".player" + (index + 1)); // Start ID with letter
    var outputName = $(".player" + (index + 1) + " h3"); // Start ID with letter
    var started = new Date().getTime();
    var inputID = $("#player" + (index + 1));

    animationTimer = setInterval(function() {
      if (
        outputDiv.text().trim() === desired ||
        new Date().getTime() - started > duration
      ) {
        clearInterval(animationTimer); // Stop the loop
        $("#nameDisplay")
          .text(players[desired]["username"])
          .addClass("text-warning");
        outputName.text(players[desired]["username"]); // Print desired number in case it stopped at a different one due to duration expiration
        outputDiv.addClass("text-warning");
        inputID.val(desired + 1);
        selected[selected.length] = desired;

        generateNumber(index + 1, players);
      } else {
        randNum = Math.floor(Math.random() * 6);

        $("#nameDisplay")
          .text(players[randNum]["username"])
          .removeClass("text-warning");
      }
    }, 100);

    console.log(index);
    if (index === numbers.length) {
      clearInterval(animationTimer);
      $("#nameDisplay").hide();
      $("#confirmBtn").show();
    }
  }
});
