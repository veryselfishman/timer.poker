<?php 
include 'inc/header.php';
include_once 'inc/config.php';

//Check if Pick submitted and update database
if($_POST['teamID']) {
    //update Users team with pick
    $col = $_POST['round'];
    $id = $_POST['playerID'];
    $teamID = $_POST['teamID'];
    //clear POST
    $_POST = array();

    $sql = "UPDATE users SET $col = $teamID WHERE id = $id";
    $update = $mysqli->query($sql);
    
} 


$pickStatus = false;

// GET Users in draft order
$sql = "SELECT id, username, draftorder, pick1, pick2 FROM users ORDER BY draftorder";

$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $players[] = $row;
    }
    // Free result set
    $result->close();
}
// Check Who's turn it is to pick by grabbing the first player who doesn't have a pick associated with them
function getPicker($array, $pick) {
    foreach ($array as $key => $val) {
        if (!$val[$pick]) {
            $picker['player'] = $key;
            $picker['round'] = $pick;
            return $picker;
            break;
        }
    }
}

$picker = getPicker($players, 'pick1');
if (!$picker) {
    // reverse array to reverse draft order in 2nd round (preserve keys)
    $playersRev = array_reverse($players, TRUE); 
    $picker = getPicker($playersRev, 'pick2');
}

// Check if YOU are the picker
if($picker) {
    if ($players[$picker['player']]['id'] == $_SESSION['id']) {
        $pickStatus = true;
        $round = $picker['round'];
    }
}




//Get Teams
$sql = "SELECT teams.*, users.username, users.pick1, users.pick2, users.id AS 'userid'
FROM teams LEFT JOIN users
ON teams.id = users.pick1 OR teams.id = users.pick2
ORDER BY teams.seeding";
$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $teams[] = $row;
    }
    // Free result set
    $result->close();
} else {
    $feedback = 'ERROR';
}


        
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>NCPL - PlayOff Sweepstake</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.min.css">
    </head>

    <body class="sweepstake">
        <header id="headerInfo">
            <span>Logged In: <?php echo $_SESSION["username"] ?> | <?php if ($round) { echo $round . ' | '; } ?></span>
            
            <a href="logout.php" class="btn btn-danger">Log Out</a>
        </header>
        <section id="sweepstake" class="fullScreen active">
            <div class="screenContent">
                <header>
                    <h1>NCPL PlayOff Sweepstake</h1>
                </header>

                <div id="roster" class="container-fluid">
                    <div id="teams" class="col d-flex flex-wrap mb-3">
                        <?php
                            foreach( $teams as $team ) {
                                $teamClass = !$team['userid'] ? 'team flex-fill available' : 'team flex-fill';
                                if ($pickStatus) { $teamClass .= ' active'; }
                                echo '<div class="' . $teamClass . '" data-league="afc" data-index="' . $team['id'] . '" data-team="' . $team['teamname'] . '">';
                                echo '<img src="img/teams/' . strtolower($team['teamname']) . '.png">';
                                echo '<h1>' . $team['teamname'] . '</h1>';
                                echo '<ul><li>' . $team['record'] . '</li><li>' . $team['league'] . '</li><li>' . $team['info'] . '</li></ul>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div><!-- #roster -->
                <div id="pick" class="pt-3 pb-3 mb-3">
                    <h3>
                    <?php
                    if ($picker) {
                        $pickMessage = $pickStatus ? 'Pick a team <span>' . ucfirst($_SESSION['username']) .'</span>' : 'Waiting for <span>' . $players[$picker['player']]['username'] . '</span> to pick';
                    } else {
                        $pickMessage = 'Draft Complete';
                    }
                    
                    echo $pickMessage;
                    ?>
                    </h3>
                    <?php if ($pickStatus) : ?>
                        <form id="selectedTeam" action="#" method="post">
                            <p>. . .</p>
                            <input id="pickTeam" type="hidden" name="teamID" value="">
                            <input id="pickPlayer" type="hidden" name="playerID" value="<?php echo $_SESSION['id'] ?>">
                            <input id="pickRound" type="hidden" name="round" value="<?php echo $round ?>">
                            
                        </form>
                    <?php endif; ?>
                </div>

                <div id="players" class="d-flex">
                    <?php

                    foreach($players as $player) :
                        $pName = $player['username'];
                        $pick1 = $player['pick1'];
                        $pick2 = $player['pick2'];
                    
                        
                        $pClass = $pName == $players[$picker['player']]['username'] ? 'player picker ' : 'player';
                    
                    ?>

                        <div class="<?php echo $pClass ;?>">
                            <h3><?php echo $pName ;?></h3>

                            <div class="pickedTeams">
                                <div class="pick1">
                                    <?php 
                                    if ($pick1) {
                                        $pickedTeam = array_search($pick1, array_column($teams, 'id'));
                                        $pTeamClass = (!$teams[$pickedTeam]['active']) ? "eliminated" : "";
                                        
                                        echo '<img class="' . $pTeamClass . '" src="img/teams/' . strtolower($teams[$pickedTeam]['teamname']) . '.png">';
                                    } else {
                                        echo '<img class="noPick" src="img/teams/nfl.png">';
                                    }

                                    ?>

                                </div>
                                <div class="pick2">
                                    <?php 
                                    if ($pick2) {
                                        $pickedTeam = array_search($pick2, array_column($teams, 'id'));
                                        $pTeamClass = (!$teams[$pickedTeam]['active']) ? "eliminated" : "";

                                        echo '<img class="' . $pTeamClass . '" src="img/teams/' . strtolower($teams[$pickedTeam]['teamname']) . '.png">';
                                    } else {
                                        echo '<img class="noPick" src="img/teams/nfl.png">';
                                    }

                                    ?>
                                </div>
                            </div>

                        </div>
                         
                    <?php endforeach; ?> 
               </div>
            </div><!-- .screenContent -->
        </section>

        
        <footer>

        </footer>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/sweepstake.js"></script>
    </body>
</html>