<?php
// File: commons/api_helpers.php

/**
 * Trả về response JSON thành công
 * @param array $data Dữ liệu cần trả về
 * @param string $message Thông báo
 * @param int $status HTTP Status Code (Mặc định 200 OK)
 */
function sendJsonResponse($data = [], $message = 'Thành công', $status = 200) {
    // Ngăn chặn trình duyệt đệm (cache)
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    
    // Thiết lập Header để báo hiệu đây là JSON
    header('Content-Type: application/json');
    http_response_code($status);
    
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

/**
 * Trả về response lỗi JSON
 * @param array|string $errors Thông báo lỗi (có thể là một chuỗi hoặc mảng các lỗi)
 * @param int $status HTTP Status Code (Mặc định 400 Bad Request)
 */
function sendErrorResponse($errors = 'Có lỗi xảy ra', $status = 400) {
    // Chuyển lỗi thành dạng mảng nếu nó là chuỗi
    if (is_string($errors)) {
        $errors = [$errors];
    }
    
    header('Content-Type: application/json');
    http_response_code($status);

    echo json_encode([
        'status' => $status,
        'message' => 'Yêu cầu không hợp lệ',
        'errors' => $errors
    ]);
    exit();
}