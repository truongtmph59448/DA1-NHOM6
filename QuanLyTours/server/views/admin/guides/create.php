<h1>THÊM MỚI HƯỚNG DẪN VIÊN</h1>
<form action="index.php?act=admin-guide-save" method="POST">
    <div>
        <label for="name">Tên HDV:</label><br>
        <input type="text" id="name" name="name" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="phone">Số điện thoại:</label><br>
        <input type="tel" id="phone" name="phone" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required style="width: 300px; padding: 5px;"><br><br>
    </div>
    <div>
        <label for="specialization">Chuyên môn:</label><br>
        <input type="text" id="specialization" name="specialization" style="width: 300px; padding: 5px;"><br><br>
    </div>
    <a href="index.php?act=admin-guides">Quay lại</a>
    <button type="submit" style="padding: 8px 15px; background: blue; color: white; border: none;">Lưu HDV</button>
</form>