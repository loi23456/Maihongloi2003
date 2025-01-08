<?php
session_start();
// Kiểm tra session
// Thêm vào đầu file
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Trong phần xử lý phản hồi, thêm log
error_log("POST data: " . print_r($_POST, true));
// Cấu hình database và upload
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dacsn');

// Kết nối CSDL
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

error_log("Database info: " . print_r([
    'host' => DB_HOST,
    'user' => DB_USER,
    'database' => DB_NAME,
    'connected' => ($conn && !$conn->connect_error) ? 'yes' : 'no',
    'error' => $conn->connect_error ?? 'none'
], true));

// Thêm truy vấn SQL để lấy danh sách dịch vụ
$sql = "SELECT id, ten_dich_vu, chi_tiet_dich_vu, gia_dich_vu, thoi_gian_bao_hanh, thao_tac, hinh_anh, trang_thai 
        FROM dich_vu 
        WHERE trang_thai = 'Đang hoạt động'";
$result = mysqli_query($conn, $sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Lấy tất cả các dịch vụ
$services = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Hàm lấy danh sách người dùng
function getDanhSachNguoiDung($conn) {
    try {
        $sql = "SELECT * FROM nguoi_dung ORDER BY ngay_tao DESC";
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Lỗi truy vấn người dùng: " . $conn->error);
            return [];
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Lỗi trong getDanhSachNguoiDung: " . $e->getMessage());
        return [];
    }
}

// Khởi tạo danh sách người dùng
$danhSachNguoiDung = getDanhSachNguoiDung($conn);

// Kiểm tra và log số lượng người dùng
error_log("Số lượng người dùng: " . count($danhSachNguoiDung));

// Hàm lấy danh sách bình luận
function getDanhSachBinhLuan($conn) {
    try {
        $sql = "SELECT bl.*, 
                nd.ho_ten as ten_nguoi_dung,
                nd.email as email_nguoi_dung,
                nd.ten_dang_nhap
                FROM binh_luan bl
                LEFT JOIN nguoi_dung nd ON bl.id_nguoi_dung = nd.id 
                ORDER BY bl.ngay_tao DESC";
        
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Lỗi truy vấn bình luận: " . $conn->error);
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Lỗi trong getDanhSachBinhLuan: " . $e->getMessage());
        return [];
    }
}

// Khởi tạo danh sách bình luận
$danhSachBinhLuan = getDanhSachBinhLuan($conn);

// Kiểm tra và log số lượng bình luận
error_log("Số lượng bình luận: " . count($danhSachBinhLuan));

// Thêm vào đầu file sau phần kết nối database
if (isset($_POST['action']) && $_POST['action'] === 'phan_hoi_binh_luan') {
    header('Content-Type: application/json');
    
    try {
        // Kiểm tra dữ liệu đầu vào
        if (!isset($_POST['comment_id']) || !isset($_POST['phan_hoi'])) {
            throw new Exception('Thiếu thông tin cần thiết');
        }

        $commentId = (int)$_POST['comment_id'];
        $phanHoi = trim($_POST['phan_hoi']);
        
        if (empty($phanHoi)) {
            throw new Exception('Vui lòng nhập nội dung phản hồi');
        }

        // Log để debug
        error_log("Processing comment reply - ID: $commentId, Content: $phanHoi");

        $sql = "UPDATE binh_luan 
                SET phan_hoi = ?, 
                    nguoi_phan_hoi = 'Quản trị viên', 
                    ngay_cap_nhat = NOW() 
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Lỗi prepare statement: ' . $conn->error);
        }

        $stmt->bind_param("si", $phanHoi, $commentId);
        
        if (!$stmt->execute()) {
            throw new Exception('Lỗi khi cập nhật: ' . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Phản hồi thành công',
                'phan_hoi' => $phanHoi,
                'nguoi_phan_hoi' => 'Quản trị viên',
                'ngay_cap_nhat' => date('d/m/Y H:i')
            ]);
            error_log("Reply updated successfully");
        } else {
            throw new Exception('Không tìm thấy bình luận hoặc không có thay đổi');
        }

    } catch (Exception $e) {
        error_log("Error in comment reply: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Xử LÝ NGƯỜI DÙNG VÀ BÌNH LUẬN
// Hàm lấy danh sách bình luận
function getComments($conn) {
    try {
        $sql = "SELECT bl.*, 
                nd.ho_ten as ten_nguoi_dung,
                nd.email as email_nguoi_dung,
                nd.ten_dang_nhap
                FROM binh_luan bl
                LEFT JOIN nguoi_dung nd ON bl.id_nguoi_dung = nd.id 
                ORDER BY bl.ngay_tao DESC";
        
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Lỗi truy vấn: " . $conn->error);
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Lỗi trong getComments: " . $e->getMessage());
        return [];
    }
}
// Xử lý xóa người dùng
if (isset($_POST['xoa_nguoi_dung'])) {
    header('Content-Type: application/json');
    try {
        $userId = (int)$_POST['user_id'];
        
        $sql = "SELECT id, vai_tro FROM nguoi_dung WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        if (!$user) {
            throw new Exception('Người dùng không tồn tại');
        }
        
        if ($user['vai_tro'] == 1) {
            throw new Exception('Không thể xóa tài khoản admin');
        }
        
        $sql = "DELETE FROM nguoi_dung WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => 'Xóa người dùng thành công'
            ]);
        } else {
            throw new Exception('Không thể xóa người dùng');
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Xử lý đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: dangnhapAdmin.php');
    exit;
}

