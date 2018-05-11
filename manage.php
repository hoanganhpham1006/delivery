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
    <h2 style="text-align: center;">Bảng tin quản lý</h2>
    <div class="container">
      <br>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Danh sách người dùng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="shippers-tab" data-toggle="tab" href="#shippers" role="tab" aria-controls="shippers" aria-selected="false">Danh sách shipper</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
          <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-5">
                <h2>Danh sách người dùng</h2>
              </div>
              <div class="col-sm-3">
                <a href="actions/export_db_to_xlsx.php" class="btn btn-primary"><i class="fa fa-table"></i> <span>Tải xuống Excel</span></a>           
              </div>
              <div class="col-sm-4">
                <div class="search-box">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search&hellip;">
                  </div>
                </div>
              </div>
            </div>
          </div>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Họ và Tên</th>           
                  <th>Tài khoản</th>
                  <th>Email</th>
                  <th>Vai trò</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $get_users = mysqli_query($conn, "SELECT * FROM users WHERE 1");
                  $rows = mysqli_num_rows($get_users);
                  if ($rows) {
                    while ($user = mysqli_fetch_assoc($get_users)) {
                      if ($user['user_type'] != 2) echo '
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
                          <a href="#" id="up-'.$user['id'].'" class="up" title="Cấp quyền Admin" data-toggle="tooltip"><i class="fa fa-angle-double-up"></i></a>
                          <a href="#" class="delete" title="Xóa" data-toggle="tooltip" onclick="deleteUser('.$user['id'].');"><i class="fa fa-trash-o"></i></a>
                        </td>
                      </tr>
                      ';
                    }
                  }
                ?>
              </tbody>
            </table>
            <!-- <div class="clearfix">
              <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                  <li class="page-item disabled"><a href="#">Previous</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item active"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">4</a></li>
                  <li class="page-item"><a href="#" class="page-link">5</a></li>
                  <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div> -->
          </div>
        </div>
        <div class="tab-pane fade" id="shippers" role="tabpanel" aria-labelledby="shippers-tab">
          <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-4">
                <h2>Danh sách shipper</h2>
              </div>
              <div class="col-sm-4">
                <a href="#" data-toggle="modal" data-target="#AddModal" class="btn btn-success"><i class="fa fa-plus"></i> <span>Thêm shipper</span></a>
                <a href="actions/export_db_to_xlsx.php" class="btn btn-primary"><i class="fa fa-table"></i> <span>Tải xuống Excel</span></a>
              </div>
              <div class="col-sm-4">
                <div class="search-box">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search&hellip;">
                  </div>
                </div>
              </div>
            </div>
          </div>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Họ và Tên</th>           
                  <th>Tài khoản</th>
                  <th>Email</th>
                  <th>Vai trò</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="table-shipper">
                <?php
                  $get_users = mysqli_query($conn, "SELECT * FROM users WHERE 1");
                  $rows = mysqli_num_rows($get_users);
                  if ($rows) {
                    while ($user = mysqli_fetch_assoc($get_users)) {
                      if ($user['user_type'] == 2) echo '
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
                      </tr>
                      ';
                    }
                  } 
                  mysqli_close($conn);
                ?>
              </tbody>
            </table>
            <div style="text-align: center;">
              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ExcelModal"><i class="fa fa-upload"></i> <span>Import from Excel</span></a>
            </div>
            <!-- <div class="clearfix">
              <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                  <li class="page-item disabled"><a href="#">Previous</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item active"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">4</a></li>
                  <li class="page-item"><a href="#" class="page-link">5</a></li>
                  <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Manual -->

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Thêm shipper</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form">
      <form class="form-add-manual">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"">Tên đầy đủ: <input type="text" class="form-control" name="name" required="required"></div>
            <div class="col-sm-6">Tài khoản: <input type="text" class="form-control" name="username" required="required"></div>
          </div>          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"">Ngày sinh: <input type="date" class="form-control" name="dob" required="required"></div>
            <div class="col-sm-6">Số điện thoại: <input type="tel" class="form-control" name="phone" required="required"></div>
          </div>          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-8"">Email: <input type="email" class="form-control" name="email" required="required"></div>
            <div class="col-sm-4">Giới tính: 
              <select class="form-control" name="gender">
                <option>Nam</option>
                <option>Nữ</option>
                <option>Khác</option>
              </select>
            </div>
          </div>  
        </div>
        <div class="form-group">
          Địa chỉ: <input type="text" class="form-control" name="address" required="required">
        </div>
        <div class="form-group">
          Mật khẩu mặc định:<input type="password" class="form-control" name="password" required="required">
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

<!-- Modal Excel -->
<div class="modal fade" id="ExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Thêm shipper</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form" style="text-align: center;">
          <form enctype="multipart/form-data" action="actions/shipper_excel_import.php" method="POST" class="form-add-excel">
            <p>Chọn file và tải lên</p>
            <input type="file" name="uploaded_file"></input><br><br>
            <input type="submit" value="Upload" class="btn btn-success"></input>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> 

  <?php include './layout/footer.php';?>
</body>
</html>

<script type="text/javascript">
  function deleteUser(id) {
    $.ajax({
      url: './actions/user_action.php?id=' + id,
      type: 'DELETE',
      success: function(result1) {
        if (result1 == '1') {
          window.alert("Xóa thành công");
          $('#row-user-id-' + id).hide();
        }
        else {
          window.alert(result1);
        }
      }
    });
  }
  $('.form-add-manual').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        url      : './actions/shipper_action.php',
        data     : $(this).serialize(),
        success  : function(result2) {
          if (result2 == '2') {
            window.alert('Tài khoản đã có người sử dụng');
          }
          else if (result2 == '3') {
            window.alert('Email đã có người sử dụng');
          }
          else if (result2 == '0') {
            window.alert('Thêm không thành công');
          }
          else {
            window.alert('Thêm thành công');
            $('.table-shipper').append("br"+result2);
          }
          
        }
    });

  });
</script>