<h1>QUẢN LÝ DANH SÁCH HƯỚNG DẪN VIÊN</h1>
<a href="index.php?act=admin-guide-create" style="padding: 10px; background: green; color: white; text-decoration: none;">Thêm mới HDV</a>
<br><br>

<table border="1" style="width: 90%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="padding: 10px;">ID</th>
            <th style="padding: 10px;">Tên HDV</th>
            <th style="padding: 10px;">Điện thoại</th>
            <th style="padding: 10px;">Email</th>
            <th style="padding: 10px;">Chuyên môn</th>
            <th style="padding: 10px;">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($guides)): ?>
            <?php foreach($guides as $guide): ?>
            <tr>
                <td style="padding: 10px; text-align: center;"><?= $guide['id'] ?></td>
                <td style="padding: 10px;"><?= htmlspecialchars($guide['name']) ?></td>
                <td style="padding: 10px;"><?= htmlspecialchars($guide['phone']) ?></td>
                <td style="padding: 10px;"><?= htmlspecialchars($guide['email']) ?></td>
                <td style="padding: 10px;"><?= htmlspecialchars($guide['specialization']) ?></td>
                <td style="padding: 10px; text-align: center;">
                    <a href="index.php?act=admin-guide-edit&id=<?= $guide['id'] ?>">Sửa</a> |
                    <a href="index.php?act=admin-guide-delete&id=<?= $guide['id'] ?>" 
                       onclick="return confirm('Xác nhận xóa HDV: <?= htmlspecialchars($guide['name']) ?>?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="padding: 10px; text-align: center;">Chưa có HDV nào trong hệ thống.</td></tr>
        <?php endif; ?>
    </tbody>
</table>