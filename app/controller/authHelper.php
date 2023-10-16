<?php
class authHelper {

  public static function init() {
      if (session_status() != PHP_SESSION_ACTIVE) {
          session_start();
      }
  }

  public static function loguin($user) {
      authHelper::init();
      $_SESSION['USER_ID'] = $user->id_admin;
      
      $_SESSION['USER_NAME'] = $user->nombre_Usuario; 
  }

  public static function verify() {
      authHelper::init();
      if (!isset($_SESSION['USER_ID'])) {
          header('Location: ' . BASE_URL . 'loguin');
          die();
      }
  }
}