<!DOCTYPE html>
<html lang="vi">
<?php include './app.php';?>
<head>
    <title>Giao hàng 247 | Quản lý người dùng</title>
    <link rel="stylesheet" type="text/css" href="./css/manage.css">
</head>
<body>
  <?php
    include 'global.php'; 
    include './layout/header.php';
  ?>
  <div class="list_users">
    <h2 style="text-align: center;">Bảng tin quản lý đơn hàng</h2>
    <div class="container">
      <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-4">
            <h2>Danh sách đơn hàng</h2>
          </div>
          <div class="col-sm-6">
            <?php
              if ($current_user['user_type'] == 1)
                echo '            
            <a href="#" data-toggle="modal" data-target="#AddModal" class="btn btn-success"><i class="fa fa-plus"></i> <span>Thêm đơn hàng</span></a>';
            ?>
            <a href="actions/export_db_to_xlsx.php" class="btn btn-primary"><i class="fa fa-table"></i> <span>Tải xuống Excel</span></a>
          </div>
          <div class="col-sm-2">
            <div class="search-box">
              <div class="input-group">
                <select class="form-control" name="progess">
                  <option>Tất cả</option>
                  <option>Chờ xử lý</option>
                  <option>Đang giao hàng</option>
                  <option>Đã giao hàng</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Người gửi</th>           
              <th>Người nhận</th>
              <th>Ngày giao dự kiến</th>
              <th>Trạng thái</th>
              <th>Shipper</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-deliver">
            <?php
              if ($current_user['user_type'] == 1)
                $get_delivers = mysqli_query($conn, "SELECT * FROM delivers WHERE 1");
              else {
                $email = $current_user['email'];
                $id_user = $current_user['id'];
                $get_delivers = mysqli_query($conn, "SELECT * FROM delivers WHERE sender = '$email' OR receiver = '$email' OR shipper_id = '$id_user'");
              }
              $rows = mysqli_num_rows($get_delivers);
              if ($rows) {
                while ($deliver = mysqli_fetch_assoc($get_delivers)) {
                  echo '
                    <tr id="row-deliver-id-'.$deliver['id'].'">
                      <td>'.$deliver['id'].'</td>
                      <td>'.$deliver['sender'].'</td>
                      <td>'.$deliver['receiver'].'</td>                        
                      <td>'.$deliver['plan_date'].'</td>
                      <td>'.
                        (($deliver['progess']) == 0 ?
                            '<span class="badge badge-warning">Chờ xử lý</span>' : (($deliver['progess']) == 1 ?
                            '<span class="badge badge-primary">Đang giao hàng</span>' :
                            '<span class="badge badge-success">Đã giao hàng</span>')
                        )
                      .'</td>
                      <td>
                        <a href="user_show.php?user_id='.$deliver['shipper_id'].'">'.$deliver['shipper_id'].'</a>
                      </td>
                      '.($current_user['user_type'] == 0 ? '' : '
                      <td>
                        <a href="#" class="delete" title="Xóa" data-toggle="tooltip" onclick="deleteDeliver('.$deliver['id'].');"><i class="fa fa-trash-o"></i></a>
                        <a data-toggle="modal" data-target="#EditModal" href="#" class="edit" title="Sửa" data-toggle="tooltip" onclick="editDeliver('.$deliver['id'].');"><i class="fa fa-pencil"></i></a>
                      </td>').'
                    </tr>
                  ';
                }
              } 
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- Modal Manual -->

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Thêm đơn hàng</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form">
      <form class="form-add-manual">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"">Người gửi: <input type="text" class="form-control" name="sender" required="required"></div>
            <div class="col-sm-6">Người nhận: <input type="text" class="form-control" name="receiver" required="required"></div>
          </div>          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4"">Số lượng hàng: <input id="number_packages" type="number" class="form-control" name="number_packages" required="required" onChange="updatePrice();"></div>
            <div class="col-sm-4">Khối lượng(kg): <input id="weight" type="number" class="form-control" name="weight" required="required" onChange="updatePrice();"></div>
            <div class="col-sm-4">Khoảng cách: <input id="distance" type="number" class="form-control" name="distance" required="required" onChange="updatePrice();"></div>
          </div>          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-8">Kiểu gửi:
              <select id="type" class="form-control" name="type" onChange="updatePrice();">
                <option value="1">Gửi nhanh</option>
                <option value="0">Gửi thường</option>
              </select>
            </div>
            <div class="col-sm-4">Thành tiền: <input type="number" class="form-control" name="amount"  readonly="readonly" id="total_price_amount" value="0"></div>
          </div>          
        </div>
        <div class="form-group">
              Shipper
              <select id="shipper" class="form-control" name="shipper">
                <?php
                  $get_shippers = mysqli_query($conn, "SELECT * FROM users WHERE user_type = '2'");
                  $rows = mysqli_num_rows($get_shippers);
                  if ($rows) {
                    while ($shipper = mysqli_fetch_assoc($get_shippers)) {
                      echo '
                        <option value="'.$shipper['id'].'">'.$shipper['name'].'</option>
                      ';
                    }
                  } 
                ?>
              </select>
        </div>
        <div class="form-group" style="text-align: center;">
          <button type="submit" class="btn btn-success">Thêm</button>
        </div>     
      </form>
    </div>
      </div>
    </div>
  </div>
