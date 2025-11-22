<h1>CẬP NHẬT DANH MỤC: <?= htmlspecialchars($category['name']) ?></h1>
<form action="index.php?act=admin-category-update" method="POST">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <div>
        <label for="name">Tên Danh mục:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4" style="width: 300px; padding: 5px;"><?= htmlspecialchars($category['description']) ?></textarea><br><br>
    </div>
    <a href="index.php?act=admin-categories">Quay lại</a>
    <button type="submit" style="padding: 8px 15px; background: orange; color: white; border: none;">Cập nhật</button>
</form>