

<?php
session_start();

foreach($_SESSION as $key => $value) {
  $_SESSION[$key] = null;
}

session_destroy();

header("Location:index.php");
?>

