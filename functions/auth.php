<?php

// جلب مستخدم بالإيميل
function getUserByEmail(PDO $conn, string $email) {
    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email = :email"
    );
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// تسجيل الدخول
function loginUser(PDO $conn, string $email, string $password) {

    $user = getUserByEmail($conn, $email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }

    return false;
}


// تسجيل مستخدم جديد
function registerUser(PDO $conn, array $data) {

    $hashedPassword = password_hash(
        $data['password'],
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, password)
         VALUES (:name, :email, :password)"
    );

    return $stmt->execute([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => $hashedPassword
    ]);
}
?>