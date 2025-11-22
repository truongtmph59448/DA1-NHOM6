<?php
// File: controllers/GuideController.php (ĐÃ CHUYỂN HOÀN TOÀN SANG API)

require_once __DIR__ . '/../models/Guide.php';
require_once __DIR__ . '/../commons/env.php'; 
require_once __DIR__ . '/../commons/api_helpers.php'; 

class GuideController {

    // 1. (API) Lấy tất cả HDV (GET)
    public function apiGuideList() {
        global $conn;
        $guides = Guide::all($conn);
        sendJsonResponse($guides, 'Lấy danh sách hướng dẫn viên thành công');
    }

    // 2. (API) Thêm mới HDV (POST)
    public function apiGuideStore() {
        global $conn;
        $data = [
            'name' => trim($_POST['name'] ?? null),
            'phone' => $_POST['phone'] ?? null,
            'email' => trim($_POST['email'] ?? null),
            'specialization' => $_POST['specialization'] ?? null,
        ];
        
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Tên HDV không được để trống.';
        }
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ.';
        } elseif (Guide::checkEmailExists($conn, $data['email'])) { 
             $errors[] = 'Email đã tồn tại.';
        }
        
        if (!empty($errors)) {
            sendErrorResponse($errors, 400);
        }

        $id = Guide::insert($conn, $data);
        $newGuide = Guide::find($conn, $id);
        sendJsonResponse($newGuide, 'Thêm hướng dẫn viên thành công', 201); 
    }

    // 3. (API) Lấy thông tin 1 HDV theo ID (GET)
    public function apiGuideShow() {
        global $conn;
        $id = $_GET['id'] ?? null;
        
        if (!$id || !is_numeric($id)) {
            sendErrorResponse('ID hướng dẫn viên không hợp lệ.', 400);
        }
        
        $guide = Guide::find($conn, $id);
        if (!$guide) {
            sendErrorResponse('Không tìm thấy hướng dẫn viên.', 404);
        }
        
        sendJsonResponse($guide, 'Lấy chi tiết hướng dẫn viên thành công');
    }

    // 4. (API) Cập nhật HDV (POST/PUT)
    public function apiGuideUpdate() {
        global $conn;
        $id = $_POST['id'] ?? null; 
        $data = [
            'name' => trim($_POST['name'] ?? null),
            'phone' => $_POST['phone'] ?? null,
            'email' => trim($_POST['email'] ?? null),
            'specialization' => $_POST['specialization'] ?? null,
        ];

        $errors = [];
        if (empty($id) || !is_numeric($id)) {
            $errors[] = 'Thiếu hoặc ID không hợp lệ.';
        } elseif (empty($data['name'])) {
            $errors[] = 'Tên HDV không được để trống.';
        }
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ.';
        } elseif (Guide::checkEmailExists($conn, $data['email'], $id)) {
             $errors[] = 'Email đã tồn tại.';
        }
        
        if (!empty($errors)) {
            sendErrorResponse($errors, 400);
        }

        Guide::update($conn, $id, $data);
        $updatedGuide = Guide::find($conn, $id);
        sendJsonResponse($updatedGuide, 'Cập nhật hướng dẫn viên thành công', 200); 
    }

    // 5. (API) Xóa HDV (DELETE)
    public function apiGuideDestroy() {
        global $conn;
        $id = $_GET['id'] ?? $_POST['id'] ?? null; 
        
        if (!$id || !is_numeric($id)) {
            sendErrorResponse('Thiếu hoặc ID hướng dẫn viên không hợp lệ.', 400);
        }
        
        Guide::delete($conn, $id);
        sendJsonResponse(null, 'Xóa hướng dẫn viên thành công', 200); 
    }
    
    // 6. (API) Lấy thống kê (Dashboard)
    public function apiGuideCount() {
        global $conn;
        $count = Guide::count($conn);
        sendJsonResponse(['total' => $count], 'Lấy thống kê HDV thành công', 200);
    }
}