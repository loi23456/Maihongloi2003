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
            align-items: center;
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

        /* Banner */
        .banner {
            position: relative;
            background-image: url('image/back.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 760px;
            color: white;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-left: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .banner h2 {
            font-size: 30px;
            font-weight: bold;
            color: #fff;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
        }

        /* Footer Styles */
        .footer-contact-links {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-contact-link-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            width: 30%;
            transition: background-color 0.3s ease, transform 0.3s ease;            cursor: pointer;
            cursor: pointer;
        }

        .footer-contact-link-wrapper:hover {
            background-color: #fff;
            transform: scale(1.05);
        }

        .footer-contact-link-icon {
            margin-right: 10px;
            font-size: 24px;
           
        }

        .footer-contact-link-content h6 {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 1rem;
            color: rgb(19, 2, 2); /* Màu chữ của tiêu đề */
        }

        .footer-contact-link-content p {
            color: var(--text-color);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .footer-contact-link-wrapper {
                width: 48%;
                margin-bottom: 8px;
            }
        }
        .footer-contact-link-content h6 {
            font-size: 1rem; 
        }
        .footer-contact-link-content p {
            font-size: 0.85rem;
        }

        .footer-contact-link-wrapper.box {
            border: 2px solid #ccc;
            padding: 10px;
            border-radius: 8px;
        }

        .second-footer {
            margin-top: 2rem;
            text-align: center;
        }

        .second-footer p {
            font-size: 1rem;
            color: var(--text-color);
        }

        /* Định dạng chung cho form liên hệ */
        #contact-form {
            padding: 4rem 0;
            background-color: #f9f9f9;
            margin-top: 40px;
        }

        .contact-form-box {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px #fff;
        }

        .contact-form-box h3 {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--main-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: var(--text-color);
            display: block;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f8f8;
        }

        .form-group textarea {
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--main-color);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: #c3073f;
        }
        /* Footer: Cập nhật để các phần trong footer nằm ngang và căn chỉnh */
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

    <section class="banner"></section> 

    <!-- Liên Hệ Section -->
    <section id="contact">
        <div class="container">
            <div class="footer-contact-links">
                <!-- Call Phone section with a box around it -->
                <div class="footer-contact-link-wrapper box">
                    <div class="footer-contact-link-icon">
                        <i class="flaticon-phone-call"></i>
                    </div>
                    <div class="footer-contact-link-content">
                        <h6>Call phone</h6>
                        <p>0365 958 612</p>
                    </div>
                </div>

                <!-- Gmail section with a box around it -->
                <div class="footer-contact-link-wrapper box">
                    <div class="footer-contact-link-icon">
                        <i class="omfi-envelope"></i>
                    </div>
                    <div class="footer-contact-link-content">
                        <h6>Gmail</h6>
                        <p>Maihongloi060423@gmail.com</p>
                    </div>
                </div>

                <!-- Address section with a box around it -->
                <div class="footer-contact-link-wrapper box">
                    <div class="footer-contact-link-icon">
                        <i class="omfi-location"></i>
                    </div>
                    <div class="footer-contact-link-content">
                        <h6>Địa chỉ</h6>
                        <p>Long hữu, thị xã Duyên Hải, tỉnh Trà Vinh</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="second-footer">
                <p>Chúng tôi cung cấp dịch vụ thuê xe với nhiều lựa chọn phương tiện để đáp ứng nhu cầu của bạn.</p>
            </div>
        </div>
    </footer>
    
    <section id="contact-form">
        <div class="container">
            <div class="contact-form-box">
                <h3>Liên Hệ Với Chúng Tôi</h3>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="customer-name">Tên khách hàng</label>
                        <input type="text" id="customer-name" name="customer-name" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-phone">Số điện thoại</label>
                        <input type="text" id="customer-phone" name="customer-phone" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-email">Gmail</label>
                        <input type="email" id="customer-email" name="customer-email" placeholder="Nhập email của bạn" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-message">Tin nhắn</label>
                        <textarea id="customer-message" name="customer-message" rows="4" placeholder="Nhập tin nhắn của bạn" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Gửi tin nhắn</button>
                </form>
            </div>
        </div>
    </section>
    <footer class="footer">
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
    </footer>
</body>

</html>
