<?php
// File: views/admin/layouts/header.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = $title ?? 'Quản lý Tours'; // Lấy biến title từ Controller
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin | <?= $title ?></title>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f4f4f4; }
        .header { background: #007bff; color: white; padding: 15px; }
        .nav a { color: white; margin-right: 20px; text-decoration: none; }
        .container { padding: 20px; max-width: 1200px; margin: 0 auto; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 15px; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="nav">
            <a href="index.php">Trang Chủ</a>
            <a href="index.php?act=admin-categories">QL Danh mục</a>
            <a href="index.php?act=admin-products">QL Sản phẩm</a>
            <a href="index.php?act=admin-guides">QL HDV</a>
        </div>
    </div>
    <div class="container">
        <?php if ($success = getSessionFlash('success')): ?>
            <div class="alert-success"><?= $success ?></div>
        <?php endif; ?>
        <h1><?= $title ?></h1>