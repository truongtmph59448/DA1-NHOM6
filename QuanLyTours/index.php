<?php
// File: index.php (Router API hoàn chỉnh cho cả 3 modules)

// Tắt hiển thị lỗi/cảnh báo PHP để không làm hỏng JSON output
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

header('Access-Control-Allow-Origin: *'); 
// Cho phép các phương thức GET, POST, PUT, DELETE
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
// Cho phép các header cần thiết
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Nếu là request OPTIONS (pre-flight request), kết thúc ngay
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

// Tắt hiển thị lỗi/cảnh báo PHP để không làm hỏng JSON output
ini_set('display_errors', 0);

// Cần đảm bảo các file này tồn tại và có các hàm API mới
require_once __DIR__ . '/controllers/CategoryController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/GuideController.php';
require_once __DIR__ . '/commons/api_helpers.php'; 
require_once __DIR__ . '/commons/env.php'; // Chứa logic kết nối DB $conn

// Khởi tạo Controllers
$categoryController = new CategoryController();
$productController = new ProductController();
$guideController = new GuideController();

// Định nghĩa $act mặc định để tránh lỗi Undefined Variable
$act = $_GET['act'] ?? 'home'; 

switch ($act) {
    
    // --- API ENDPOINTS CHO CATEGORY ---
    case 'api-categories':
        $categoryController->apiCategoryList();
        break;
    case 'api-category-store':
        $categoryController->apiCategoryStore();
        break;
    case 'api-category-show':
        $categoryController->apiCategoryShow();
        break;
    case 'api-category-update':
        $categoryController->apiCategoryUpdate();
        break;
    case 'api-category-destroy':
        $categoryController->apiCategoryDestroy();
        break;
    case 'api-category-count':
        $categoryController->apiCategoryCount();
        break;
        
    // --- API ENDPOINTS CHO PRODUCT ---
    case 'api-products':
        $productController->apiProductList();
        break;
    case 'api-product-store':
        $productController->apiProductStore();
        break;
    case 'api-product-show':
        $productController->apiProductShow();
        break;
    case 'api-product-update':
        $productController->apiProductUpdate();
        break;
    case 'api-product-destroy':
        $productController->apiProductDestroy();
        break;
    case 'api-product-count':
        $productController->apiProductCount();
        break;

    // --- API ENDPOINTS CHO GUIDE ---
    case 'api-guides':
        $guideController->apiGuideList();
        break;
    case 'api-guide-store':
        $guideController->apiGuideStore();
        break;
    case 'api-guide-show':
        $guideController->apiGuideShow();
        break;
    case 'api-guide-update':
        $guideController->apiGuideUpdate();
        break;
    case 'api-guide-destroy':
        $guideController->apiGuideDestroy();
        break;
    case 'api-guide-count':
        $guideController->apiGuideCount();
        break;
        
    // --- ROUTE GỐC VÀ LỖI ---
    case 'home':
        $productController->home(); // Trả về thông báo API hoạt động
        break;

    default:
        $productController->NotFound(); // Lỗi 404 cho mọi route không khớp
        break;
}