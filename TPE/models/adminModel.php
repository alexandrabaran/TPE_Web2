<?php 

class adminModel{

    private $db;

    //protected $user = webadmin;
    //protected $password = admin;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=organia;charset=utf8', 'root', '');
    }
     
    /*public function SavePassword($user,$password){  //ver si funciona
        $query = $this->db->prepare('INSERT INTO users (user_name, user_password) VALUES (? , ?)');
        $query->execute([$user,$password]);
    }*/

    public function getAdminByUser($user){
        $query = $this->db->prepare('SELECT * FROM users WHERE user_name = ?');
        $query->execute([$user]);

        $userFromDB = $query->fetch(PDO::FETCH_OBJ);
        return $userFromDB;
    }
}