<h1>CẬP NHẬT HƯỚNG DẪN VIÊN: <?= htmlspecialchars($guide['name']) ?></h1>
<form action="index.php?act=admin-guide-update" method="POST">
    <input type="hidden" name="id" value="<?= $guide['id'] ?>">
    <div>
        <label for="name">Tên HDV:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($guide['name']) ?>" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="phone">Số điện thoại:</label><br>
        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($guide['phone']) ?>" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($guide['email']) ?>" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="specialization">Chuyên môn:</label><br>
        <input type="text" id="specialization" name="specialization" value="<?= htmlspecialchars($guide['specialization']) ?>" style="width: 300px; padding: 5px;"><br><br>
    </div>
    <a href="index.php?act=admin-guides">Quay lại</a>
    <button type="submit" style="padding: 8px 15px; background: orange; color: white; border: none;">Cập nhật</button>
</form>