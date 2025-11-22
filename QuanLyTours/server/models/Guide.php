<?php
// File: models/Guide.php (Đã thêm checkEmailExists và count)

class Guide {
    // 1. Lấy tất cả HDV
    public static function all($conn) {
        $stmt = $conn->prepare("SELECT * FROM guides ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // 2. Lấy HDV theo id
    public static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM guides WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // 3. Thêm mới HDV (Create)
    public static function insert($conn, $data) {
        $sql = "INSERT INTO guides (name, phone, email, specialization) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['specialization']
        ]);
        return $conn->lastInsertId();
    }
    // 4. Cập nhật HDV (Update)
    public static function update($conn, $id, $data) {
        $sql = "UPDATE guides SET name = ?, phone = ?, email = ?, specialization = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['specialization'],
            $id
        ]);
        return $stmt->rowCount();
    }
    // 5. Xóa HDV (Delete)
    public static function delete($conn, $id) {
        $sql = "DELETE FROM guides WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
    
    // 6. Kiểm tra email HDV có bị trùng không (Helper API)
    public static function checkEmailExists($conn, $email, $excludeId = null) {
        $sql = "SELECT COUNT(id) FROM guides WHERE email = ?";
        $params = [$email];
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // 7. Đếm tổng số HDV (Helper API - Dashboard)
    public static function count($conn) {
        $stmt = $conn->prepare("SELECT COUNT(id) FROM guides");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}