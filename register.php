<!DOCTYPE html>
<html lang="vi">
<?php include 'app.php';?>
<head>
  <title>Giao hàng 247 | Đăng ký</title>
  <link rel="stylesheet" type="text/css" href="./css/register.css">
</head>
<body>
  <?php include './layout/header.php';?>
  <div class="signup-form">
    <form action="./actions/registration_action.php" method="post">
    <h2>Đăng ký tài khoản</h2>
    <p class="hint-text">Tạo tài khoản hoàn toàn miễn phí để kiếm tra tiến độ đơn hàng</p>
    <div class="form-group">
      <div class="row">
        <div class="col-sm-6"><input type="text" class="form-control" name="first_name" placeholder="Họ và đêm" required="required"></div>
        <div class="col-sm-6"><input type="text" class="form-control" name="last_name" placeholder="Tên" required="required"></div>
      </div>          
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required="required">
    </div>
    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="Email" required="required">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="required">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu" required="required">
    </div>        
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-lg btn-block">Đăng ký</button>
    </div>
    </form>
  </div>
  <div class="text-center">Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></div>
  <?php include './layout/footer.php';?>
</body>
</html>