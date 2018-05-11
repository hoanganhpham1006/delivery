<?php 
  include ('db.php');

  if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $sql = "DELETE FROM delivers WHERE id = {$_GET['id']}"; //Add value 
    if (mysqli_query($conn, $sql)) {
      echo '1';
    } else {
      echo '0';
    }
  }
  else {
      $sender = $_POST['sender'];
      $receiver = $_POST['receiver'];
      $number_packages = $_POST['number_packages'];
      $weight = $_POST['weight'];
      $distance = $_POST['distance'];
      $type = $_POST['type'];
      $shipper_id = $_POST['shipper'];
      $sql = "INSERT INTO delivers (sender, receiver, weight, number_packages, shipper_id, distance, progess, type) VALUES ('$sender','$receiver',  '$weight', '$number_packages', '$shipper_id', '$distance', '0', '$type')";
      if (mysqli_query($conn, $sql)) { //CHECK QUERY
        echo '
        <tr id="row-deliver-id-'.$conn->insert_id.'">
        <td>'.$conn->insert_id.'</td>
        <td>'.$sender.'</td>                        
        <td>'.$receiver.'</td>
        <td></td>
        <td><span class="badge badge-warning">Chờ xử lý</span></td>
        <td><a href="user_show.php?user_id='.$shipper_id.'">'.$shipper_id.'</a></td>
        <td>
          <a href="#" class="delete" title="Xóa" data-toggle="tooltip" onclick="deleteDeliver('.$conn->insert_id.');"><i class="fa fa-trash-o"></i></a>
          <a data-toggle="modal" data-target="#EditModal" href="#" class="edit" title="Sửa" data-toggle="tooltip" onclick="editDeliver('.$conn->insert_id.');"><i class="fa fa-pencil"></i></a>
        </td>
      </tr>';
      } else {
        echo "0";
      }
  }
  mysqli_close($conn);
?>