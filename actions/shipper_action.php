<?php
  include ('db.php'); 
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $gender = ($_POST['gender'] == 'Nam') ? 1 : 0;
  $password = $_POST['password'];

  $get_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
  $rows = mysqli_num_rows($get_username);
  if ($rows) {
    echo "2";
    return;
  }

  $get_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
  $rows = mysqli_num_rows($get_email);
  if ($rows) {
    echo "3";
    return;
  }

  $password_digest = sha1($password);

  $sql = "INSERT INTO users (username, name, email, password, user_type, avatar, dob, phone, gender, address) VALUES ('$username','$name', '$email', '$password_digest', '2', './image/user.png', '$dob', '$phone', '$gender', '$address')"; //Add value 
  if (mysqli_query($conn, $sql)) { //CHECK QUERY
    $get_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
    $user = mysqli_fetch_array($get_user);
    echo '
    <tr id="row-user-id-'.$user['id'].'">
    <td>'.$user['id'].'</td>
    <td><a href="user_show.php?user_id='.$user['id'].'"><img src="'.$user['avatar'].'" class="avatar" alt="Avatar"> '.$user['name'].'</a></td>
    <td>'.$user['username'].'</td>                        
    <td>'.$user['email'].'</td>
    <td>
      '.
        (
          ($user['user_type'] == 1) ? 'Admin' 
            : (($user['user_type'] == 2) ? 'Shipper' : 'User')
        )
      .'
    </td>
    <td>
      <a href="#" class="delete" title="Xóa" data-toggle="tooltip" onclick="deleteUser('.$user['id'].');"><i class="fa fa-trash-o"></i></a>
    </td>
  </tr>';
  } else {
    echo "0";
  }

  mysqli_close($conn);
?>