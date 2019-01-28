$(document).ready(function() {
  $(".team.active.available").click(function() {
    //Update Input fields
    var teamID = $(this).data("index");
    $("input#pickTeam").val(teamID);

    var teamName =
      "Are you sure you want to pick the <span>" +
      $(this).data("team") +
      "</span>? <button type='submit' id='confirmPick' class='btn btn-success'> Confirm </button>";
    $("#selectedTeam p").html(teamName);
    $(".selected").removeClass("selected");
    $(this).addClass("selected");

    //add blinking image to pick box
    var pickClass = ".picker .pickedTeams ." + $("#pickRound").val();
    var img = $(this)
      .data("team")
      .toLowerCase();
    console.log(img);
    $(pickClass).html('<img class="blinking" src="img/teams/' + img + '.png">');
  });
});
