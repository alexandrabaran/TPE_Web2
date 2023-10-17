<?php


class authHelper {

    public static function login($user) {
        session_start();
        $_SESSION['USER_ID'] = $user->user_id;
        $_SESSION['USER_NAME'] = $user->user_name; 
    }

    public static function verify() {
        session_start();
        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }
}