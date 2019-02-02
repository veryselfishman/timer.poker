<?php include 'inc/header.php';
// Include config file
require_once "inc/config.php";

// Check if Game is uploaded
if ($_POST['game']) {
    for($i = 1; $i<=6; $i++) {
        $position = 'pos' . $i;
        $pos[$i] = $_POST[$position];
    }
    $season = 19;
    $host = 2;
    $round = $_POST['round'];
    $game = $_POST['game'];
    $insert = "INSERT INTO games VALUES (NULL, $season, $host, $round, $game, $pos[1], $pos[2], $pos[3], $pos[4], $pos[5], $pos[6])";
    $upload = $mysqli->query($insert);
    header("Location:index.php");
    exit;
} 

// GET game data
$round = 1;
$sql = "SELECT * FROM games WHERE `round` = $round";

$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $games[] = $row;
    }
    // Free result set
    $result->close();
}

$lastGame = end($games);
$thisGame = $lastGame['game'] + 1;
$thisRound = $lastGame['round'];

if ($thisGame == 7) {
    $thisGame = 1; $thisRound++;
}

// GET Users in points order
$sql = "SELECT * FROM users ORDER BY draftorder";

$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $players[] = $row;
    }
    // Free result set
    $result->close();
}




?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>NCPL - Poker Timer</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.min.css">
    </head>

    <body>
        <nav>
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a class="nav-link active" href="#timer">Timer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#table">Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#settings">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sweepstake">sweepstake</a>
                </li>
            </ul>
        </nav>

        <section id="timer" class="fullScreen active">
            <?php include 'inc/timer.php'; ?>
        </section><!-- #timer -->

        <section id="table" class="fullScreen">
            <div class="screenContent">
                <h1 class="display-2">League Table</h1>
            </div><!-- .screenContent -->
        </section>

        <section id="settings" class="fullScreen">
            <div class="screenContent">
                <h1 class="display-2">Settings</h1>
            </div><!-- .screenContent -->
        </section>

        <section id="sweepstake" class="fullScreen">
            <div class="screenContent">
                <h1 class="display-2">Sweepstake</h1>
            </div><!-- .screenContent -->
        </section>

        
        <footer>

        </footer>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>