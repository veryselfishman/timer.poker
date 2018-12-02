<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>NCPL - Poker Timer</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic">
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
            </ul>
        </nav>

        <section id="timer" class="fullScreen active">
            <div class="screenContent">
                <h1 class="display-1">Poker Timer</h1>
                <span id="countdown" class="display-1">0:00
                   </span>
                   <p id="round">Round 1</p>
                   <p id="blinds"></p>

                <div id="timerControls">
                    <button id="playPause" class="btn btn-large btn-outline-primary pause" onclick="togglePause(1)">Pause</button>
                </div>
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

        
        <footer>

        </footer>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>