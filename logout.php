<?php
session_start();
unset($_SESSION['useremail']);
header("Location:login.php");
?>
