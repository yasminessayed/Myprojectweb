<?php

class Auth
{

    private $userModel;

    public function __construct($user)
    {
        $this->userModel = $user;
    }

    public function login($email, $password)
    {

        $user = $this->userModel->getByEmail($email);   #بنجيب المستخدم من قاعدة البيانات 
        #التحقق هنا شرطين المستخدم موجود/الباسورد صح
        if ($user && password_verify($password, $user['password'])) {  #بيقارن الباسورد اللي اليوزر كتبه/بالباسورد المشفر في الداتا بيز

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            return true;   #لو كل حاجة صح عشان الكنترولر يعرف إن الدخول نجح
        }

        return false;
    }

    public function check()
    {
        return isset($_SESSION['user_id']);
    }

    public function logout()  #session يعني المستخدم خرج / دي بتمسح كل الـ 
    {
        session_destroy();
    }
}
