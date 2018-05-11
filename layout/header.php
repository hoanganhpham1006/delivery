<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <div class="container">
    <a class="navbar-brand logo" href="index.php">GH247</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active dropdown">
          <?php if (!empty($current_user)) echo '
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            <img class="header-avatar" alt="Avatar" src="'.$current_user['avatar'].'"/> '.$current_user['name'].'
          </a>'
          ?>
          <div class="dropdown-menu dropdown-menu-right">
            <?php 
              if ($current_user['user_type'] == 1)
                echo '<a class="dropdown-item" href="manage.php">Bảng tin</a>';
            ?>
            <a class="dropdown-item" href="user_show.php">Sửa thông tin tài khoản</a>
            <a class="dropdown-item" href="delivers_manage.php">Đơn hàng của tôi</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="actions/logout_action.php">Đăng xuất</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>