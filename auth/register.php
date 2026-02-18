<?php
session_start();

require_once "../config/db.php";     #بنستدعي Database class
require_once "../classes/user.php";  #بنستدعي User model

$error = "";

$database = new Database("root", "");
$db = $database->getConnection();   // لو ضفتي method getConnection() زي ما شرحنا


$user = new User($db);


if ($_SERVER["REQUEST_METHOD"] == "POST") {      #التحقق من نوع الطلب يعني لو الفورم اتبعت فعلاً 

    if ($user->getByEmail($_POST['email'])) {                     // تحقق من وجود الإيميل

        $error = "Email already exists";

    } elseif ($_POST['password'] !== $_POST['confirm_password']) {       #نتحقق لو الباسورد متطابقين 

        $error = "Passwords do not match";

    } else {

        $user->create(                         #إنشاء مستخدم 
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );

        header("Location: login.php");
        exit();
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

    <?php if (!empty($error)): ?> <!--عرض رسالة خطأ-->
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