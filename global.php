<?php 
  session_start();
  if ($_SESSION['id'] ==  "") {
    header("location: login.php");
  }
  else{
    $id = $_SESSION['id'];
    $password = $_SESSION['password'];
    include ("actions/db.php");
    $get_user = mysqli_query($conn, "SELECT * FROM users WHERE id ='$id' AND password = '$password' ");
    $current_user = mysqli_fetch_array($get_user);
  }
?>