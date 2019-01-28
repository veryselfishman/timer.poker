<?php
include_once 'config.php';
$sql = "SELECT id, username, draftorder, pick1, pick2 FROM users ORDER BY id";

$result = $mysqli->query($sql);

if($result){
// Cycle through results and build an associative array
while ($row = $result->fetch_array(MYSQLI_BOTH)){
        $players[] = $row;
    }
    // Free result set
    $result->close();
}


echo json_encode($players);


?>