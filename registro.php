<?php session_start();
  require 'SmartyMusicverse.php';
  include 'user.class.php';
  if(array_key_exists('username',$_GET)){
    $user = new user($_GET['username'],$_GET['passwd'],$_GET['mail']);
  }
  $smarty = new SmartyMusicverse();
  $smarty->display('musicverse.tpl');
  if(isset($_SESSION['username'])){
    $smarty->display('home.tpl');
  }
  else{
    $smarty->display('registro.tpl');
  }
  $smarty->display('end.tpl');
?>
