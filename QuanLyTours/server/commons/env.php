<?php
// File: commons/env.php
const DB_HOST = 'localhost';
const DB_NAME = 'tours';
const DB_USER = 'root';
const DB_PASS = '';

// Đường dẫn tuyệt đối của dự án
define('PATH_ROOT', __DIR__ . '/../'); // <--- THÊM DÒNG NÀY

// PDO connection
try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
} catch (Exception $e) {
    die('Lỗi kết nối DB: ' . $e->getMessage());
}