<?php
session_start();
unset($_SESSION['session_username']);
unset($_SESSION['mensaje']);
session_destroy();
header("location:login.php");
?>