<?php include 'inc/header.php'; ?>

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
            <div class="screenContent">
                <h1 class="display-3">Poker Timer</h1>
                <div class="container-fluid">

                    <div class="row">

                        <div class="col">
                            <div id="bigBlind">
                                <img class="blinds" src="img/chip-10.png">
                            </div>
                        </div><!-- .col -->

                        <div class="col-xs-12 col-sm-6">

                            <span id="countdown" class="display-1">10:00
                            </span>
                            <p id="round">Round 1</p>
                            <p id="blinds"></p>

                            <div id="timerControls">
                                <button id="back" class="btn btn-large btn-outline-primary" onclick="timerCtl('back')"><<</button>
                                <button id="playPause" class="btn btn-large btn-outline-primary play" onclick="togglePause()">Play</button>
                                <button id="reset" class="btn btn-large btn-outline-secondary" onclick="initialiseTimer()">Reset</button>
                                <button id="forward" class="btn btn-large btn-outline-primary" onclick="timerCtl('fwd')">>></button>
                            </div>
                        </div><!-- .col -->

                        <div class="col">
                            <div id="smallBlind">
                                <img class="blinds" src="img/chip-5.png">
                            </div>
                        </div><!-- .col -->

                    </div><!-- .row -->

                </div><!-- .container-fluid -->
            </div><!-- .screenContent -->
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