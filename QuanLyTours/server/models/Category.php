<?php
// File: models/Category.php (Đã thêm checkNameExists và count)

class Category {
    // 1. Lấy tất cả danh mục
    public static function all($conn) {
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // 2. Lấy danh mục theo id
    public static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // 3. Thêm mới danh mục (Create)
    public static function insert($conn, $data) {
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([ $data['name'], $data['description'] ]);
        return $conn->lastInsertId();
    }
    // 4. Cập nhật danh mục (Update)
    public static function update($conn, $id, $data) {
        $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([ $data['name'], $data['description'], $id ]);
        return $stmt->rowCount();
    }
    // 5. Xóa danh mục (Delete)
    public static function delete($conn, $id) {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
    // 6. Kiểm tra tên danh mục có bị trùng không (Helper API)
    public static function checkNameExists($conn, $name, $excludeId = null) {
        $sql = "SELECT COUNT(id) FROM categories WHERE name = ?";
        $params = [$name];
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }
    // 7. Đếm tổng số danh mục (Helper API - Dashboard)
    public static function count($conn) {
        $stmt = $conn->prepare("SELECT COUNT(id) FROM categories");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}