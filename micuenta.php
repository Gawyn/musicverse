<?php session_start();
  require 'SmartyMusicverse.php';
  include 'user.class.php';
  $smarty = new SmartyMusicverse();
  $smarty->display('musicverse.tpl');
  if(isset($_SESSION['user'])){
    $smarty->display('micuenta.tpl');
  }
  else{
    $smarty->display('restringido.tpl');
  }
  $smarty->display('end.tpl');
?>
