<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARLOI</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
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
        margin-top: 50px;
      }
      
      .navbar a:hover,
      .navbar .active {
        color: var(--main-color);
        border-bottom: 3px solid var(--main-color);
        padding-bottom: 2px;
      }
      .registration, .login {
        margin-top: 40px; /* Tạo khoảng cách trên cho phần đăng nhập và đăng ký */
    }
      
      .home {
        max-width: 2500px;
        margin: cover;
        width: 100%;
        min-height: 760px;
        display: flex;
        align-items: center;
        background: #ffff url(image/back.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center left;
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
      .btn {
        padding: 10px 22px;
        background: var(--main-color);
        color: var(--bg-color);
        font-weight: 400;
      }
      .btn:hover {
        background: #fd052f;
      }
      .heading {
        text-align: center;
      }
      .heading span {
        font-weight: 500;
        color: var(--main-color);
      }
      .heading p {
        font-size: 0.93rem;
        font-weight: 300;
      }
      .cars-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 2rem;
      }
      
      .cars-container .box {
        flex: 1 1 17rem;
        position: relative;
        height: 200px;
        border-radius: 0.5rem;
        overflow: hidden;
      }
      
      .cars-container .box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
      }
      .cars-container .box img:hover {
        transform: scale(1.1);
      }
      .cars-container .box h2 {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        font-weight: 400;
        font-size: 1rem;
        background: var(--bg-color);
        padding: 8px;
        border-radius: 0.5rem;
      }
      
      .cars-container .box:hover h2 {
        background: var(--main-color);
        color: var(--bg-color);
      }
      .about {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1.5rem;
      }
      
      .about-img {
        flex: 1 1 21rem;
      }
      .about-text {
        flex: 1 1 21rem;
      }
      
      .about-text span {
        font-weight: 500;
        color: var(--main-color);
      }
      
      .about-text h2 {
        font-size: 1.7rem;
      }
      
      .about-text p {
        font-size: 0.938rem;
        margin: 0.5rem 1.4rem;
      }
      .parts-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 2rem;
      }
      
      .parts-container .box {
        flex: 1 1 17rem;
        padding: 20px;
        background: #f6f6f6;
        border-radius: 0.5rem;
      }
      
      .parts-container .box img {
        width: 100%;
        height: 150px;
        object-fit: contain;
        margin-bottom: 1rem;
      }
      
      .parts-container .box h3, .parts-container .box span {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--main-color);
      }
      
      .parts-container .box .bx {
        color: var(--main-color);
        margin: 0.8rem 0;
      }
      .parts-container .box .btn {
        max-width: 120px;
      }
      
      .parts-container .box .details {
        display: flex;
        align-items: center;
        position: absolute;
        bottom: 1.8rem;
        right: 1rem;
        font-size: 1rem;
        color: var(--text-color);
      }
      
      .parts-container .box .details:hover {
        color: var(--main-color);
        text-decoration: underline;
      }
      .blog-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 2rem;
      }
      .blog-container .box {
        flex: 1 1 13rem;
        padding: 20px;
      }
      
      .blog-container .box:hover {
        background: #f6f6f6;
      }
      
      .blog-container .box span {
        font-size: 0.8rem;
        color: var(--main-color);
      }
      
      .blog-container h3 {
        font-size: 1.2rem;
      }
      
      .blog-container .box p {
        font-size: 0.938rem;
        margin: 4px 0;
      }
      .blog-container .box .blog-btn {
        display: flex;
        align-items: center;
        column-gap: 4px;
        color: var(--text-color);
      }
      .blog-container .box .blog-btn .bx {
        font-size: 20px;
      }
      
      .blog-container .box .blog-btn:hover {
        color: var(--main-color);
        column-gap: 0.7rem;
        transition: 0.4s;
      }
      /* Modal Styles */
