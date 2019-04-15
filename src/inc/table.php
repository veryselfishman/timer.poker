<?php 
// get positions only
$sql = "SELECT pos1, pos2, pos3, pos4, pos5, pos6 FROM games WHERE `round` = $prevRound";

$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $positions[] = $row;
    }
    // Free result set
    $result->close();
}

?>



<div class="screenContent">
    <h1 class="display-2">League Table</h1>

    <h2>Round: <?php echo $prevRound ?> | Game: <?php echo $thisGame;?></h2>

    <table id="gameGrid" class="table table-dark">
        <thead>
            <tr>
                <th>Player</th>
                <th>Pts cfwd</th>
                <th>Game 1</th>
                <th>Game 2</th>
                <th>Game 3</th>
                <th>Game 4</th>
                <th>Game 5</th>
                <th>Game 6</th>
                <th>Pts Round</th>
                <th id="totalPoints">TOTAL</th>
            </tr>
        </thead>

        <tbody>

        <!-- Player / Game Loop -->
        <?php

        //Sort $players array in order Points total
        $leaguePlayers = $players;
    function build_sorter($key) {
            return function ($a, $b) use ($key) {
                return strnatcmp($b[$key], $a[$key]);
            };
        }

        usort($leaguePlayers, build_sorter('points'));


        //LOOP

        foreach($leaguePlayers as $lPlayer) :
            $name = $lPlayer['username'];
            if ( $thisGame > 1 ) {
                $startPts = $lPlayer['points'];
            } else {
                $startPts = 0;
            }
            
            $runningPts = 0;
            $id = $lPlayer['id'];

            //Check Games
            $i = 0;
            foreach($positions AS $position) {
                $pos[$i] = array_search($id, $position);
                $i ++;
            }

        ?>
            <tr class="sortable">
                <td><?php echo $name ?></td>
                <td><?php echo $startPts ?></td>
                <?php
                for($i=1; $i<=6; $i++) {
                    $points = 0;
                    $place = $prevGame >= $i ? $pos[$i-1] + 1 : '-';
                    if ($place == 3) { $points = 5;  }
                    if ($place == 2) { $points = 10; }
                    if ($place == 1) { $points = 20; }
                    if ($place > 3 ){ $points = 0; }
                    $runningPts = $runningPts + $points;
                    $totalPts = $startPts + $runningPts;
                    echo '<td>' . $place . ' / ' . $points . '</td>';
                }
                ?>
                <td><?php echo $runningPts ?></td>
                <td class="totPts"><?php echo $totalPts ?></td>
            </tr>
        <?php

        endforeach;
        ?>

        </tbody>


    </table>

</div><!-- .screenContent -->