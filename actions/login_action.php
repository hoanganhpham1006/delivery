<script>
function goBack(msg = '') {
    if (msg != '') {
      window.alert(msg);
    }
    window.history.back()
}
</script>

<?php
  include ('db.php'); 
  $username = $_POST['username'];
  $password = sha1($_POST['password']);

  $get_user = mysqli_query($conn, "SELECT * FROM users WHERE (username = '$username' OR email = '$username') 
    AND password='$password'");
  $rows = mysqli_num_rows($get_user);
  if ($rows) {
    session_start();
    $current_user = mysqli_fetch_array($get_user);
    $_SESSION['id'] = $current_user['id'];
    $_SESSION['password'] = $current_user['password'];
    header("location: ../index.php");
    return;   
  }

  else {
    echo "<script>goBack('Tài khoản hoặc mật khẩu không đúng!')</script>";
    return; 
  }

  mysqli_close($conn);
?>