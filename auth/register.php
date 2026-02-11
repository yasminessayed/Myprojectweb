<?php
session_start();

require_once "../config/db.php";
require_once "../functions/auth.php";
require_once "../functions/helpers.php";

$error = ""; // لتخزين أي رسالة خطأ

if (isset($_POST['register'])) {

    // تنظيف البيانات
    $name = clean($_POST['name']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $confirm = clean($_POST['confirm_password']);

    // 1️⃣ تحقق من الحقول الفارغة
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $error = "Please fill all fields";
    }
    // 2️⃣ تحقق من تطابق الباسورد
    elseif ($password !== $confirm) {
        $error = "Passwords do not match";
    }
    // 3️⃣ تحقق إن الإيميل مش موجود أصلاً
    elseif (getUserByEmail($conn, $email)) {
        $error = "Email already registered";
    } else {
        // 4️⃣ تسجيل المستخدم
        $registerData = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        if (registerUser($conn, $registerData)) {
            // تسجيل ناجح → عمل Login تلقائي
            loginUser($conn, $email, $password);

            // Redirect للصفحة الرئيسية أو products
            redirect("../products/index.php");
        } else {
            $error = "Registration failed, please try again";
        }
    }
}

?>
<!-- HTML الفورم -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <h2>Register</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>

</html>