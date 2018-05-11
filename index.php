<!DOCTYPE html>
<html lang="vi">
<?php include 'app.php';?>
<head>
    <title>Giao hàng 247 | Trang chủ</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
  <?php
    include 'global.php'; 
    include './layout/header.php';
  ?>
  <div class="slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Carousel indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>   
      <!-- Wrapper for carousel items -->
      <div class="carousel-inner">
        <div class="item carousel-item active">
          <img src="./image/1.jpg" alt="GH247">
          <div class="carousel-caption">
            <h3>Nhanh chóng và tiện lợi</h3>
            <p>Tất cả những gì bạn cần là ngồi ở nhà và kiểm tra tiến độ. Mọi việc GH247 sẽ lo.</p>
            <div class="carousel-action">
              <a href="#" class="btn btn-primary">Gửi phản hồi</a>
              <a href="#" class="btn btn-success">Đội ngũ GH247</a>
            </div>
          </div>
        </div>  
        <div class="item carousel-item">
          <img src="./image/2.jpg" alt="GH247">
          <div class="carousel-caption">
            <h3>Cam kết giá luôn luôn rẻ nhất</h3>             
            <p>GH247 luôn cam kết mang đến dịch vụ tốt nhất cùng giá thành rẻ nhất cho bạn</p>
            <div class="carousel-action">
              <a href="#" class="btn btn-primary">Gửi phản hồi</a>
              <a href="#" class="btn btn-success">Đội ngũ GH247</a>
            </div>
          </div>
        </div>
        <div class="item carousel-item">
          <img src="./image/3.jpg" alt="GH247">
          <div class="carousel-caption">
            <h3>Đội ngũ chuyên nghiệp</h3>
            <p>Ở GH247, mỗi nhân viên đều luôn mong muốn được mang lại cho khách hàng sự thoải mái và vui vẻ nhất</p>
            <div class="carousel-action">
              <a href="#" class="btn btn-primary">Gửi phản hồi</a>
              <a href="#" class="btn btn-success">Đội ngũ GH247</a>
            </div>
          </div>
        </div>  
      </div>
      <!-- Carousel controls -->
      <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
      </a>
      <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
      </a>
    </div>
  </div>

  <div class="container">
    <div class="title">
      <h2><b>Giá vận chuyển của GH247:</b></h2>
    </div>
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Khoảng cách</th>
          <th scope="col">Số gói hàng</th>
          <th scope="col">Tổng cân nặng</th>
          <th scope="col">Giá thành</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"> < 5km </th>
          <td> < 3 </td>
          <td> < 20kg </td>
          <td> 40.000 VND </td>
        </tr>
        <tr>
          <th scope="row"> </th>
          <td> > 3</td>
          <td> > 50kg </td>
          <td> 80.000 VND</td>
        </tr>
        <tr>
          <th scope="row"> < 50km </th>
          <td> < 3 </td>
          <td> < 20kg </td>
          <td> 80.000 VND </td>
        </tr>
        <tr>
          <th scope="row"> </th>
          <td> > 3</td>
          <td> > 50kg </td>
          <td> 100.000 VND</td>
        </tr>
        <tr>
          <th scope="row"> > 50km </th>
          <td>  </td>
          <td>  </td>
          <td> 200.000 VND </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php include './layout/footer.php';?>
</body>
</html>    