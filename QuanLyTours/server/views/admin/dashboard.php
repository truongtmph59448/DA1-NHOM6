<?php
// File: views/admin/dashboard.php
// Lấy các số liệu thống kê (Sẽ làm ở bước sau)
// $totalCategories = Category::count($conn);
// $totalProducts = Product::count($conn);
// $totalGuides = Guide::count($conn);
?>

<div class="row">
    <div style="float: left; width: 30%; margin-right: 3%; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h3>📊 Danh mục</h3>
        <p style="font-size: 24px; font-weight: bold;">0</p>
        <a href="index.php?act=admin-categories">Xem chi tiết</a>
    </div>

    <div style="float: left; width: 30%; margin-right: 3%; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h3>📦 Sản phẩm</h3>
        <p style="font-size: 24px; font-weight: bold;">0</p>
        <a href="index.php?act=admin-products">Xem chi tiết</a>
    </div>

    <div style="float: left; width: 30%; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h3>👤 HDV</h3>
        <p style="font-size: 24px; font-weight: bold;">0</p>
        <a href="index.php?act=admin-guides">Xem chi tiết</a>
    </div>
    <div style="clear: both;"></div> 
</div>

<h3 style="margin-top: 40px;">Hoạt động gần đây</h3>
<p>Nội dung này sẽ hiển thị các thay đổi mới nhất...</p>