<?php
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
