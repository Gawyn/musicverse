<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'song.class.php';
  $smarty = new SmartyMusicverse();
  $smarty->display('musicverse.tpl');
  $canciones = song::searchmusicbrain($_POST["title"],$_POST["author"]);
  $_SESSION['songs']=$canciones;
  $_SESSION['private']=$_POST['private'];
  $smarty->assign('canciones',$canciones);
  $smarty->display('search.tpl');
  $smarty->display('end.tpl');
?>
