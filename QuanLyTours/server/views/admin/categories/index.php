<h1>QUẢN LÝ DANH MỤC TOUR</h1>
<a href="index.php?act=admin-category-create" style="padding: 10px; background: green; color: white; text-decoration: none;">Thêm mới Danh mục</a>
<br><br>

<table border="1" style="width: 80%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="padding: 10px;">ID</th>
            <th style="padding: 10px;">Tên Danh mục</th>
            <th style="padding: 10px;">Mô tả</th>
            <th style="padding: 10px;">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($categories)): ?>
            <?php foreach($categories as $category): ?>
            <tr>
                <td style="padding: 10px; text-align: center;"><?= $category['id'] ?></td>
                <td style="padding: 10px;"><?= htmlspecialchars($category['name']) ?></td>
                <td style="padding: 10px;"><?= htmlspecialchars($category['description']) ?></td>
                <td style="padding: 10px; text-align: center;">
                    <a href="index.php?act=admin-category-edit&id=<?= $category['id'] ?>">Sửa</a> |
                    <a href="index.php?act=admin-category-delete&id=<?= $category['id'] ?>" 
                       onclick="return confirm('Xác nhận xóa danh mục: <?= htmlspecialchars($category['name']) ?>?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" style="padding: 10px; text-align: center;">Chưa có danh mục nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>