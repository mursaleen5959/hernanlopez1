<?php
session_start();

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "hernan_db";


$conn = new mysqli($serverName,$dBUsername,$dBPassword,$dBName);

?>