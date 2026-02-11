<?php

// تنظيف input
function clean($value) {
    return htmlspecialchars(trim($value));
}


// التأكد إن المستخدم عامل Login
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit;
    }
}


// Redirect Function
function redirect(string $path) {
    header("Location: $path");
    exit;
}

?>