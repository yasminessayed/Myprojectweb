<?php
class Database
{
    private $conn;
    public function __construct($username, $password)
    {
        # $this->conn = null;


        try {
            $this->conn = new PDO(
                "mysql:host=localhost;dbname=store",
                $username,
                $password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        } catch (PDOException $e) {
            echo "Connection Erro: " . $e->getMessage();
            exit();
        }

        # return $this->conn;
    }

    // Method مستقلة لجلب الاتصال
    public function getConnection()
    {
        return $this->conn;
    }

    public function getAll()
    {

        $query = "SELECT * FROM  products";   #هتبقى فعليًا SELECT * FROM products

        $stmt = $this->conn->prepare($query);   #بنجهز الكويري حتى لو مفيش متغيرات بنستخدم عشان نحافظ على نفس الأسلوب الاحترافي
        $stmt->execute();                       #بننفذ الاستعلام

        return $stmt->fetchAll(PDO::FETCH_ASSOC); #بيرجع صف واحد
    }


}



/*
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

*/
?>