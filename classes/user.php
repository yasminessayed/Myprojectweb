<?php
class User
{

    private $conn;              #PDO ده الاتصال بقاعدة البيانات 
    private $table = "users";   #اسم الجدول عملناه متغير علشان لو غيرناه نغيره في مكان واحد بس 

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getByEmail($email) #دي وظيفتها:تجيب مستخدم من الجدول عن طريق الإيميل
    {

        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";  #Means that: SELECT * FROM users WHERE email = :email


        $stmt = $this->conn->prepare($query);   #بنجهز الكويري قبل التنفيذ
        $stmt->bindParam(":email", $email);     #sql بنربط قيمة  ب
        $stmt->execute();                       #بننفذ الكويري.

        return $stmt->fetch(PDO::FETCH_ASSOC);  #arrayهات صف واحدو رجعه كـ 
    }

    public function create($name, $email, $password)  #وظيفتها:تعمل مستخدم جديد
    {

        $query = "INSERT INTO " . $this->table . "
                  (name, email, password)
                  VALUES (:name, :email, :password)";

        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); #تشفير الباسورد

        return $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => $hashedPassword
        ]);
    }
}
