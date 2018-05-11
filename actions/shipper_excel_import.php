<?php
  if(!empty($_FILES['uploaded_file']))
  {
    $path = basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        echo "<h1>Kết quả upload</h1>";
        include('db.php');
        $filename="shipper.csv";
        $file = fopen($path, "r");
        $count = 0;
        $success = 0;
        $failed = 0;
        while (($shipperData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
          $count++;  
          if($count>1){
            $name = $shipperData[0];
            $username = $shipperData[1];
            $dob = $shipperData[2];
            $phone = $shipperData[3];
            $email = $shipperData[4];
            $gender = ($shipperData[5] == 'Nam') ? 1 : 0;
            $address = $shipperData[6];
            $password_digest = sha1($shipperData[7]);

            $get_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            $rows = mysqli_num_rows($get_username);
            if ($rows) {
              echo $username." upload không thành công do username đã có người sử dụng <br>";
              $failed++;
            }
            else {
              $get_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
              $rows = mysqli_num_rows($get_email);
              if ($rows) {
                echo $email." upload không thành công do email đã có người sử dụng <br>";
                $failed++;
              }
              else {
                $sql = "INSERT INTO users (username, name, email, password, user_type, avatar, dob, phone, gender, address) VALUES ('$username','$name', '$email', '$password_digest', '2', './image/user.png', '$dob', '$phone', '$gender', '$address')"; //Add value 
                if (mysqli_query($conn, $sql)) { //CHECK QUERY
                  echo $username." upload thành công!<br>";
                  $success++;
                } else {
                  echo $username." upload không thành công!<br>";
                  $failed++;
                }
              }
            }
          } 
        }
        echo "Tỷ lệ upload thành công: ".$success."/".($success+$failed). "FILES<br>";
        mysqli_close($conn);
    } else{
      echo "Lỗi upload file!<br>";
    }
  }
  else{
    echo "Lỗi upload file!<br>";
  }
  echo '<a href="../manage.php">Quay lại trang chủ</a>';
?>