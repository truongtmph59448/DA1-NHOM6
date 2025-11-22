<?php
// File: commons/function.php

// 1. Đặt thông báo lỗi/dữ liệu cũ vào Session
function setSessionFlash($key, $message) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION[$key] = $message;
}

// 2. Lấy và xóa thông báo lỗi/dữ liệu cũ khỏi Session
function getSessionFlash($key) {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}

// KHỞI ĐỘNG SESSION KHI CẦN
if (!isset($_SESSION)) {
    session_start();
}