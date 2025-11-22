<?php
// File: views/admin/categories/create.php

// Lấy lỗi và dữ liệu cũ từ Session
$errors = getSessionFlash('errors');
$oldData = getSessionFlash('old_data');
?>

<h1>THÊM MỚI DANH MỤC</h1>

<?php if ($errors): ?>
    <div class="alert-error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php?act=admin-category-save" method="POST">
    <div>
        <label for="name">Tên Danh mục:</label><br>
        <input type="text" id="name" name="name" 
               value="<?= htmlspecialchars($oldData['name'] ?? '') ?>" 
               required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4" style="width: 300px; padding: 5px;"><?= htmlspecialchars($oldData['description'] ?? '') ?></textarea><br><br>
    </div>
    <a href="index.php?act=admin-categories" style="padding: 8px 15px; background: gray; color: white; border: none; text-decoration: none;">Quay lại</a>
    <button type="submit" style="padding: 8px 15px; background: blue; color: white; border: none;">Lưu Danh mục</button>
</form>