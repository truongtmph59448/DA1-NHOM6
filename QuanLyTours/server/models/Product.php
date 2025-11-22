<?php
// File: models/Product.php (Đã chuyển sang static và thêm validation/count)

class Product {

    // 1. Lấy tất cả sản phẩm
    public static function all($conn) {
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // 2. Lấy sản phẩm theo ID
    public static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // 3. Thêm sản phẩm mới (CREATE)
    public static function insert($conn, $data) {
        // Giả định bảng products có name, price, description
        $sql = "INSERT INTO products (name, price, description) VALUES (?, ?, ?)"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['price'],
            $data['description']
        ]);
        return $conn->lastInsertId();
    }
    // 4. Cập nhật sản phẩm (UPDATE)
    public static function update($conn, $id, $data) {
        $sql = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['price'],
            $data['description'],
            $id
        ]);
        return $stmt->rowCount();
    }
    // 5. Xóa sản phẩm (DELETE)
    public static function delete($conn, $id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
    
    // 6. Kiểm tra tên sản phẩm có bị trùng không (Helper API)
    public static function checkNameExists($conn, $name, $excludeId = null) {
        $sql = "SELECT COUNT(id) FROM products WHERE name = ?";
        $params = [$name];
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // 7. Đếm tổng số sản phẩm (Helper API - Dashboard)
    public static function count($conn) {
        $stmt = $conn->prepare("SELECT COUNT(id) FROM products");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}