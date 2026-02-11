<?php

// جلب كل المنتجات
function getAllProducts(PDO $conn)
{
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// إضافة منتج
function addProduct(PDO $conn, array $data)
{

    $stmt = $conn->prepare(
        "INSERT INTO products (name, price, image)
         VALUES (:name, :price, :image)"
    );

    return $stmt->execute([
        'name' => $data['name'],
        'price' => $data['price'],
        'image' => $data['image']
    ]);
}
?>