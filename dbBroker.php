<?php

$host = "localhost";
$db = "fudbalskitimovi";
$username = "Ognjen";
$password = "NekaSifra123";

$conn = new mysqli($host, $username, $password, $db);

if($conn->connect_errno){
    exit("Konekcija neuspesna: " . $conn->connect_errno);
}

?>