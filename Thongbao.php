<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua Hàng Thành Công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .cover-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .logo {
            margin-top: 20px;
            width: 450px;
            height: auto;
        }

        h1 {
            color: #e91010;
            margin-top: 40px;
        }

        p {
            margin-bottom: 70px;
            color: #e91010;
        }

        header a {
            text-decoration: none;
            color: #e91010;
        }

        a {
            text-decoration: none;
            color: #e91010;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        
    </style>
</head>
<body>
    

    <h1>Cảm ơn bạn đã mua hàng!</h1>
    <p>Thông tin mua hàng của bạn đã được ghi nhận thành công.</p>
    <a href="CarPoint.html">Quay lại trang chủ</a>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
