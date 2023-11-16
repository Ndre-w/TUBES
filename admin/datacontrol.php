<?php

session_start();

if (isset($_SESSION['level'])==1 && isset($_SESSION['level'])==2) {
  header("Location: ../error.php");
  exit();
}

?>