// Thêm hàm lấy danh sách sản phẩm
function getDanhSachSanPham($conn) {
    try {
        $sql = "SELECT * FROM san_pham ORDER BY ngay_tao DESC";
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Lỗi truy vấn sản phẩm: " . $conn->error);
            return [];
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Lỗi trong getDanhSachSanPham: " . $e->getMessage());
        return [];
    }
}

// Thêm hàm lấy danh sách đơn hàng
function getDanhSachDonHang($conn) {
    try {
        $sql = "SELECT dh.*, nd.ho_ten, nd.email 
                FROM don_hang dh 
                LEFT JOIN nguoi_dung nd ON dh.id_nguoi_dung = nd.id 
                ORDER BY dh.ngay_tao DESC";
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Lỗi truy vấn đơn hàng: " . $conn->error);
            return [];
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Lỗi trong getDanhSachDonHang: " . $e->getMessage());
        return [];
    }
}

// Thêm vào đầu file, ngay sau session_start()
if (isset($_POST['action'])) {
    header('Content-Type: application/json; charset=utf-8');
    
    // Kiểm tra và log request
    error_log("Received action: " . $_POST['action']);
    error_log("POST data: " . print_r($_POST, true));
    
    if ($_POST['action'] === 'them_dich_vu') {
        try {
            // Validate input
            if (empty($_POST['ten_dich_vu'])) {
                throw new Exception('Tên dịch vụ không được để trống');
            }

            $tenDichVu = trim($_POST['ten_dich_vu']);
            $chiTietDichVu = trim($_POST['chi_tiet_dich_vu']);
            $giaDichVu = (float)$_POST['gia_dich_vu'];
            $thoiGianBaoHanh = (int)$_POST['thoi_gian_bao_hanh'];
            $thaoTac = !empty($_POST['thao_tac']) ? trim($_POST['thao_tac']) : 'Đang hoạt động';

            // Xử lý upload ảnh
            $hinhAnh = null;
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === 0) {
                $uploadDir = 'uploads/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $file = $_FILES['hinh_anh'];
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                    throw new Exception('Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif)');
                }

                $hinhAnh = uniqid() . '.' . $ext;
                $uploadPath = $uploadDir . $hinhAnh;

                if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    throw new Exception('Không thể upload file');
                }
            }

            // Thêm vào database
            $sql = "INSERT INTO dich_vu (ten_dich_vu, chi_tiet_dich_vu, gia_dich_vu, thoi_gian_bao_hanh, hinh_anh, thao_tac) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Lỗi prepare statement: " . $conn->error);
            }

            $stmt->bind_param("ssdiss", $tenDichVu, $chiTietDichVu, $giaDichVu, $thoiGianBaoHanh, $hinhAnh, $thaoTac);
            
            if (!$stmt->execute()) {
                throw new Exception("Lỗi khi thêm dịch vụ: " . $stmt->error);
            }

            $newId = $conn->insert_id;

            echo json_encode([
                'success' => true,
                'message' => 'Thêm dịch vụ thành công',
                'data' => [
                    'id' => $newId,
                    'ten_dich_vu' => $tenDichVu,
                    'chi_tiet_dich_vu' => $chiTietDichVu,
                    'gia_dich_vu' => number_format($giaDichVu, 0, ',', '.'),
                    'thoi_gian_bao_hanh' => $thoiGianBaoHanh,
                    'hinh_anh' => $hinhAnh,
                    'thao_tac' => $thaoTac
                ]
            ]);

        } catch (Exception $e) {
            error_log("Error in them_dich_vu: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
}

// Hàm lấy danh sách dịch vụ
function getDanhSachDichVu($conn) {
    try {
        // Bỏ điều kiện WHERE để lấy tất cả dịch vụ
        $sql = "SELECT id, ten_dich_vu, chi_tiet_dich_vu, gia_dich_vu, 
                thoi_gian_bao_hanh, hinh_anh, thao_tac 
                FROM dich_vu 
                ORDER BY id DESC";
                
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Lỗi truy vấn dịch vụ: " . $conn->error);
            return [];
        }
        
        $services = [];
        while ($row = $result->fetch_assoc()) {
            $services[] = [
                'id' => $row['id'],
                'ten_dich_vu' => htmlspecialchars($row['ten_dich_vu']),
                'chi_tiet_dich_vu' => htmlspecialchars($row['chi_tiet_dich_vu']),
                'gia_dich_vu' => number_format($row['gia_dich_vu'], 0, ',', '.'),
                'thoi_gian_bao_hanh' => $row['thoi_gian_bao_hanh'],
                'hinh_anh' => $row['hinh_anh'],
                'thao_tac' => $row['thao_tac']
            ];
        }
        
        return $services;
        
    } catch (Exception $e) {
        error_log("Lỗi trong getDanhSachDichVu: " . $e->getMessage());
        return [];
    }
}

