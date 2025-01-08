<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất Cả Xe</title>
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
            background-color: #f4f4f4;
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
            
        .search-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .search-input {
            width: 70%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .search-button {
            padding: 10px 15px;
            background-color: #fff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #d32f2f;
        }
        button {
            font-size: 15px; /* Điều chỉnh kích thước của biểu tượng 🔍 */
            padding: 10px 20px; /* Điều chỉnh padding để nút không quá dày */
            background-color: #f5ecec; /* Màu nền của nút */
            color: white; /* Màu chữ (biểu tượng trong trường hợp này) */
            border: none; /* Bỏ viền */
            border-radius: 5px; /* Làm tròn góc nút */
            cursor: pointer; /* Thêm hiệu ứng con trỏ khi hover */
        }
        
        button:hover {
            background-color: #d32f2f; /* Màu nền khi hover */
        }
        
        
        .search-button:hover {
            background-color: #d32f2f; /* Màu nền khi hover */
        }
        
        .search-bar {
            height: 50px;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
        
        .search-bar form {
            display: flex;
            align-items: center;
        }
        
        .search-bar input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            outline: none;
            width: 250px;
        }
        
        .search-bar button {
            padding: 10px;
            font-size: 1rem;
            background-color: var(--bg-color);
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .search-bar button:hover {
            background-color: #b50320;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Tự động tạo các cột với kích thước tối thiểu 200px */
            gap: 16px; /* Khoảng cách giữa các ảnh */
            padding: 16px; /* Khoảng cách ngoài container */
        }
        .gallery img {
            width: 100%; /* Đảm bảo ảnh chiếm hết chiều rộng của phần tử */
            height: auto; /* Giữ tỷ lệ ảnh */
            border-radius: 8px; /* Bo góc cho ảnh */
            object-fit: cover; /* Đảm bảo ảnh không bị méo */
        }
        .gallery-item {
            overflow: hidden;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Để ảnh có một chút bóng */
        }
        .gallery-filter {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .gallery-filter li {
            cursor: pointer;
            font-weight: 600;
            text-transform: uppercase;
            padding: 5px 10px;
        }

        .gallery-filter .active {
            color: var(--main-color);
            border-bottom: 2px solid var(--main-color);
        }

        .gallery-items {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            padding: 0 10px;
        }

        
        
        .gallery-items .single-item {
            display: none; /* Mặc định tất cả các xe sẽ bị ẩn */
        }

        .gallery-items .single-item.show {
            display: block; /* Chỉ hiển thị các phần tử có lớp 'show' */
        }

        .gallery-items .luxurycars,
        .gallery-items .sportcars,
        .gallery-items .suv {
            padding: 30px;
            color: white;
            background: var(--bg-color); /* Thay hình nền bằng màu nền đơn giản */
            border-radius: 10px; /* Bo góc */
            text-align: center; /* Căn giữa nội dung */
        }

        .gallery-items .single-item {
            display: none; /* Mặc định ẩn các phần tử */
        }

        .gallery-items .single-item.show {
            display: block; /* Chỉ hiển thị các phần tử phù hợp */
        }

        .gallery-box {
            width: 100%; /* Hoặc thiết lập cụ thể theo chiều rộng mong muốn */
            height: auto; /* Tự động điều chỉnh chiều cao dựa vào nội dung */
            overflow: hidden; /* Cắt bỏ phần thừa của hình ảnh */
        }

        .gallery-img img {
            width: 100%; /* Đảm bảo chiếm toàn bộ chiều rộng */
            height: 100%; /* Chiếm toàn bộ chiều cao */
            object-fit: cover; /* Cắt hình ảnh để vừa khung mà không làm méo */
            display: block; /* Xóa các khoảng trống do chế độ inline ảnh hưởng */
        }

        .gallery-img img:hover {
            transform: scale(1.05); /* Phóng to khi hover */
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
        }

        .gallery-detail {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
            color: white;
            text-align: center;
            font-size: 1rem;
            opacity: 0; /* Ẩn thông tin ban đầu */
            transition: opacity 0.3s ease;
        }

        .gallery-box:hover .gallery-detail {
            opacity: 1; /* Hiển thị chi tiết khi hover */
        }


        .single-item {
            flex: 1 1 calc(33.333% - 1rem); /* Mỗi item chiếm 1/3 chiều rộng và có khoảng cách giữa các phần tử */
            max-width: 33.333%; /* Giới hạn chiều rộng tối đa của mỗi item */
            margin-bottom: 1rem; /* Thêm khoảng cách dưới mỗi item */
            box-sizing: border-box; /* Đảm bảo các padding và margin không làm thay đổi kích thước */
        }

        .single-item.show {
            display: block; /* Hiển thị ảnh khi có lớp 'show' */
        }

        .gallery-box {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        

        .gallery-detail {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);   /* Nền mờ */
            color: white;
            text-align: center;
            font-size: 1rem;
            opacity: 0;   /* Ẩn thông tin ban đầu */
            transition: opacity 0.3s ease;
        }

        .bottom-fade {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            padding: 20px;
        }
        .product-item {
            width: 250px;
            margin: 10px;
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .product-item:hover {
            transform: translateY(-5px);
        }
        .product-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .product-item h3 {
            margin-top: 15px;
            color: #333;
        }
        .product-item p {
            margin-top: 10px;
            color: green;
        }
        .product-item button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 20px;
        }
        .product-item button:hover {
            background-color: blue;
        }
        /* Button styles */
.product-item button.buy-now {
    background-color: #d90429; /* Red color matching your theme */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    margin-top: 10px; /* Space between price and button */
}

.product-item button.buy-now:hover {
    background-color: #b50320; /* Darker red on hover */
}    .buy-btn{
         display: inline-block;
         padding:10px 20px;
         background-color: #b50320;
         color:#fff;
         text-decoration: none;
         border-radius: 5px;
         font-size: 16px;
         transition: backgroud-color 0.3s ease;
}
    .buy-btn:hover{
        backgroud-color:#b50320;
    }

        .search-container {
            position: relative;
            margin-left: 20px;
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
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .footer-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-basis: 23%;
            min-width: 250px;
        }
        
        .footer-box h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: #fff;
        }
        
        .footer-box a,
        .footer-box p {
            color: #818181;
            margin-bottom: 10px;
            text-decoration: none;
            font-size: 1rem;
        }
        
        .footer-box a:hover {
            color: var(--main-color);
        }
        
        .footer-box a:active,
        .footer-box a:focus {
            color: #d90429;
        }
        
        .social a {
            font-size: 24px;
            color: var(--main-color);
            margin-right: 1rem;
            transition: color 0.3s ease;
        }
        
        .social a:hover {
            color: #f1c40f;
        }
        
        .Copyright {
            padding: 20px;
            text-align: center;
            background: var(--text-color);
            color: #f6f6f6;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
            }
            
            .footer-box {
                flex-basis: 100%;
                text-align: center;
            }
        }

        /* Image styles */
        .image-container {
            width: 100%;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .product-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
            display: block;
        }

        .product-item:hover img {
            transform: scale(1.05);
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--main-color);
            color: #fff;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Responsive table */
        @media screen and (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto;
            }
        }

        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--main-color);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
        }

        .cart-icon i {
            color: white;
            font-size: 24px;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: white;
            color: var(--main-color);
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .cart-modal {
            display: none;
            position: fixed;
            top: 60px;
            right: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            width: 300px;
            max-height: 400px;
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .add-to-cart {
            background-color: #4CAF50;
            margin-right: 10px;
        }

        .add-to-cart:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <nav class=" container">
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
        </div>
    </header>

    <section class="home">
        <!-- Section content here if needed -->
    </section>
    <section class="search-container">
        <input type="text" class="search-input" placeholder="Tìm kiếm...">
        <button type="submit" class="search-button">🔍</button>
    </section>
         <ul class="gallery-filter">
             <li class="active" data-filter="*">Tất Cả</li>
        </ul>
       
            <section class="products">
                <div class="product-item">
                    <img src="image\xe9.png" alt="Toyota Camry">
                    <h3>Toyota Camry</h3>
                    <p>Giá: 830 triệu VND</p>
                    <a href ="Muaxe.php" class ="buy-btn"> Mua Ngay</a>
                </div>
                <div class="product-item">
                    <img src="image/hinh2.png" alt="Honda Civic">
                    <h3>Honda Civic</h3>
                    <p>Giá: 700 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh5.png" alt="Ford Focus">
                    <h3>Ford Focus</h3>
                    <p>Giá: 700 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh6.png" alt="Hyundai Sonata">
                    <h3>Hyundai Sonata</h3>
                    <p>Giá: 650 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh7.png" alt="Mazda 3">
                    <h3>Mazda 3</h3>
                    <p>Giá: 550 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh8.png" alt="Nissan Sentra">
                    <h3>Nissan Sentra</h3>
                    <p>Giá: 500 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh9.png" alt="Kia Optima">
                    <h3>Kia Optima</h3>
                    <p>Giá: 500 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh10.png" alt="Volkswagen Passat">
                    <h3>Volkswagen Passat</h3>
                    <p>Giá: 500 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh11.png" alt="Peugeot 508">
                    <h3>Peugeot 508</h3>
                    <p>Giá: 600 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh12.png" alt="Fiat 500">
                    <h3>Fiat 500</h3>
                    <p>Giá: 600 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh29.png" alt="Suzuki Swift">
                    <h3>Suzuki Swift</h3>
                    <p>Gi: 600 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh33.png" alt="Mercedes-Benz C-Class">
                    <h3>Mercedes-Benz C-Class</h3>
                    <p>Giá: 600 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh34.png" alt="BMW 3 Series">
                    <h3>BMW 3 Series</h3>
                    <p>Giá: 600 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh35.png" alt="Audi A4">
                    <h3>Audi A4</h3>
                    <p>Giá: 600 triệu VND</p>
                </div>
                <div class="product-item">
                    <img src="image/hinh36.png" alt="Volvo XC60">
                    <h3>Volvo XC60</h3>
                    <p>Giá: 600 triệu VND</p>
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

    <div class="Copyright">
        <p>&copy; CARLOI</p>
    </div>

   
        <script>
            document.querySelector('.search-button').addEventListener('click', function() {
                var searchTerm = document.querySelector('.search-input').value.toLowerCase();
                var productItems = document.querySelectorAll('.product-item');
        
                productItems.forEach(function(item) {
                    var productName = item.querySelector('h3').textContent.toLowerCase();
                    
                    if (productName.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {               
                const filterAll = document.querySelector('.gallery-filter li');
                const productItems = document.querySelectorAll('.product-item');
                filterAll.addEventListener('click', function() {
                    document.querySelector('.gallery-filter .active').classList.remove('active');
                    filterAll.classList.add('active');          
                    productItems.forEach(item => {
                        item.classList.add('show');
                    });
                });
            });
        </script>
        <script>
         
            const filterItems = document.querySelectorAll('.gallery-filter li');
            const allItems = document.querySelectorAll('.product-item');
    
            filterItems.forEach(item => {
                item.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');
                    filterItems.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
    
                    if (filter === "*") {
                        allItems.forEach(item => item.style.display = "block"); 
                    } else {
                        allItems.forEach(item => {
                            if (item.classList.contains(filter)) {
                                item.style.display = "block";
                            } else {
                                item.style.display = "none"; 
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            document.querySelectorAll('.product-item button.buy-now').forEach(function(button) {
                button.addEventListener('click', function() {
                    window.location.href = 'product-detail-page.html'; // Redirect to the product detail page
                });
            });
            
        </script>

    <script>
        const cartIcon = document.querySelector('.cart-icon');
        const cartModal = document.querySelector('.cart-modal');
        const cartItems = document.querySelector('.cart-items');
        const cartCount = document.querySelector('.cart-count');
        let cart = [];

        // Toggle cart modal
        cartIcon.addEventListener('click', () => {
            cartModal.style.display = cartModal.style.display === 'none' ? 'block' : 'none';
        });

        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', (e) => {
                const productItem = e.target.closest('.product-item');
                const product = {
                    name: productItem.querySelector('h3').textContent,
                    price: productItem.querySelector('p').textContent,
                    image: productItem.querySelector('img').src
                };
                
                addToCart(product);
                updateCartDisplay();
            });
        });

        function addToCart(product) {
            cart.push(product);
            cartCount.textContent = cart.length;
        }

        function updateCartDisplay() {
            cartItems.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="cart-item-details">
                        <h4>${item.name}</h4>
                        <p>${item.price}</p>
                    </div>
                </div>
            `).join('');
        }

        // Close cart when clicking outside
        document.addEventListener('click', (e) => {
            if (!cartModal.contains(e.target) && !cartIcon.contains(e.target)) {
                cartModal.style.display = 'none';
            }
        });
    </script>

</body>
</html>