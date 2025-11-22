<?php
// File: controllers/ProductController.php (ĐÃ CHUYỂN HOÀN TOÀN SANG API)

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../commons/env.php'; 
require_once __DIR__ . '/../commons/api_helpers.php'; 

class ProductController {

    // 1. (API) Lấy tất cả sản phẩm (GET)
    public function apiProductList() {
        global $conn;
        $products = Product::all($conn);
        sendJsonResponse($products, 'Lấy danh sách sản phẩm thành công');
    }

    // 2. (API) Thêm mới sản phẩm (POST)
    public function apiProductStore() {
        global $conn;
        $data = [
            'name' => trim($_POST['name'] ?? null),
            'price' => $_POST['price'] ?? null,
            'description' => $_POST['description'] ?? null,
        ];
        
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Tên sản phẩm không được để trống.';
        } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
             $errors[] = 'Giá sản phẩm không hợp lệ.';
        } elseif (Product::checkNameExists($conn, $data['name'])) { 
             $errors[] = 'Tên sản phẩm đã tồn tại.';
        }
        
        if (!empty($errors)) {
            sendErrorResponse($errors, 400);
        }

        $id = Product::insert($conn, $data);
        $newProduct = Product::find($conn, $id);
        sendJsonResponse($newProduct, 'Thêm sản phẩm thành công', 201); 
    }

    // 3. (API) Lấy thông tin 1 sản phẩm theo ID (GET)
    public function apiProductShow() {
        global $conn;
        $id = $_GET['id'] ?? null;
        
        if (!$id || !is_numeric($id)) {
            sendErrorResponse('ID sản phẩm không hợp lệ.', 400);
        }
        
        $product = Product::find($conn, $id);
        if (!$product) {
            sendErrorResponse('Không tìm thấy sản phẩm.', 404);
        }
        
        sendJsonResponse($product, 'Lấy chi tiết sản phẩm thành công');
    }

    // 4. (API) Cập nhật sản phẩm (POST/PUT)
    public function apiProductUpdate() {
        global $conn;
        $id = $_POST['id'] ?? null; 
        $data = [
            'name' => trim($_POST['name'] ?? null),
            'price' => $_POST['price'] ?? null,
            'description' => $_POST['description'] ?? null,
        ];

        $errors = [];
        if (empty($id) || !is_numeric($id)) {
            $errors[] = 'Thiếu hoặc ID sản phẩm không hợp lệ.';
        } elseif (empty($data['name'])) {
            $errors[] = 'Tên sản phẩm không được để trống.';
        } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
             $errors[] = 'Giá sản phẩm không hợp lệ.';
        } elseif (Product::checkNameExists($conn, $data['name'], $id)) {
             $errors[] = 'Tên sản phẩm đã tồn tại.';
        }
        
        if (!empty($errors)) {
            sendErrorResponse($errors, 400);
        }

        Product::update($conn, $id, $data);
        $updatedProduct = Product::find($conn, $id);
        sendJsonResponse($updatedProduct, 'Cập nhật sản phẩm thành công', 200); 
    }

    // 5. (API) Xóa sản phẩm (DELETE)
    public function apiProductDestroy() {
        global $conn;
        $id = $_GET['id'] ?? $_POST['id'] ?? null; 
        
        if (!$id || !is_numeric($id)) {
            sendErrorResponse('Thiếu hoặc ID sản phẩm không hợp lệ.', 400);
        }
        
        Product::delete($conn, $id);
        sendJsonResponse(null, 'Xóa sản phẩm thành công', 200); 
    }
    
    // 6. (API) Lấy thống kê (Dashboard)
    public function apiProductCount() {
        global $conn;
        $count = Product::count($conn);
        sendJsonResponse(['total' => $count], 'Lấy thống kê sản phẩm thành công', 200);
    }

    // 7. Xử lý route home/404 mặc định
    public function NotFound() {
        sendErrorResponse('Endpoint không tồn tại hoặc yêu cầu không hợp lệ.', 404);
    }
    
    public function home() {
        sendJsonResponse(null, 'Backend API đang hoạt động.', 200);
    }
}