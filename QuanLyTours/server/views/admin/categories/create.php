<h1>THÊM MỚI DANH MỤC</h1>
<form action="index.php?act=admin-category-save" method="POST">
    <div>
        <label for="name">Tên Danh mục:</label><br>
        <input type="text" id="name" name="name" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4" style="width: 300px; padding: 5px;"></textarea><br><br>
    </div>
    <a href="index.php?act=admin-categories">Quay lại</a>
    <button type="submit" style="padding: 8px 15px; background: blue; color: white; border: none;">Lưu Danh mục</button>
</form>