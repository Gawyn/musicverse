<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'song.class.php';
  require_once 'playlist.class.php';
  $smarty = new SmartyMusicverse();
  $info = array_key_exists('check',$_POST) ? $_POST['check'] : false;
  $smarty->display('musicverse.tpl');
  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
  $_SESSION['file']= "upload/".$_FILES["file"]["name"];
  if($info==true){
    $smarty->display('infomusic.tpl');
  }
  else{
    $song = new song('','','','','',$_SESSION["file"],'');
    $smarty->display('success.tpl');
  }
  playlist::setplaylist();
  $smarty->assign('playlist',$_SESSION['playlist']);
  $smarty->display('end.tpl');
?>
