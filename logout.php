<?php
require 'config/db.php';
session_start();
/* User login process, checks if user exists and password is correct */
session_destroy();

header("location: login.php");
// Escape email to protect against SQL injections

?>