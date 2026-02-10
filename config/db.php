<?php
try {
    #عملي object جديد من PDO
    #PDO = الطبقة اللي بتخلّي PHP تكلم Database
    $conn = new PDO("mysql:host=localhost;dbname=store;charset=utf8", "root", "");
    #    ده بيقول:لو حصل اي خطا في sql ارمي Exception بدل ما تسكت
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connessione eseguita con successo.';
} catch (PDOException $e) {
    die($e->getMessage());
}

/*
try {
    #عملي object جديد من PDO
    #PDO = الطبقة اللي بتخلّي PHP تكلم Database
    $conn = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
    #    ده بيقول:لو حصل اي خطا في sql ارمي Exception بدل ما تسكت
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Error");
}
*/

?>