<?php 
  include ('db.php');

  if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $sql = "DELETE FROM users WHERE id = {$_GET['id']}"; //Add value 
    if (mysqli_query($conn, $sql)) {
      echo '1';
    } else {
      echo '0';
    }
  }
  else {
    if(sha1($_POST['password']) === $_POST['current_password']){
      $name = $_POST['name'];
      $username = $_POST['username'];
      $dob = $_POST['dob'];
      $gender = ($_POST['gender'] == 'Nam' ? 1 : 0);
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $sql = "UPDATE users SET 
        name = '$name', 
        username = '$username',
        dob = '$dob',
        gender = '$gender',
        phone = '$phone',
        email = '$email',
        address = '$address' WHERE id = {$_POST['id']}";
      if (mysqli_query($conn, $sql)) {
        header("location: ../user_show.php");
      } else {
        echo "
          <script>
          window.alert('Cập nhật không thành công');
          window.history.back()
          </script>
        ";
      }
    }
    else{
      echo "<script>
          window.alert('Sai mật khẩu');
          window.history.back()
          </script>";
    }

  }
  mysqli_close($conn);
?>