<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '1234567';
$db = 'library';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);