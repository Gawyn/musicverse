<?php
  require_once 'conn.class.php';
class user{
  public function  __construct($username, $password,$email) {
    $sql = "INSERT into users (username, password, mail) VALUES (:username, :password, :mail)";
    $conn = conn::getInstance();
    $q = $conn-> prepare($sql);
    $q->execute(array(':username'=>$username,
      ':password'=>md5($password),':mail'=>$email));
  }
  public static function userexist($name,$epass){
    $sql="SELECT * from users WHERE username='$name' and password='$epass'";
    $conn = conn::getInstance();
    $result = $conn-> query($sql);
    if($result==null){return 0;}
    else{
      foreach($result as $res)
        return $res['userid'];
    }
  }
}
