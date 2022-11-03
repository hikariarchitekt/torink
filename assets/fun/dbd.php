<?php

$servername = "eu-cdbr-west-03.cleardb.net";
$dBUsername = "bf94901823e79d";
$dBPassword = "1ea1dacc";
$dBName = "heroku_6f99952be751037";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Błąd servera: ".mysqli_connect_error());
    
}
