<?php  
  session_start();
  $_SESSION['id'] = "";
  $_SESSION['password'] = "";
  session_destroy();
  header('location: ../login.php');
?>