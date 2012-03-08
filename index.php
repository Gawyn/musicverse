<?php session_start();
  require 'SmartyMusicverse.php';
  include 'user.class.php';
  require_once 'playlist.class.php';
  $smarty = new SmartyMusicverse();
  $mode = array_key_exists('mode',$_GET) ? $_GET['mode'] : 'principal';
  $smarty->assign('mode',$mode);
  $smarty->display('musicverse.tpl');
  if(isset($_GET['logout'])){
    session_destroy();
  }
  if(isset($_POST['username']) && isset($_POST['passwd'])){
    $name = $_POST['username'];
    $epass=md5($_POST['passwd']);
    $b = user::userexist($name,$epass);
    if($b > 0){
      $_SESSION['user']=$b;
    }
  }
  if(isset($_SESSION['user'])){
    $smarty->display('musicmenu.tpl');
  }
  else{
    $smarty->display('home.tpl');
  }
  playlist::setplaylist();
  $smarty->assign('playlist',$_SESSION['playlist']);
  $smarty->display('end.tpl');
?>

