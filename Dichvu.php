<?php
    // Thêm vào đầu file để hiển thị lỗi
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "dacsn");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Thêm truy vấn SQL
$sql = "SELECT * FROM dich_vu";
$result = mysqli_query($conn, $sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch Vụ Bán Xe</title>
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
            float : center;
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
            margin-top: 50px;
          }
          
          .navbar a:hover,
          .navbar .active {
            color: var(--main-color);
            border-bottom: 3px solid var(--main-color);
            padding-bottom: 2px;
          }
          
          
          
          .home {
            max-width: 1800px;
            margin: auto;
            width: 100%;
            min-height: 790px;
            display: flex;
            align-items: center;
            background: url(image/back.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center ;
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

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            font-size: 14px;
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
            margin-bottom: 10px;
            text-decoration: none; 
            font-size: 1rem;
        }
        
        .footer-box a:hover {
            color: var(--main-color); /* Màu khi hover */
        }
        .footer-box a:active,
        .footer-box a:focus {
            color: #d90429; /* Màu đỏ khi nhấn và có focus */
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
                flex-basis: 100%; /* Mỗi box chiếm toàn bộ chiều r��ng khi màn hình nhỏ */
                text-align: center;
            }
        
            
            .footer-container .logo img {
                height: 90px; 
                font-weight: 700;
                color: var(--main-color);
            }
        }

        .service-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .car-item {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 25px;
            text-align: center;
            width: 300px;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .car-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .car-item h3 {
            color: #d90429;
            font-size: 1.5rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .image-container {
            width: 100%;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.1);
        }

        .car-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
            display: block;
        }

        .car-item:hover img {
            transform: scale(1.05);
        }

        .service-details {
            margin: 15px 0;
            width: 100%;
            text-align: left;
            padding: 0 10px;
        }

        .service-details p {
            margin-bottom: 12px;
            line-height: 1.6;
            display: block;
            word-wrap: break-word;
        }

        .service-details p strong {
            color: #333;
            font-weight: 600;
        }

        .price-text {
            color: #d90429;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
            font-size: 2.5rem;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: #d90429;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .car-item {
                width: 100%;
                max-width: 300px;
            }
        }
        .products {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
        padding: 20px;
        margin: 0 auto;
        max-width: 1200px;
    }

    .product-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 25px;
        text-align: center;
        width: 300px;
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .product-item h3 {
        color: #d90429;
        font-size: 1.5rem;
        margin-bottom: 15px;
        text-align: center;
    }

    .product-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
        display: block;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .product-item:hover img {
        transform: scale(1.05);
    }

    .product-item p {
        margin: 15px 0;
        color: #666;
        font-size: 1rem;
    }

    .buy-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #d90429;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .buy-btn:hover {
        background-color: #b0031e;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-item {
            width: 100%;
            max-width: 300px;
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

    <!-- Các Dịch Vụ -->
    <section id="cars" class="car-list">
        <div class="container">
            <h2 class="section-title">Các Dịch Vụ Của Chúng Tôi</h2>
            <div class="service-grid">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="car-item">
                            <h3><?php echo htmlspecialchars($row['ten_dich_vu']); ?></h3>
                            <div class="image-container">
                                <?php if(!empty($row['hinh_anh'])): ?>
                                    <?php
                                    $imagePath = "uploads/" . htmlspecialchars($row['hinh_anh']);
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" 
                                         alt="<?php echo htmlspecialchars($row['ten_dich_vu']); ?>"
                                         onerror="this.onerror=null; this.src='images/no-image.jpg';">
                                <?php else: ?>
                                    <img src="images/no-image.jpg" 
                                         alt="No image available">
                                <?php endif; ?>
                            </div>
                            <div class="service-details">
                                <p>
                                    <strong>Giá:</strong> 
                                    <span class="price-text"><?php echo number_format($row['gia_dich_vu'], 0, ',', '.'); ?> VND</span>
                                </p>
                                <p>
                                    <strong>Mô tả:</strong> 
                                    <span><?php echo htmlspecialchars($row['chi_tiet_dich_vu']); ?></span>
                                </p>
                                <p>
                                    <strong>Thời gian bảo hành:</strong> 
                                    <span><?php echo htmlspecialchars($row['thoi_gian_bao_hanh']); ?> tháng</span>
                                </p>
                                <p>
                        <strong>Trạng thái:</strong> 
                        <span>
                            <?php 
                            echo isset($row['trang_thai']) ? htmlspecialchars($row['trang_thai']) : 'Không xác định'; 
                            ?>
                        </span>
                    </p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='no-services'>Không có dịch vụ nào</p>";
                }
                ?>
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
    <script>
        const links = document.querySelectorAll('.footer-box a');

links.forEach(link => {
    link.addEventListener('click', () => {
        // Loại bỏ lớp active khỏi tất cả các liên kết
        links.forEach(link => link.classList.remove('active'));
        
        // Thêm lớp active vào liên kết đã click
        link.classList.add('active');
    });
});

</script>

<!-- Thêm script để debug -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        console.log('Image source:', img.src);
        img.addEventListener('error', function() {
            console.log('Failed to load image:', this.src);
        });
    });
});
</script>


<?php mysqli_close($conn); ?>
</body>

</html>
