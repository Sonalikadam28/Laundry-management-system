<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["uname"]) || !isset($_SESSION["role"]) || !isset($_SESSION["email"]) || !isset($_SESSION["aid"])) {
    header("location:../index.php");
}
?>