// Xử lý cập nhật dịch vụ
if (isset($_POST['action']) && $_POST['action'] === 'cap_nhat_dich_vu') {
    header('Content-Type: application/json');
    try {
        if (!isset($_POST['id'])) {
            throw new Exception('Thiếu ID dịch vụ');
        }

        $id = (int)$_POST['id'];
        $tenDichVu = trim($_POST['ten_dich_vu']);
        $chiTietDichVu = trim($_POST['chi_tiet_dich_vu']);
        $giaDichVu = (float)$_POST['gia_dich_vu'];
        $thoiGianBaoHanh = (int)$_POST['thoi_gian_bao_hanh'];
        $thaoTac = trim($_POST['thao_tac']);

        // Validate dữ liệu
        if (empty($tenDichVu)) throw new Exception('Tên dịch vụ không được để trống');
        if (empty($chiTietDichVu)) throw new Exception('Chi tiết dịch vụ không được để trống');
        if ($giaDichVu <= 0) throw new Exception('Giá dịch vụ phải lớn hơn 0');
        if ($thoiGianBaoHanh < 0) throw new Exception('Thời gian bảo hành không hợp lệ');

        $sql = "UPDATE dich_vu SET 
                ten_dich_vu = ?,
                chi_tiet_dich_vu = ?,
                gia_dich_vu = ?,
                thoi_gian_bao_hanh = ?,
                thao_tac = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("L���i prepare statement: " . $conn->error);
        }

        $stmt->bind_param("ssdiss", $tenDichVu, $chiTietDichVu, $giaDichVu, $thoiGianBaoHanh, $thaoTac, $id);

        if (!$stmt->execute()) {
            throw new Exception("Lỗi execute statement: " . $stmt->error);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật thành công'
        ]);

    } catch (Exception $e) {
        error_log("Lỗi cập nhật dịch vụ: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Xử lý xóa dịch vụ
if(isset($_POST['action']) && $_POST['action'] === 'xoa_dich_vu') {
    header('Content-Type: application/json');
    
    try {
        if(!isset($_POST['id'])) {
            throw new Exception('Thiếu ID dịch vụ');
        }
        
        $id = (int)$_POST['id'];
        
        // Lấy thông tin hình ảnh trước khi xóa
        $sql = "SELECT hinh_anh FROM dich_vu WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Lỗi prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()) {
            // Xóa file ảnh nếu tồn tại
            if(!empty($row['hinh_anh'])) {
                $imagePath = 'uploads/' . $row['hinh_anh'];
                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        
        // Xóa dịch vụ từ database
        $sql = "DELETE FROM dich_vu WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Lỗi prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $id);
        
        if(!$stmt->execute()) {
            throw new Exception("Lỗi khi xóa dịch vụ: " . $stmt->error);
        }
        
        echo json_encode([
            'success' => true,
            'message' => 'Xóa dịch vụ thành công'
        ]);
        
    } catch(Exception $e) {
        error_log("Error in xoa_dich_vu: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Xử lý sửa dịch vụ
if(isset($_POST['action']) && $_POST['action'] === 'sua_dich_vu') {
    header('Content-Type: application/json');
    
    try {
        if(!isset($_POST['id'])) {
            throw new Exception('Thiếu ID dịch vụ');
        }

        $id = (int)$_POST['id'];
        $tenDichVu = trim($_POST['ten_dich_vu']);
        $chiTietDichVu = trim($_POST['chi_tiet_dich_vu']);
        $giaDichVu = (float)$_POST['gia_dich_vu'];
        $thoiGianBaoHanh = (int)$_POST['thoi_gian_bao_hanh'];
        $thaoTac = trim($_POST['thao_tac']);

        // Validate dữ liệu
        if(empty($tenDichVu)) throw new Exception('Tên dịch vụ không được để trống');
        if($giaDichVu <= 0) throw new Exception('Giá dịch vụ phải lớn hơn 0');
        if($thoiGianBaoHanh < 0) throw new Exception('Thời gian bảo hành không hợp lệ');

        // Xử lý upload ảnh mới nếu có
        $updateImage = false;
        $hinhAnh = null;
        if(isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === 0) {
            $file = $_FILES['hinh_anh'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            
            if(!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new Exception('Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif)');
            }

            // Tạo tên file mới
            $hinhAnh = uniqid() . '.' . $ext;
            $uploadPath = 'uploads/' . $hinhAnh;

            // Upload file mới
            if(!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                throw new Exception('Không thể upload file');
            }

            $updateImage = true;

            // Xóa ảnh cũ
            $sql = "SELECT hinh_anh FROM dich_vu WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Lỗi prepare statement: " . $conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($row = $result->fetch_assoc()) {
                if(!empty($row['hinh_anh'])) {
                    $oldImagePath = 'uploads/' . $row['hinh_anh'];
                    if(file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
        }

        // Cập nhật thông tin trong database
        if($updateImage) {
            $sql = "UPDATE dich_vu SET 
                    ten_dich_vu = ?,
                    chi_tiet_dich_vu = ?,
                    gia_dich_vu = ?,
                    thoi_gian_bao_hanh = ?,
                    hinh_anh = ?,
                    thao_tac = ?
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Lỗi prepare statement: " . $conn->error);
            }
            $stmt->bind_param("ssdissi", $tenDichVu, $chiTietDichVu, $giaDichVu, 
                             $thoiGianBaoHanh, $hinhAnh, $thaoTac, $id);
        } else {
            $sql = "UPDATE dich_vu SET 
                    ten_dich_vu = ?,
                    chi_tiet_dich_vu = ?,
                    gia_dich_vu = ?,
                    thoi_gian_bao_hanh = ?,
                    thao_tac = ?
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Lỗi prepare statement: " . $conn->error);
            }
            $stmt->bind_param("ssdssi", $tenDichVu, $chiTietDichVu, $giaDichVu, 
                             $thoiGianBaoHanh, $thaoTac, $id);
        }

        if(!$stmt->execute()) {
            throw new Exception("Lỗi khi cập nhật dịch vụ: " . $stmt->error);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật dịch vụ thành công',
            'data' => [
                'id' => $id,
                'ten_dich_vu' => $tenDichVu,
                'chi_tiet_dich_vu' => $chiTietDichVu,
                'gia_dich_vu' => number_format($giaDichVu, 0, ',', '.'),
                'thoi_gian_bao_hanh' => $thoiGianBaoHanh,
                'hinh_anh' => $updateImage ? $hinhAnh : null,
                'thao_tac' => $thaoTac
            ]
        ]);

    } catch(Exception $e) {
        error_log("Error in sua_dich_vu: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Xử lý cập nhật trạng thái dịch vu
if (isset($_POST['action']) && $_POST['action'] === 'cap_nhat_trang_thai') {
    header('Content-Type: application/json');
    try {
        if (!isset($_POST['id']) || !isset($_POST['thao_tac'])) {
            throw new Exception('Thiếu thông tin cần thiết');
        }

        $id = (int)$_POST['id'];
        $thaoTac = trim($_POST['thao_tac']);

        // Validate trạng thái
        if (!in_array($thaoTac, ['Đang hoạt động', 'Tạm ngưng'])) {
            throw new Exception('Trạng thái không hợp lệ');
        }

        $sql = "UPDATE dich_vu SET thao_tac = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception('Lỗi prepare statement: ' . $conn->error);
        }

        $stmt->bind_param("si", $thaoTac, $id);
        
        if (!$stmt->execute()) {
            throw new Exception('Lỗi khi cập nhật trạng thái: ' . $stmt->error);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công',
            'thao_tac' => $thaoTac
        ]);

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Khởi tạo các danh sách mới
$danhSachSanPham = getDanhSachSanPham($conn);
$danhSachDonHang = getDanhSachDonHang($conn);
$danhSachDichVu = getDanhSachDichVu($conn);
$services = getDanhSachDichVu($conn);

// Ensure the connection is open before closing
if ($conn && !$conn->connect_error) {
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Tri viên - CARLOI</title>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
    /* Reset và thiết lập cơ bản */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f6fa;
        color: #2d3436;
        min-height: 100vh;
        display: flex;
    }

    /* Sidebar styles */
    .sidebar {
        width: 250px;
        background: #2c3e50;
        min-height: 100vh;
        padding: 20px 0;
        position: fixed;
        left: 0;
        top: 0;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .sidebar-header {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .admin-avatar {
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        background: #34495e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .admin-avatar i {
        font-size: 40px;
        color: #ecf0f1;
    }

    .sidebar-header h2 {
        color: #ecf0f1;
        font-size: 1.2rem;
        margin: 0;
    }

    .sidebar-menu {
        list-style: none;
        padding: 20px 0;
    }

    .menu-item a {
        display: flex;
        align-items: center;
        padding: 15px 25px;
        color: #ecf0f1;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .menu-item a:hover {
        background: #34495e;
        padding-left: 30px;
    }

    .menu-item i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    /* Main content styles */
    .main-content {
        margin-left: 250px;
        padding: 30px;
        width: calc(100% - 250px);
    }

    /* Table container styles */
    .table-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f2f6;
    }

    .section-header h2 {
        font-size: 1.5rem;
        color: #2c3e50;
        margin: 0;
    }

    /* Table styles */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table th {
        background: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: 2px solid #e9ecef;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .data-table tr:hover {
        background-color: #f8f9fa;
    }

    /* Button styles */
    .btn {
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }

    .btn i {
        margin-right: 5px;
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-warning {
        background: #f1c40f;
        color: white;
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    /* Search input styles */
    .search-container {
        position: relative;
    }

    .search-input {
        padding: 8px 35px 8px 15px;
        border: 1px solid #dcdde1;
        border-radius: 5px;
        width: 250px;
        font-size: 0.9rem;
    }

    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #7f8c8d;
    }

    /* Status select styles */
    select {
        padding: 6px 10px;
        border: 1px solid #dcdde1;
        border-radius: 4px;
        background: white;
        cursor: pointer;
    }

    /* Image styles */
    .product-image, .service-image {
        max-width: 80px;
        max-height: 80px;
        border-radius: 5px;
        object-fit: cover;
    }

    /* Modal improvements */
    .modal-content {
        border-radius: 10px;
        border: none;
    }

    .modal-header {
        background: #f8f9fa;
        border-radius: 10px 10px 0 0;
    }

    .modal-footer {
        background: #f8f9fa;
        border-radius: 0 0 10px 10px;
    }

    /* Form styles */
    .form-control {
        border: 1px solid #dcdde1;
        padding: 8px 12px;
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
    }
    .table-users,
    .table-products,
    .table-orders {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .image-upload-container {
    position: relative;
    width: 100%;
}

.preview-container {
    position: relative;
    width: 200px;
    height: 200px;
    margin-bottom: 10px;
    border-radius: 8px;
    overflow: hidden;
}

#preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    padding: 5px 8px;
    border-radius: 50%;
}

.service-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}

.service-image:hover {
    transform: scale(1.1);
    cursor: pointer;
}

.preview-container {
    position: relative;
    width: 200px;
    height: 200px;
    margin-bottom: 10px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

#preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
#viewImageModal .modal-body {
    padding: 0;
}

#viewImageModal .img-fluid {
    max-height: 80vh;
    object-fit: contain;
}

#viewImageModal .modal-content {
    background-color: rgba(255, 255, 255, 0.95);
}

#viewImageModal .modal-header {
    border-bottom: none;
    background-color: rgba(255, 255, 255, 0.9);
}

#viewImageModal .modal-dialog {
    max-width: 90vw;
    margin: 1.75rem auto;
}
/* Ẩn text hiển thị tên file */
.form-control[type="file"] {
    color: transparent;
}

.form-control[type="file"]::-webkit-file-upload-button {
    visibility: hidden;
}

.form-control[type="file"]::before {
    content: 'Chọn ảnh';
    color: #fff;
    background-color: #0d6efd;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    margin-right: 8px;
}

.form-control[type="file"]:hover::before {
    background-color: #0b5ed7;
}

.image-upload-container {
    position: relative;
}

.preview-container {
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}

.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    padding: 2px 6px;
    border-radius: 50%;
}

#preview-image {
    border-radius: 4px;
    border: 1px solid #ddd;
    padding: 3px;
}

.trang-thai-select {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
    background-color: white;
    width: 150px;
}

.trang-thai-select option {
    padding: 5px;
}
</style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="admin-avatar">
            <i class="fas fa-user-shield"></i>
        </div>
             <h2>Quản Trị Viên</h2>
        </div>
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="index.php">
                <i class="fas fa-home"></i>
                <span>Trang chủ</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="?action=logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
    <!-- Bảng quản lý người dùng -->
    <div class="table-users">
        <div class="section-header">
            <h2>QUẢN LÝ NGƯỜI DÙNG</h2>
        <div class="search-container">
            <input type="text" id="timKiemNguoiDung" class="search-input" placeholder="Tìm kiếm người dùng">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Gmail</th>
                <th>Địa Chỉ</th>
                <th>Vai trò</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($danhSachNguoiDung as $nguoiDung): ?>
            <tr>
                <td><?php echo htmlspecialchars($nguoiDung['ten_dang_nhap']); ?></td>
                <td><?php echo htmlspecialchars($nguoiDung['ho_ten']); ?></td>
                <td><?php echo htmlspecialchars($nguoiDung['email']); ?></td>
                <td><?php echo $nguoiDung['vai_tro'] == 1 ? 'Admin' : 'Ngưi dùng'; ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($nguoiDung['ngay_tao'])); ?></td>
                <td>
                    <?php if($nguoiDung['vai_tro'] != 1): ?>
                        <button class="btn btn-danger xoa-nguoi-dung" data-id="<?php echo $nguoiDung['id']; ?>">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="table-products">
        <div class="section-header">
            <h2>QUẢN LÝ SẢN PHẨM</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSanPham">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </button>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Thương Hiệu</th>
                <th>Năm Sản xuất </th>
                <th>Giá Bán</th>
                <th>Mô ta</th>
                <th>Hình nh</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($danhSachSanPham as $sanPham): ?>
            <tr>
                <td><?php echo htmlspecialchars($sanPham['ten_san_pham']); ?></td>
                <td><?php echo number_format($sanPham['gia'], 0, ',', '.'); ?>đ</td>
                <td><?php echo htmlspecialchars($sanPham['mo_ta']); ?></td>
                <td>
                    <?php if($sanPham['hinh_anh']): ?>
                        <img src="<?php echo htmlspecialchars($sanPham['hinh_anh']); ?>" class="product-image" alt="Hình ảnh sản phẩm">
                    <?php endif; ?>
                </td>
                <td>
                    <select class="trang-thai-san-pham" data-id="<?php echo $sanPham['id']; ?>">
                        <option value="1" <?php echo $sanPham['trang_thai'] == 1 ? 'selected' : ''; ?>>Hiển thị</option>
                        <option value="0" <?php echo $sanPham['trang_thai'] == 0 ? 'selected' : ''; ?>>Ẩn</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-warning sua-san-pham" data-id="<?php echo $sanPham['id']; ?>">
                        <i class="fas fa-edit"></i> Sửa
                    </button>
                    <button class="btn btn-danger xoa-san-pham" data-id="<?php echo $sanPham['id']; ?>">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="modalSanPham">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSanPhamLabel">Thêm Sản Phẩm Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSanPham">
                    <div class="mb-3">
                        <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham" required>
                    </div>
                    <div class="mb-3">
                        <label for="gia" class="form-label">Giá</label>
                        <input type="number" class="form-control" id="gia" name="gia" required>
                    </div>
                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<div class="table-orders">
        <div class="section-header">
            <h2>QUẢN LÝ ĐƠN ĐẶT HÀNG</h2>
        <div class="search-container">
            <input type="text" id="timKiemDonHang" class="search-input" placeholder="Tìm kiếm đơn hàng">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($danhSachDonHang as $donHang): ?>
            <tr>
                <td><?php echo htmlspecialchars($donHang['ma_don_hang']); ?></td>
                <td><?php echo htmlspecialchars($donHang['ho_ten']); ?></td>
                <td><?php echo htmlspecialchars($donHang['email']); ?></td>
                <td><?php echo number_format($donHang['tong_tien'], 0, ',', '.'); ?>đ</td>
                <td><?php echo date('d/m/Y H:i', strtotime($donHang['ngay_tao'])); ?></td>
                <td>
                    <select class="trang-thai-don-hang" data-id="<?php echo $donHang['id']; ?>">
                        <option value="0" <?php echo $donHang['trang_thai'] == 0 ? 'selected' : ''; ?>>Chờ xử lý</option>
                        <option value="1" <?php echo $donHang['trang_thai'] ==1 ? 'selected' : ''; ?>>Đã xác nhận</option>
                        <option value="2" <?php echo $donHang['trang_thai'] ==2 ? 'selected' : ''; ?>>ang giao</option>
                        <option value="3" <?php echo $donHang['trang_thai'] ==3 ? 'selected' : ''; ?>>Đã hoàn thành</option>
                        <option value="4" <?php echo $donHang['trang_thai'] ==4 ? 'selected' : ''; ?>>Đã hủy</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-primary xem-chi-tiet" data-id="<?php echo $donHang['id']; ?>">
                        <i class="fas fa-eye"></i> Chi tiết
                    </button>
                    <button class="btn btn-danger huy-don-hang" data-id="<?php echo $donHang['id']; ?>">
                        <i class="fas fa-times"></i> Hủy
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Bảng quản lý dịch vụ -->
<div class="table-container" id="dichVuSection">
    <div class="section-header">
        <h2>QUẢN LÝ DỊCH VỤ</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDichVu">
            <i class="fas fa-plus"></i> Thêm dịch vụ
        </button>
    </div>
    <table class="data-table" id="dichVuTable">
    <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên dịch vụ</th>
            <th>Chi Tiết Dịch Vụ</th>
            <th>Giá Dịch Vụ</th>
            <th>Thời gian bảo hành</th>
            <th>Thao tác</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($danhSachDichVu)): ?>
            <?php foreach($danhSachDichVu as $dichVu): ?>
                <tr data-id="<?php echo $dichVu['id']; ?>">
                    <td>
                        <?php if($dichVu['hinh_anh']): ?>
                            <img src="uploads/<?php echo htmlspecialchars($dichVu['hinh_anh']); ?>" 
                                 class="service-image" 
                                 alt="<?php echo htmlspecialchars($dichVu['ten_dich_vu']); ?>">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $dichVu['ten_dich_vu']; ?></td>
                    <td><?php echo $dichVu['chi_tiet_dich_vu']; ?></td>
                    <td><?php echo $dichVu['gia_dich_vu']; ?>đ</td>
                    <td><?php echo $dichVu['thoi_gian_bao_hanh']; ?> tháng</td>
                    <td><?php echo $dichVu['thao_tac']; ?></td>
                    <td>
                        <button class="btn btn-warning sua-dich-vu" data-id="<?php echo $dichVu['id']; ?>">
                            <i class="fas fa-edit"></i> Sửa
                        </button>
                        <button class="btn btn-danger xoa-dich-vu" data-id="<?php echo $dichVu['id']; ?>">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">Không có dịch vụ nào</td>
            </tr>
        <?php endif; ?>
    </tbody>

<!-- Modal Dịch vụ -->
<div class="modal fade" id="modalDichVu" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm Dịch Vụ Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formDichVu" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ten_dich_vu" class="form-label">Tên dịch vụ</label>
                        <input type="text" class="form-control" id="ten_dich_vu" name="ten_dich_vu" required>
                    </div>
                    <div class="mb-3">
                        <label for="chi_tiet_dich_vu" class="form-label">Chi tiết dịch vụ</label>
                        <textarea class="form-control" id="chi_tiet_dich_vu" name="chi_tiet_dich_vu" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gia_dich_vu" class="form-label">Giá dịch vụ</label>
                        <input type="number" class="form-control" id="gia_dich_vu" name="gia_dich_vu" required>
                    </div>
                    <div class="mb-3">
                        <label for="thoi_gian_bao_hanh" class="form-label">Thời gian bảo hành (tháng)</label>
                        <input type="number" class="form-control" id="thoi_gian_bao_hanh" name="thoi_gian_bao_hanh" required>
                    </div>
                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" accept="image/*">
                        <div class="preview-container mt-2" style="display: none;">
                            <img id="preview-image" src="#" alt="Preview" style="max-width: 100%; max-height: 200px;">
                        </div>
                    </div>
                        <div class="mb-3">
                            <label for="thao_tac" class="form-label">Trạng thái</label>
                            <select class="form-select" id="thao_tac" name="thao_tac" required>
                                <option value="Đang hoạt động">Đang hoạt động</option>
                                <option value="Tạm ngưng">Tạm ngưng</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" id="btnLuuDichVu">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sửa Dịch Vụ -->
<div class="modal fade" id="modalSuaDichVu" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa Dịch Vụ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formSuaDichVu" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="sua_dich_vu">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tên dịch vụ</label>
                        <input type="text" class="form-control" name="ten_dich_vu" id="edit_ten_dich_vu" required>
                    </div>
                    <div class="mb-3">
                        <label>Chi tiết dịch vụ</label>
                        <textarea class="form-control" name="chi_tiet_dich_vu" id="edit_chi_tiet_dich_vu" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Giá dịch vụ</label>
                        <input type="number" class="form-control" name="gia_dich_vu" id="edit_gia_dich_vu" required>
                    </div>
                    <div class="mb-3">
                        <label>Thời gian bảo hành (tháng)</label>
                        <input type="number" class="form-control" name="thoi_gian_bao_hanh" id="edit_thoi_gian_bao_hanh" required>
                    </div>
                    <div class="mb-3">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinh_anh" id="edit_hinh_anh">
                    </div>
                    <div class="mb-3">
                        <label>Trạng thái</label>
                        <select class="form-select" name="thao_tac" id="edit_thao_tac" required>
                            <option value="Đang hoạt động">Đang hoạt động</option>
                            <option value="Tạm ngưng">Tạm ngưng</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Xử lý form thêm dịch vụ
    $('#formDichVu').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('action', 'them_dich_vu');

        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    // Thêm dòng mới vào bảng
                    var newRow = `
                        <tr data-id="${response.data.id}">
                            <td>
                                ${response.data.hinh_anh ? 
                                    `<img src="uploads/${response.data.hinh_anh}" class="service-image" alt="${response.data.ten_dich_vu}">` 
                                    : ''}
                            </td>
                            <td>${response.data.ten_dich_vu}</td>
                            <td>${response.data.chi_tiet_dich_vu}</td>
                            <td>${response.data.gia_dich_vu}đ</td>
                            <td>${response.data.thoi_gian_bao_hanh} tháng</td>
                            <td>${response.data.thao_tac}</td>
                            <td>
                                <button class="btn btn-warning sua-dich-vu" data-id="${response.data.id}">
                                    <i class="fas fa-edit"></i> Sửa
                                </button>
                                <button class="btn btn-danger xoa-dich-vu" data-id="${response.data.id}">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </td>
                        </tr>
                    `;
                    $('#dichVuTable tbody').prepend(newRow);
                    
                    // Reset form và đ��ng modal
                    $('#formDichVu')[0].reset();
                    $('#modalDichVu').modal('hide');
                    
                    // Hiển thị thông báo thành công
                    toastr.success('Thêm dịch vụ thành công');
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                toastr.error('Có lỗi xảy ra khi thêm dịch vụ');
            }
        });
    });

    // Xử lý sự kiện xóa dịch vụ
    $(document).on('click', '.xoa-dich-vu', function() {
        const id = $(this).data('id');
        if(confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')) {
            $.ajax({
                url: window.location.href,
                type: 'POST',
                data: {
                    action: 'xoa_dich_vu',
                    id: id
                },
                success: function(response) {
                    if(response.success) {
                        $(`tr[data-id="${id}"]`).remove();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('Có lỗi xảy ra khi xóa dịch vụ');
                }
            });
        }
    });

    // Xử lý sự kiện sửa dịch vụ
    $(document).on('click', '.sua-dich-vu', function() {
        const id = $(this).data('id');
        const row = $(`tr[data-id="${id}"]`);
        
        // Điền thông tin vào form
        $('#edit_id').val(id);
        $('#edit_ten_dich_vu').val(row.find('td:eq(1)').text());
        $('#edit_chi_tiet_dich_vu').val(row.find('td:eq(2)').text());
        $('#edit_gia_dich_vu').val(parseFloat(row.find('td:eq(3)').text().replace(/[^\d]/g, '')));
        $('#edit_thoi_gian_bao_hanh').val(parseInt(row.find('td:eq(4)').text()));
        $('#edit_thao_tac').val(row.find('td:eq(5)').text());
        
        // Hiển thị modal
        $('#modalSuaDichVu').modal('show');
    });

    // Xử lý submit form sửa dịch vụ
    $('#formSuaDichVu').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('action', 'sua_dich_vu');

        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success) {
                    // Cập nhật dữ liệu trên bảng
                    const row = $(`tr[data-id="${response.data.id}"]`);
                    row.find('td:eq(1)').text(response.data.ten_dich_vu);
                    row.find('td:eq(2)').text(response.data.chi_tiet_dich_vu);
                    row.find('td:eq(3)').text(response.data.gia_dich_vu + 'đ');
                    row.find('td:eq(4)').text(response.data.thoi_gian_bao_hanh + ' tháng');
                    row.find('td:eq(5)').text(response.data.thao_tac);
                    
                    if(response.data.hinh_anh) {
                        row.find('td:eq(0) img').attr('src', 'uploads/' + response.data.hinh_anh);
                    }
                    
                    $('#modalSuaDichVu').modal('hide');
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Có lỗi xảy ra khi cập nhật dịch vụ');
            }
        });
    });
});
</script>
</body>
</html>