<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Xe</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            scroll-padding-top: 1rem;
            scroll-behavior: smooth;
            list-style: none;
            text-decoration: none;
            box-sizing: border-box;
          }
          :root {
            --main-color: #d90429;
            --text-color: #020102;
            --bg-color: #fff;
        }
        body {
          color: var(--text-color);
      }
          
          
          section {
            padding: 4rem 0 2rem;
          }
          img {
            width: 100%;
          }
          body {
            color: var(--text-color);
          }
          .container {
            max-width: 1068px;
            margin-left: auto;
            margin-right: auto;
          }
          header {
            display: block;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
          }
          .nav {
            display: flex;
            align-items:   center;
            justify-content: space-between;
            padding: 30px 35px;
          }
          
          .navbar {
            display: flex;
            justify-content: center;
            column-gap: 2rem;
            list-style: none;
            padding-top: 30px;
            
          }
          
          .navbar a {
            color: var(--text-color);
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-family: Arial, sans-serif;
            margin-top: 10px;
          }
          
          .navbar a:hover,
          .navbar .active {
            color: var(--main-color);
            border-bottom: 3px solid var(--main-color);
            padding-bottom: 2px;
          }
          
          
          .home {
            max-width: 1800px;
            margin: cover;
            width: 100%;
            min-height: 760px;
            display: flex;
            align-items: center;
            background: #fff url('image/back.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center left ;
            filter: brightness(105%);

        }
          .home-text {
            padding-left: 130px;
          }
          
          .home-text h1 {
            font-size: 2.4rem;
          }
          
          .home-text span {
            color: var(--main-color);
          }
          
          .home-text p {
            font-size: 0.938rem;
            font-weight: 300;
            margin: 0.6rem 0 1.2rem;
          }
        /* Banner */
        .banner {
            position: relative;
            background-image: url('image/back.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 500px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Tạo bóng chữ */
        }
        
        /* Thêm lớp phủ sáng */
        .banner {
            position: relative;
            background-image: url('image/back.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 650px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Tạo bóng nhẹ hơn để chữ tinh tế hơn */
        }
        
        /* Lớp phủ sáng trong hơn */
        .banner::before {
            content: none;
        }
        
        /* Chữ hiển thị trên lớp phủ */
        .banner h2 {
            position: relative;
            z-index: 2;
            font-size: 40px; /* Tăng kích thước chữ để dễ nhìn hơn */
            font-weight: bold;
            color:white;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5); /* Bóng sáng để hòa hợp với lớp phủ */
        }
        
        
      
        
        /* Các Xe Bán */
        .car-list {
            padding: 50px 0;
            background-color: #fff;
        }

        .car-list .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .car-item {
            width: 30%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
            padding: 20px;
        }

        .car-item img {
            transition: all 0.4s ease; /* Tạo hiệu ứng chuyển đổi mượt */
            cursor: pointer; /* Đổi con trỏ chuột thành dạng bấm */
        }
        
        .car-item img:hover {
            transform: scale(1.05); /* Phóng to khi di chuột */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Thêm đổ bóng */
        }
        
        .car-item img:active {
            transform: scale(0.9) rotate(-5deg); /* Thu nhỏ và xoay nhẹ khi bấm */
            filter: brightness(0.8); /* Làm tối ảnh */
        }
        
        
        

        .car-item h3 {
            font-size: 20px;
            margin-top: 15px;
        }

        .car-item p {
            font-size: 18px;
            color: #666;
        }

        .car-item a {
            display: inline-block;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
        }

        .car-item a:hover {
            text-decoration: underline;
        }

         /* Footer styles */
         .footer {
            background: var(--text-color);
            color: #f6f6f6;
            border-top: 2px solid var(--main-color);
            padding: 2rem 0;
        }
        
        .footer-container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Giảm khoảng cách giữa các phần trong footer */
            flex-wrap: wrap; /* Cho phép các phần tử xuống dòng khi không đủ chỗ */
        }
        
        .footer-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-basis: 23%; /* Mỗi box chiếm 23% chiều rộng, giúp tạo khoảng cách đều */
            min-width: 250px; /* Đảm bảo các box không quá nhỏ trên màn hình nhỏ */
        }
        
        .footer-box h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: #fff; /* Màu chữ tiêu đề */
        }
        
        .footer-box a,
        .footer-box p {
            color: #818181;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .footer-box a:hover {
            color: var(--main-color); /* Màu khi hover */
        }
        
        .social a {
            font-size: 24px;
            color: var(--main-color);
            margin-right: 1rem;
            transition: color 0.3s ease;
        }
        
        .social a:hover {
            color: #f1c40f; /* Màu vàng khi hover */
        }
        
        /* Phần bản quyền */
        .Copyright {
            padding: 20px;
            text-align: center;
            background: var(--text-color);
        }
        
        /* Điều chỉnh cho màn hình nhỏ */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
            }
        
            .footer-box {
                flex-basis: 100%; /* Mỗi box chiếm toàn bộ chiều rộng khi màn hình nhỏ */
                text-align: center;
            }
        
            
            .footer-container .logo img {
                height: 90px; 
                font-weight: 700;
                color: var(--main-color);
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <div class="container">
            <nav>
            <ul class="navbar">
                <li><a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Trang Chủ</a></li>
                <li><a href="tatcaxe.php" <?php echo basename($_SERVER['PHP_SELF']) == 'tatcaxe.php' ? 'class="active"' : ''; ?>>Tất Cả Xe</a></li>
                <li><a href="dichvu.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dichvu.php' ? 'class="active"' : ''; ?>>Dịch Vụ</a></li>
                <li><a href="thongtinxe.php" <?php echo basename($_SERVER['PHP_SELF']) == 'thongtinxe.php' ? 'class="active"' : ''; ?>>Thông Tin Xe</a></li>
                <li><a href="lienhe.php" <?php echo basename($_SERVER['PHP_SELF']) == 'lienhe.php' ? 'class="active"' : ''; ?>>Liên Hệ</a></li>
            </ul>
            </nav>
        </div>
    </header>

    <!-- Banner -->
    <section class="banner">
        
    </section>

    <!-- Các Xe Bán -->
    <section id="cars" class="car-list">
        <div class="container">
            <div class="car-item">
                <img src="image\audiq8.png" alt="Car 1">
                <div class="post-cont"> <span class="category"><a href="Tất cả xe.html">Thuê ô tô</a></span> <span class="calendar"><a href="">27 Apr, 2024</a></span>
                    <h5><a href="">Những giấy tờ cần thiết khi mua xe.</a></h5>
                    <p>Giấy tờ cần thiết: CMND/CCCD, bằng lái xe (đối với xe ô tô/máy).
                        Đặt cọc: Một số nơi yêu cầu tiền đặt cọc, thường từ 5-30 triệu VNĐ tùy loại xe.</p> 
            </div>
            </div>
            <div class="car-item">
                <img src="image\audiq8.png" alt="Car 2">
                <div class="post-cont"> <span class="category"><a href="Tất cả xe.html">Thuê ô tô</a></span> <span class="calendar"><a href="">27 Apr, 2024</a></span>
                    <h5><a href="">Những giấy tờ cần thiết khi mua xe.</a></h5>
                    <p>Giấy tờ cần thiết: CMND/CCCD, bằng lái xe (đối với xe ô tô/máy).
                        Đặt cọc: Một số nơi yêu cầu tiền đặt cọc, thường từ 5-30 triệu VNĐ tùy loại xe.</p> 
            </div>
            </div>
            <div class="car-item">
                <img src="image\audiq8.png" alt="Car 3">
                <div class="post-cont"> <span class="category"><a href="Tất cả xe.html">Thuê ô tô</a></span> <span class="calendar"><a href="">27 Apr, 2024</a></span>
                    <h5><a href="">Những giấy tờ cần thiết khi mua xe.</a></h5>
                    <p>Giấy tờ cần thiết: CMND/CCCD, bằng lái xe (đối với xe ô tô/máy).
                        Đặt cọc: Một số nơi yêu cầu tiền đặt cọc, thường từ 5-30 triệu VNĐ tùy loại xe.</p> 
            </div>
            </div>
            <div class="car-item">
                <img src="image\audiq8.png" alt="Car 3">
                <div class="post-cont"> <span class="category"><a href="Tất cả xe.html">Thuê ô tô</a></span> <span class="calendar"><a href="">27 Apr, 2024</a></span>
                    <h5><a href="">Những giấy tờ cần thiết khi mua xe.</a></h5>
                    <p>Giấy tờ cần thiết: CMND/CCCD, bằng lái xe (đối với xe ô tô/máy).
                        Đặt cọc: Một số nơi yêu cầu tiền đặt cọc, thường từ 5-30 triệu VNĐ tùy loại xe.</p> 
            </div>
            </div>
            <div class="car-item">
                <img src="image\audiq8.png" alt="Car 3">
                <div class="post-cont"> <span class="category"><a href="Tất cả xe.html">Thuê ô tô</a></span> <span class="calendar"><a href="">27 Apr, 2024</a></span>
                    <h5><a href="">Những giấy tờ cần thiết khi mua xe.</a></h5>
                    <p>Giấy tờ cần thiết: CMND/CCCD, bằng lái xe (đối với xe ô tô/máy).
                        Đặt cọc: Một số nơi yêu cầu tiền đặt cọc, thường từ 5-30 triệu VNĐ tùy loại xe.</p> 
            </div>
            </div>
            <div class="car-item">
                <img src="image\audiq8.png" alt="Car 3">
                <div class="post-cont"> <span class="category"><a href="Tất cả xe.html">Thuê ô tô</a></span> <span class="calendar"><a href="">27 Apr, 2024</a></span>
                    <h5><a href="">Những giấy tờ cần thiết khi mua xe.</a></h5>
                    <p>Giấy tờ cần thiết: CMND/CCCD, bằng lái xe (đối với xe ô tô/máy).
                        Đặt cọc: Một số nơi yêu cầu tiền đặt cọc, thường từ 5-30 triệu VNĐ tùy loại xe.</p> 
            </div>
            </div>
            
            
        </div>
    </section>

    <!-- Footer -->
    <section class="footer">
        <div class="footer-container">
            <div class="footer-box">
                <a href="#" class="logo">Car<span>Point</span></a>
                <div class="social">
                    <a href="#"> <i class='bx bxl-facebook'></i></a>
                    <a href="#"> <i class='bx bxl-instagram'></i></a>
                    <a href="#"> <i class='bx bxl-youtube'></i></a>
                </div>
            </div>
            <div class="footer-box">
                <h3>Trang</h3>
                <a href="#">Trang Chủ</a>
                <a href="#"> Tất Cả Xe </a>
                <a href="#">Dịch Vụ </a>
                <a href="#">Thông tin Xe</a>
                <a href="#">Liên Hệ</a>
            </div>
            <div class="footer-box">
                <h3>Chính Sách</h3>
                <a href="#">Chính Sách Bảo Mật</a>
                <a href="#">Chính Sách Hoàn Tiền</a>
                <a href="#">Chính Sách Cookie</a>
            </div>
            <div class="footer-box">
                <h3>Quốc Gia</h3>
                <p>Hoa Kỳ</p>
                <p>Nhật Bản</p>
                <p>Đức</p>
            </div>
        </div>
    </section>

</body>

</html>
