<?php
// File: controllers/CategoryController.php (ĐÃ CHUYỂN HOÀN TOÀN SANG API)

require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../commons/env.php'; 
require_once __DIR__ . '/../commons/api_helpers.php'; 

class CategoryController {

    // 1. (API) Lấy tất cả danh mục (GET)
    public function apiCategoryList() {
        global $conn;
        $categories = Category::all($conn);
        sendJsonResponse($categories, 'Lấy danh sách danh mục thành công');
    }

    // 2. (API) Thêm mới danh mục (POST)
    public function apiCategoryStore() {
        global $conn;
        $data = [
            'name' => trim($_POST['name'] ?? null),
            'description' => $_POST['description'] ?? null,
        ];
        
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Tên danh mục không được để trống.';
        } elseif (Category::checkNameExists($conn, $data['name'])) { 
             $errors[] = 'Tên danh mục đã tồn tại.';
        }
        
        if (!empty($errors)) {
            sendErrorResponse($errors, 400); 
        }

        $id = Category::insert($conn, $data);
        $newCategory = Category::find($conn, $id);
        sendJsonResponse($newCategory, 'Thêm danh mục thành công', 201); 
    }

    // 3. (API) Lấy thông tin 1 danh mục theo ID (GET)
    public function apiCategoryShow() {
        global $conn;
        $id = $_GET['id'] ?? null;
        
        if (!$id || !is_numeric($id)) {
            sendErrorResponse('ID danh mục không hợp lệ.', 400);
        }
        
        $category = Category::find($conn, $id);
        if (!$category) {
            sendErrorResponse('Không tìm thấy danh mục.', 404); 
        }
        
        sendJsonResponse($category, 'Lấy chi tiết danh mục thành công');
    }

    // 4. (API) Cập nhật danh mục (POST/PUT)
    public function apiCategoryUpdate() {
        global $conn;
        $id = $_POST['id'] ?? null; 
        $data = [
            'name' => trim($_POST['name'] ?? null),
            'description' => $_POST['description'] ?? null,
        ];

        $errors = [];
        if (empty($id) || !is_numeric($id)) {
            $errors[] = 'Thiếu hoặc ID danh mục không hợp lệ.';
        } elseif (empty($data['name'])) {
            $errors[] = 'Tên danh mục không được để trống.';
        } elseif (Category::checkNameExists($conn, $data['name'], $id)) {
             $errors[] = 'Tên danh mục đã tồn tại.';
        }
        
        if (!empty($errors)) {
            sendErrorResponse($errors, 400);
        }

        Category::update($conn, $id, $data);
        $updatedCategory = Category::find($conn, $id);
        sendJsonResponse($updatedCategory, 'Cập nhật danh mục thành công', 200); 
    }

    // 5. (API) Xóa danh mục (DELETE)
    public function apiCategoryDestroy() {
        global $conn;
        $id = $_GET['id'] ?? $_POST['id'] ?? null; 
        
        if (!$id || !is_numeric($id)) {
            sendErrorResponse('Thiếu hoặc ID danh mục không hợp lệ.', 400);
        }
        
        Category::delete($conn, $id);
        sendJsonResponse(null, 'Xóa danh mục thành công', 200); 
    }

    // 6. (API) Lấy thống kê (Dashboard)
    public function apiCategoryCount() {
        global $conn;
        $count = Category::count($conn);
        sendJsonResponse(['total' => $count], 'Lấy thống kê thành công', 200);
    }
    
    public function NotFound() {
        sendErrorResponse('Endpoint không tồn tại hoặc yêu cầu không hợp lệ.', 404);
    }
}