<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "torinkdb";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Błąd servera: ".mysqli_connect_error());
    
}
