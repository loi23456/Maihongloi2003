<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua Xe</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* General Styles */
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #2c3e50;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Form Styles */
        #contact-form {
            padding: 4rem 2rem;
            margin-top: 40px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .contact-form-box {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1),
                        0 5px 15px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
        }

        .contact-form-box h3 {
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 40px;
            color: #1a237e;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }

        .contact-form-box h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #e90e19, #b10016);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group input,
        .form-group textarea,
        select {
            width: 100%;
            padding: 15px 20px;
            font-size: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background-color: #fff;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        select:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        .form-group label {
            font-weight: 600;
            color: #34495e;
            font-size: 1rem;
            margin-bottom: 10px;
            display: block;
            transition: all 0.3s ease;
        }

        /* Button Styles */
        .buy-now-btn, .view-cart-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #e90e19 0%, #b10016 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .buy-now-btn:hover, .view-cart-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(233, 14, 25, 0.4);
        }

        .buy-now-btn:active, .view-cart-btn:active {
            transform: translateY(1px);
        }

        /* Cart Styles */
        #cart {
            display: none;
            position: fixed;
            top: 40px;
            right: 40px;
            background: rgba(255, 255, 255, 0.98);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15),
                        0 10px 20px rgba(0, 0, 0, 0.1);
            width: 380px;
            max-height: 80vh;
            overflow-y: auto;
            z-index: 9999;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(10px);
        }

        #cart h3 {
            margin-bottom: 25px;
            font-size: 1.6rem;
            color: #1a237e;
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            font-weight: 700;
        }

        #cart-content {
            padding: 15px 0;
        }

        #cart-content p {
            margin: 10px 0;
            font-size: 0.95rem;
            line-height: 1.6;
            color: #34495e;
        }

        #cart button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #e90e19 0%, #b10016 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        #cart button:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(233, 14, 25, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-form-box {
                padding: 25px;
                margin: 0 15px;
            }

            #cart {
                width: 90%;
                max-width: 380px;
                right: 50%;
                transform: translateX(50%);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #e90e19;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b10016;
        }
    </style>
</head>
<body>

<section id="contact-form">
    <div class="container">
        <div class="contact-form-box">
            <h3>Mua Xe</h3>
            <form id="car-form" action="#" method="POST">
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
                    <label for="car-type">Chọn loại xe</label>
                    <select id="car-type" name="car-type" required>
                        <option value="">Chọn loại xe</option>
                        <option value="BMW">BMW </option>
                        <option value="AUDI">Audi</option>
                        <option value="Lamborghini">Lamborghini</option>
                        <option value="Mercedes-Benz">Mercedes-Benz</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="delivery-location">Địa điểm giao xe</label>
                    <select id="delivery-location" name="delivery-location" required>
                        <option value="">Chọn địa điểm giao xe</option>
                        <option value="city">Thành phố Trà Vinh</option>
                        <option value="town">Thị xã Duyên Hải</option>
                        <option value="canglong">Càng Long</option>
                        <option value="cauke">Cầu Kè</option>
                        <option value="caungang">Cầu Ngang</option>
                        <option value="chauthanh">Châu Thành</option>
                        <option value="tracu">Trà Cú</option>
                        <option value="duyenhai">Duyên Hải</option>
                        <option value="tieucan">Tiểu Cần</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickup-date">Ngày nhận xe</label>
                    <input type="date" id="pickup-date" name="pickup-date" required>
                </div>

                <div class="form-group">
                    <label for="customer-message">Tin nhắn</label>
                    <textarea id="customer-message" name="customer-message" rows="4" placeholder="Nhập tin nhắn của bạn"></textarea>
                </div>

                <a href="Thông báo.html">
                    <button type="button" class="buy-now-btn" id="buy-now-btn">Mua Ngay</button>
                </a>
            </form>
        </div>
    </div>
</section>

<script>
    document.getElementById('buy-now-btn').addEventListener('click', function() {
        const customerName = document.getElementById('customer-name').value;
        const customerPhone = document.getElementById('customer-phone').value;
        const customerEmail = document.getElementById('customer-email').value;
        const carType = document.getElementById('car-type').value;
        const deliveryLocation = document.getElementById('delivery-location').value;
        const pickupDate = document.getElementById('pickup-date').value;
        const customerMessage = document.getElementById('customer-message').value;
    
        // Check if all fields are filled
        if (customerName && customerPhone && customerEmail && carType && deliveryLocation && pickupDate) {
            // Form is valid, the link to Thông báo.html will handle the redirect
        } else {
            alert("Vui lòng điền đầy đủ thông tin.");
        }
    });
</script>

</body>
</html>
