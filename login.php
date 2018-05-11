<!DOCTYPE html>
<html lang="vi">
<?php include 'app.php';?>
<head>
    <title>Giao hàng 247 | Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
    <?php include './layout/header.php';?>
    <div class="login-form">
        <form action="./actions/login_action.php" method="post">
            <h2 class="text-center">Đăng nhập</h2>   
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Tài khoản" required="required">             
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="required">             
                </div>
            </div>        
            <div class="form-group">
                <button type="submit" class="btn btn-success login-btn btn-block">Đăng nhập</button>
            </div>
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox"> 
                    Ghi nhớ đăng nhập
                </label>
                <a href="#" class="pull-right">Quên Mật Khẩu?</a>
            </div>
        </form>
        <p class="text-center text-muted small">Chưa có tài khoản? <a href="register.php">Đăng ký ngay!</a></p>
    </div>
    <?php include './layout/footer.php';?>
</body>
</html>    