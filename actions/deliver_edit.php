<?php 
  include ('db.php');
  $delivery_id = $_POST['deliver_id-edit'];
  $plan_date = $_POST['plan_date-edit'];
  $progess = $_POST['progess-edit'];
  $sql = "UPDATE delivers SET 
    plan_date = '$plan_date', 
    progess = '$progess'  WHERE id = '$delivery_id'";
  if (mysqli_query($conn, $sql)) {
    echo "1";
  }
  else {
    echo "0";
  }

  
  mysqli_close($conn);
?>