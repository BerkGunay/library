<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '123456';
$db = 'library';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);