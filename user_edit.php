<!DOCTYPE html>
<html lang="vi">
<?php include 'app.php';?>
<head>
  <title>Giao hàng 247 | Sửa thông tin cá nhân</title>
  <link rel="stylesheet" type="text/css" href="./css/register.css">
</head>
<body>
  <?php
    include 'global.php';
    include './layout/header.php';
  ;?>
  <?php echo '
    <div class="title">
      <h2>Cập nhật thông tin người dùng</h2>
      <img class="avatar-user-edit" src="'.$current_user['avatar'].'"/>
    </div>

    <div class="signup-form">
      <form action="./actions/user_action.php" method="post">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"">Tên đầy đủ: <input type="text" value="'.$current_user['name'].'" class="form-control" name="name" required="required"></div>
            <div class="col-sm-6">Tài khoản: <input type="text" value="'.$current_user['username'].'" class="form-control" name="username" required="required"></div>
          </div>          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"">Ngày sinh: <input type="date" value="'.$current_user['dob'].'" class="form-control" name="dob" required="required"></div>
            <div class="col-sm-2">Giới tính: 
              <select class="form-control" name="gender">
                <option>Nam</option>
                <option '.(($current_user['gender'] === 0) ? 'selected="selected"' :'' ).'>Nữ</option>
                <option>Khác</option>
              </select>
            </div>
            <div class="col-sm-4">Số điện thoại: <input type="tel" value="'.$current_user['phone'].'" class="form-control" name="phone" required="required"></div>
          </div>          
        </div>
        <div class="form-group">
          Email: <input type="email" value="'.$current_user['email'].'" class="form-control" name="email" required="required">
        </div>
        <div class="form-group">
          Địa chỉ: <input type="text" value="'.$current_user['address'].'" class="form-control" name="address" required="required">
        </div>
        <div class="form-group">
          Nhập mật khẩu để hoàn thành:<input type="password" class="form-control" name="password" required="required">
          <input type="hidden" value="'.$current_user['password'].'" name="current_password">
          <input type="hidden" value="'.$current_user['id'].'" name="id">
        </div>       
        <div class="form-group">
          <div class="row">
            <div class="offset-sm-3 col-sm-3">
              <button type="submit" class="btn btn-success btn-block">Cập nhật</button>
            </div>
            <div class="col-sm-3">
              <button class="btn btn-danger btn-block">Hủy bỏ</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    ';
  ?>
  <?php include './layout/footer.php';?>
</body>
</html>