</div> 

<!-- Edit Manual -->

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Sửa đơn hàng</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form">
      <form class="form-edit">
        <div class="form-group">
          ID: <input id="deliver_id-edit" type="number" class="form-control" name="deliver_id-edit" readonly="readonly"></div>
        </div>
        <div class="form-group">
            <div class="row">
              <div class="col-sm-6"">Ngày dự kiến: <input type="datetime-local" class="form-control" name="plan_date-edit" required="required"></div>
              <div class="col-sm-6">
                Trạng thái:
                <select class="form-control" name="progess-edit">
                  <option value="0">Chờ xử lý</option>
                  <option value="1">Đang giao hàng</option>
                  <option value="2">Đã giao hàng</option>
                </select>
              </div>
            </div>
        </div>
        <div class="form-group" style="text-align: center;">
          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>     
      </form>
    </div>
      </div>
    </div>
</div> 


  <?php 
    include './layout/footer.php';
    mysqli_close($conn);
  ?>
</body>
</html>

<script type="text/javascript">
  function updatePrice() {
    var amount = $('#number_packages').val()*$('#weight').val()*$('#distance').val()*2000;
    if ($('#type').val() == 1) amount = amount*1.5;
    $('#total_price_amount').val(amount);
  }
  function deleteDeliver(id) {
    $.ajax({
      url: './actions/deliver_action.php?id=' + id,
      type: 'DELETE',
      success: function(result1) {
        if (result1 == '1') {
          window.alert("Xóa thành công");
          $('#row-deliver-id-' + id).hide();
        }
        else {
          window.alert(result1);
        }
      }
    });
  }

  function editDeliver(id) {
    $('#deliver_id-edit').val(id);
  }

  $('.form-add-manual').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        url      : './actions/deliver_action.php',
        data     : $(this).serialize(),
        success  : function(result2) {
          if (result2 == '0') {
            window.alert('Thêm đơn hàng không thành công');
          }
          else {
            window.alert('Thêm thành công');
            $('.table-deliver').append("br"+result2);
          }
          
        }
    });
  });

  $('.form-edit').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        url      : './actions/deliver_edit.php',
        data     : $(this).serialize(),
        success  : function(result3) {
          if (result3 == '0') {
            window.alert('Cập nhật đơn hàng không thành công');
          }
          else {
            window.alert('Cập nhật thành công');
            location.reload();
          }
          
        }
    });
  });
</script>