<?php
session_start();

// 1️⃣ ملفات المشروع
require_once "../config/db.php";
require_once "../functions/helpers.php";
require_once "../functions/product.php";

// 2️⃣ حماية الصفحة
checkAuth();

// 3️⃣ جلب المنتجات من DB
$products = getAllProducts($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

    <h3>Products</h3>

    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="../products/<?php echo $product['image']; ?>" width="150">
                <h4><?php echo $product['name']; ?></h4>
                <p>Price: $<?php echo $product['price']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>