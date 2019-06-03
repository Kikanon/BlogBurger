<?php
//session_start();
if(!isset($_SESSION["user"])) {
    header('Location: /login.php');
    exit(1);
}

// Proceed
?>