.modal {
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  border-radius: 8px;
  text-align: center;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Modal Styles */
.modal {
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  display: none; /* Ẩn modal mặc định */
  background-color: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  width: 90%;
  max-width: 500px; /* Giới hạn chiều rộng */
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
  animation: fadeIn 0.3s ease; /* Hiệu ứng mở */
}

.modal-content h2 {
  font-size: 1.8rem;
  margin-bottom: 20px;
  color: var(--main-color);
  text-align: center;
}

.modal-content p {
  font-size: 1rem;
  margin-bottom: 20px;
  color: var(--text-color);
  text-align: center;
}

.modal-content label {
  font-size: 1rem;
  color: var(--text-color);
}

.modal-content input {
  width: 100%;
  padding: 10px;
  margin: 10px 0 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.modal-content button {
  padding: 10px 20px;
  background-color: var(--main-color);
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
  width: 100%;
}

.modal-content button:hover {
  background-color: #fd052f;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 1.5rem;
  color: #ccc;
  cursor: pointer;
}

.close:hover {
  color: var(--main-color);
}

/* Hiệu ứng mở modal */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

      
      
      .footer {
        background: var(--text-color);
        color: #f6f6f6;
        border-top: 2px solid var(--main-color);
      }
      .footer-container {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
      }
      
      .footer-container .logo {
        color: var(--bg-color);
      }
      .footer-container .logo-box {
        display: flex;
        flex-direction: column;
      }
      
      .social {
        display: flex;
        align-items: center;
      }
      .social a {
        font-size: 24px;
        color: var(--main-color);
        margin-right: 1rem;
      }
      
      .social a:hover {
        color: var(--main-color);
      }
      
      .footer-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      
      .footer-box h3 {
        font-size: 1.1rem;
        font-weight: 400;
        margin-bottom: 1rem;
      }
      
      .footer-box a,
      .footer-box p {
        color: #818181;
        margin-bottom: 10px;
      }
      .footer-box a:hover {
        color: var(--main-color);
      }
      
      .Copyright {
        padding: 20px;
        text-align: center;
        background: var(--text-color);
      }
      @media (max-width: 768px) {
        .logo img {
            height: 90px; 
        }
    }
      
</style>
<body>
    <header>
      
        <div class=" container">
          
        </a>
           <ul class="navbar">
                <li><a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Trang Chủ</a></li>
                <li><a href="tatcaxe.php" <?php echo basename($_SERVER['PHP_SELF']) == 'tatcaxe.php' ? 'class="active"' : ''; ?>>Tất Cả Xe</a></li>
                <li><a href="dichvu.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dichvu.php' ? 'class="active"' : ''; ?>>Dịch Vụ</a></li>
                <li><a href="thongtinxe.php" <?php echo basename($_SERVER['PHP_SELF']) == 'thongtinxe.php' ? 'class="active"' : ''; ?>>Thông Tin Xe</a></li>
                <li><a href="lienhe.php" <?php echo basename($_SERVER['PHP_SELF']) == 'lienhe.php' ? 'class="active"' : ''; ?>>Liên Hệ</a></li>
                <li><a href="dangky.php">Đăng Ký</a></li>
                <li><a href="dangnhap.php">Đăng nhập</a></li>
            </ul>
            
            
        </div>
    </header>

    <main>
        <section class="home" id="home">
            <div class=""></div>
        </section>
        <section class="cars" id="cars">
            <div class="heading">
                <span>Tất Cả Xe</span>
                <h2>Chúng tôi có tất cả các loại xe</h2>
                
            </div>
            <div class="cars-container container">
                <div class="box">
                    <img src="image\xe1.png" alt="">
                    <h2>AUDI A5 </h2>
                </div>
                <div class="box">
                    <img src="image\xe2.png" alt ="">
                    <h2>AUDIE-TRON</h2>
                </div>
                <div class="box">
                    <img src="image\xe5.png" alt="">
                    <h2>AUDI A6</h2>
                </div>
                <div class="box">
                    <img src="image\xe7.png" alt="">
                    <h2>AUDI Q4 E-TRON</h2>
                </div>
                <div class="box">
                  <img src="image\xe11.png" alt="">
                  <h2>AUDI Q8 E-TRON</h2>
              </div>
              <div class="box">
                <img src="image\xe9.png" alt="">
                <h2>AUDI Q8 E-TRON</h2> 
            </div>
        </section>

        <section class="about container" id="about">
            <div class="about-img">
                <img src="image\xe25.png" alt="About Us">
            </div>
            <div class="about-text">
                <span>Về Với Chúng Tôi</span><br>
                <h2>Giá cả hợp lý <br> Xe chất lượng</h2><br>
               
            </div>
        </section>
        <section class="parts" id="parts">
            <div class="heading">
                <span>Chúng Tôi Cung Cấp</span>
            </div>
            <div class="parts-container container">
                <div class="box">
                    <img src="image\xe25.png" alt="Phụ Tùng Xe Hơi">
                    <h3>Xe mới</h3>
                    <span>120.000 VND</span>
                    <i class='bx bxs-star'>(6 đánh giá)</i>
                    <button class="btn add-to-cart">Mua Ngay</button>

                    <a href="#" class="details">Xem Chi Tiết</a>
                </div>
                <div class="box">
                    <img src="image\xe11.png" alt="Phụ Tùng Xe Hơi">
                    <h3>Xe mới</h3>
                    <span>120.000 VND</span>
                    <i class='bx bxs-star'>(6 đánh giá)</i>
                    <button class="btn add-to-cart">Mua Ngay</button>
                    <a href="#" class="details">Xem Chi Tiết</a>
                </div>
                <div class="box">
                    <img src="image\xe7.png" alt="Phụ Tùng Xe Hơi">
                    <h3>Xe mới</h3>
                    <span>120.000 VND</span>
                    <i class='bx bxs-star'>(6 đánh giá)</i>
                    <button class="btn add-to-cart">Mua Ngay</button>
                    <a href="#" class="details">Xem Chi Tiết</a>
                </div>
                
                
               
               
            </div>
        </section>

        <section class="blog" id="blog">
            <div class="heading">
                <span>Blog & Tin Tức</span>
                <h2>Container Blog của Chúng Tôi</h2>
                <p>Dòng Xe</p>
            </div>
            <div class="blog-container container">
                <div class="box">
                    <img src="image\xe21.png" alt="">                   
                    <h3>Dòng Xe Mới Hiện Nay </h3>
                    <p>AUDI </p>
                    <a href="#" class="blog-btn">Đọc Thêm<i class='bx bx-right-arrow-alt'></i></a>
                </div>
                <div class="box">
                    <img src="image\xe23.png" alt="">
                    <h3>Dòng Xe Mới Hiện Nay </h3>
                    <p>AUDI </p>
                    <a href="#" class="blog-btn">Đọc Thêm<i class='bx bx-right-arrow-alt'></i></a>
                </div>
                <div class="box">
                    <img src="image\xe22.png" alt="">
                    <h3>Dòng Xe Mới Hiện Nay </h3>
                    <p>AUDI </p>
                    <a href="#" class="blog-btn">Đọc Thêm<i class='bx bx-right-arrow-alt'></i></a>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div id="purchaseModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Thông Tin Mua Xe</h2>
            <form>
                <div class="form-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                </div>
                
                <button type="submit" class="btn-submit">Xác Nhận Mua Xe</button>
            </form>
          </div>
        </div>
        


        <section class="footer">
            <div class="footer-container container">
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

        <div class="Copyright">
            <p>&#169; CARLOI</p>
        </div>
        

        <script src="TKW/main.js"></script>
        <script>
          document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("purchaseModal");
            const closeModal = document.querySelector(".modal .close");
            const buyButtons = document.querySelectorAll(".btn.add-to-cart");
          
            buyButtons.forEach((button) => {
              button.addEventListener("click", () => {
                modal.style.display = "flex"; // Hiển thị modal
              });
            });
          
            closeModal.addEventListener("click", () => {
              modal.style.display = "none"; // Ẩn modal
            });
          
            window.addEventListener("click", (event) => {
              if (event.target === modal) {
                modal.style.display = "none"; // Ẩn modal khi click bên ngoài
              }
            });
          });
          
        </script>
        <script>
    // Lấy các nút "Mua Ngay" và modal
    const purchaseButtons = document.querySelectorAll('.add-to-cart');
    const modal = document.getElementById('purchaseModal');
    const closeModal = document.querySelector('.close');

    // Hiển thị modal khi nhấn "Mua Ngay"
    purchaseButtons.forEach(button => {
        button.addEventListener('click', () => {
            modal.style.display = 'flex';  // Hiển thị modal
        });
    });

    // Đóng modal khi nhấn vào nút đóng
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';  // Ẩn modal
    });

    // Đóng modal khi nhấn ra ngoài modal
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';  // Ẩn modal
        }
    });
</script>

        
    </body>
</html>
