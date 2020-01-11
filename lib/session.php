<?php





class Session{
 public static function init(){

        if (session_id() == '') {
            session_start();
        }

 }



 public static function set($key, $val){

  $_SESSION[$key] = $val;

 }



 public static function get($key){

  if (isset($_SESSION[$key])) {

   return $_SESSION[$key];

  } else {

   return false;

  }

 }



 public static function checkSession(){

  self::init();

  if (self::get("adminlogin")== false) {

   self::destroy();

   header("Location:login.php");

  }

 }



 public static function checkLogin(){

  self::init();

  if (self::get("adminlogin")== true) {

   header("Location:index.php");

  }

 }



 public static function destroy(){

  session_destroy();

  echo "<script>window.location ='/login.php';</script>";

 }

}

?>