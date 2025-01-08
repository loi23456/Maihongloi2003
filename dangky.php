<?php
session_start();
require_once('connect.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ho_ten = $_POST['ho_ten'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $email = $_POST['email'];
    $dia_chi = $_POST['dia_chi'];
    $cmnd_cccd = $_POST['cmnd_cccd'];

    try {
        // Kiểm tra email đã tồn tại chưa
        $stmt = $conn->prepare("SELECT COUNT(*) FROM khach_hang WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Email đã được sử dụng!';
        } else {
            // Thêm khách hàng mới
            $stmt = $conn->prepare("INSERT INTO khach_hang (ho_ten, so_dien_thoai, email, dia_chi, cmnd_cccd, ngay_tao) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$ho_ten, $so_dien_thoai, $email, $dia_chi, $cmnd_cccd]);
            
            $success = 'Đăng ký thành công! Đang chuyển hướng...';
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'dangnhap.php';
                }, 2000);
            </script>";
        }
    } catch(PDOException $e) {
        $error = 'Có lỗi xảy ra, vui lòng thử lại sau!';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - CARLOI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        .title {
            text-align: center;
            color: #333;
            margin-bottom: 35px;
            font-size: 28px;
            font-weight: 600;
            position: relative;
        }

        .title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: 500;
            font-size: 15px;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #9b59b6;
            box-shadow: 0 0 0 3px rgba(155, 89, 182, 0.1);
            outline: none;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #9b59b6, #71b7e6);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(155, 89, 182, 0.3);
        }

        .error-message {
            background-color: #fff3f3;
            color: #dc3545;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #dc3545;
            text-align: left;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 15px;
            color: #666;
        }

        .login-link a {
            color: #9b59b6;
            font-weight: 600;
            text-decoration: none;
            margin-left: 5px;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #71b7e6;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .container {
                padding: 25px;
                margin: 15px;
            }

            .title {
                font-size: 24px;
            }

            .form-control {
                padding: 12px;
            }

            .btn-register {
                padding: 12px;
            }
        }

        /* Animation for form elements */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            animation: fadeIn 0.5s ease forwards;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.1s;
        }

        .btn-register {
            animation: fadeIn 0.5s ease forwards;
            animation-delay: 0.2s;
        }

        /* Custom placeholder color */
        ::placeholder {
            color: #aaa;
            opacity: 1;
        }

        /* Focus effects */
        .form-control:focus {
            border-color: #9b59b6;
            background: #fff;
        }

        /* Hover effects for inputs */
        .form-control:hover {
            border-color: #71b7e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Đăng ký tài khoản CARLOI</div>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="ho_ten">Họ và tên</label>
                <input type="text" class="form-control" id="ho_ten" name="ho_ten" required>
            </div>

            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại</label>
                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="dia_chi">Địa chỉ</label>
                <input type="text" class="form-control" id="dia_chi" name="dia_chi" required>
            </div>

            <div class="form-group">
                <label for="cmnd_cccd">CMND/CCCD</label>
                <input type="text" class="form-control" id="cmnd_cccd" name="cmnd_cccd" required>
            </div>

            <button type="submit" class="btn-register">Đăng ký</button>

            <div class="login-link">
                Đã có tài khoản? <a href="dangnhap.php">Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
</html>