<form method="post" action="login.php">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" name="login">Login</button>
</form>


<?php
# Session بيبدأ أو يكمل 
session_start();
# Databaseالاتصال بالـ 
require_once __DIR__ . "/../config/db.php";

# <button name="login">Login</button> يعني:نفّذ الكود بس لو الفورم اتبعت وده جاي من
if (isset($_POST['login'])) {
    # var_dump($conn);                   تطبعلك كل التفاصيل عن المتغير مش بس قيمته  
    #exit();
    #استقبال البيانات من الفورم يعني:خد الإيميل , خد الباسورداللي المستخدم كتبهم
    # تشيل المسافات قبل وبعد الجمله trim()
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    # مش فاضي inputالتحقق إن الـ 
    if (empty($email) || empty($password)) {
        $error = "Please fill all fields"; #الصح:رسالة واحدة عامة ليه؟ الهاكر ما يعرف إن الإيميل موجود ولا لأ
    } else {
        #تحضير الاستعلام (PDO Prepare)
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
        #تنفيذ الاستعلام 
        $stmt->execute(['email' => $email]);
        #جلب بيانات المستخدم
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            #login بعد نجاح الـsession إنشاء
            # $_SESSION['user'] = $user['email'];    #  اللي عامل المستخدم بالايميلsession تخزين  

            $stmt = $conn->prepare("SELECT * FROM product");
            $stmt->execute();
            $products = $stmt->fetchAll();
            var_dump($products);
            exit;
        } else {
            $error = "Invalid email or password";
        }
    }
}

?>