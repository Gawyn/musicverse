<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'song.class.php';
  $smarty = new SmartyMusicverse();
  $smarty->display('musicverse.tpl');
  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/images/" . $_FILES["file"]["name"]);
  $song = new song($_POST['title'],$_POST['author'],$_POST['album'],(int)$_POST["track"],(int)$_POST["year"],$_SESSION["file"],"upload/images/".$_FILES["file"]["name"]);
  $smarty->display('success.tpl');
  playlist::setplaylist();
  $smarty->assign('playlist',$_SESSION['playlist']);
  $smarty->display('end.tpl');
?>
