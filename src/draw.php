<?php 
include_once 'inc/config.php';

//Check if Pick submitted and update database
if($_POST['player1']) {
    //update Users team with pick
    for ($i=1; $i<=6; $i++) {
        $draftOrder[$i] = ($_POST['player' . $i]);
    }

    //clear POST
    $_POST = array();

    $updatesql = "UPDATE users SET draftorder = CASE";
    foreach ($draftOrder as $key => $value) {
        $updatesql .= " WHEN id=" . $value . " THEN " . $key;
    }
    $updatesql .= " END";


    $update = $mysqli->query($updatesql);
    
} 


// GET Users in draft order
$sql = "SELECT id, username, draftorder, pick1, pick2 FROM users ORDER BY draftorder";

$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $draft[] = $row;
    }
    // Free result set
    $result->close();
}
        
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>NCPL - Randomiser</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.min.css">
    </head>

    <body class="randomiser">

        <section class="fullScreen active">
            <div class="screenContent">
                <header>
                    <img id="nflBadge" class="mb-2" src="img/teams/nfl.png" alt="NFL Playoff Sweepstake">
                    <h1>NCPL PlayOff Sweepstake Draftorder Draw</h1>
                </header>

                <div id="pick" class="pt-2 pb-3 mb-4">
                    <h3 id="nameDisplay"></h3>

                    <button id="randomBtn" class="btn btn-large btn-warning">Start Randomiser</button>
                    

                    <form id="selectedTeam" action="#" method="post">
                        <input id="player1" type="hidden" name="player1" value="">
                        <input id="player2" type="hidden" name="player2" value="">
                        <input id="player3" type="hidden" name="player3" value="">
                        <input id="player4" type="hidden" name="player4" value="">
                        <input id="player5" type="hidden" name="player5" value="">
                        <input id="player6" type="hidden" name="player6" value="">
                        
                        <button type="submit" id="confirmBtn" class="btn btn-large btn-success">Confirm Draft Order</button>
                    </form>

                </div>
                <div class="container-fluid">
                <div id="players" class="row">
                    <?php
                    for($i=1; $i<=12; $i++):
                        if ($i == 7 ) {
                            $pNum = 6;
                        } elseif ($i > 7) {
                            --$pNum;
                        } else {
                            $pNum = $i;
                        }

                        
                        if ($draft[$pNum-1]['draftorder']) {
                            $feedback = $draft[$pNum-1]['username'];
                        } else {
                            $feedback = "???";
                        }

                            
                    ?>
                        
                        <div class="player player<?php echo $pNum ?> col-2">
                            <h4><?php echo $i ;?></h4>



                            <h3><?php echo $feedback ?></h3>
   
                            
                            

                        </div>
                         
                    <?php endfor; ?> 
               </div>
               </div>
            </div><!-- .screenContent -->
        </section>

        
        <footer>

        </footer>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/draw.js"></script>
    </body>
</html>