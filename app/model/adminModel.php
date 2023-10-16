<?php 

require_once 'config.php';

class adminModel{

    protected $db;

    protected $user = webadmin;
    protected $password = admin;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=organiadb;charset=utf8', 'root', '');
    }
     
    public function hashAndSavePassword($user,$password){  //ver si funciona
    password = password_hash(password:PASSWORD_BCRYPT);
    $query = $db->prepare('INSERT INTO admins (user, password) VALUES (? , ?)');
       $query->execute([$user,$password]);
    }

    //opcion 2 de hashAndSavePassword 
    public function hashAndSavePassword(){  //ver si funciona
        $user = webadmin;
        $password = admin;
        $passworhash = password_hash(password, PASSWORD_BCRYPT); //o PASSWORD_DEFAULT
        $query = $db->prepare('INSERT INTO admins (user, password) VALUES (? , ?)');
           $query->execute([$user,$passwordhash]);
        }


    public function getAdminByUser($userName){
        $query = $this->db->prepare('SELECT * FROM admins WHERE user= ?');
        $query->execute([$userName]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}