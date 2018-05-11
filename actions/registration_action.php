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
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmation= $_POST['confirm_password'];

  if($confirmation != $password) {
    echo "<script>goBack('Mật khẩu nhập lại không đúng. Vui lòng nhập lại')</script>";
    return;
  }

  $get_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
  $rows = mysqli_num_rows($get_username);
  if ($rows) {
    echo "<script>goBack('Username đã có người sử dụng. Vui lòng nhập lại')</script>";
    return;
  }

  $get_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
  $rows = mysqli_num_rows($get_email);
  if ($rows) {
    echo "<script>goBack('Email đã có người sử dụng. Vui lòng nhập lại')</script>";
    return;
  }

  $password_digest = sha1($password);
  $name = $first_name . ' ' . $last_name;

  $sql = "INSERT INTO users (username, name, email, password, user_type, avatar) VALUES ('$username','$name', '$email', '$password_digest', '0', './image/user.png')"; //Add value 
  if (mysqli_query($conn, $sql)) { //CHECK QUERY
    session_start();
    $_SESSION['id'] = $conn->insert_id;
    $_SESSION['password'] = $password_digest;
    header("location: ../user_edit.php");
  } else {
    echo "<script>goBack('Có lỗi xảy ra. Vui lòng thử lại')</script>";
  }

  mysqli_close($conn);
?>