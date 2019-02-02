
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
                <p id="round">Level 1</p>
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

 <div id="alertBox" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="message"><span id="playerName"></span> is out in <span id="position"></span> place.</p>
                <form action="index.php" method="post">
                    <input id="inputPos6" type="hidden" name="pos6" value="">
                    <input id="inputPos5" type="hidden" name="pos5" value="">
                    <input id="inputPos4" type="hidden" name="pos4" value="">
                    <input id="inputPos3" type="hidden" name="pos3" value="">
                    <input id="inputPos2" type="hidden" name="pos2" value="">
                    <input id="inputPos1" type="hidden" name="pos1" value="">
                    <input id="game" type="hidden" name="game" value="<?php echo $thisGame ?>">
                    <input id="round" type="hidden" name="round" value="<?php echo $thisRound ?>">
                    <button id="confirm" class="btn btn-success" type="button" data-dismiss="modal">Confirm</button>
                    <button id="submit" class="btn btn-success" type="submit">Game Complete</button>
                    <button id="cancel" class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                    
                </form>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->

        <div id="playerSelect" class="d-flex justify-content-between">
            
            <?php

            // Get Player Names<?php

                    foreach($players as $player) :
                        $pName = $player['username'];
                        $pID = $player['id'];        

            ?>

                    <div id="playerFace-<?php echo $pName ?>" class="playerFace pActive" data-id="<?php echo $pID ?>" data-pname="<?php echo $pName ?>" data-toggle="modal" data-target="#alertBox">
                            <h5><?php echo $pName ?></h5>
                        
                        </div><!-- #playerFace -->
                    

            <?php endforeach; ?>
            
        </div>

       

    </div><!-- .container-fluid -->
</div><!-- .screenContent -->