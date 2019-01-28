<?php

        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users";
        
        $userlist = $mysqli->query($sql);

?>