<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'song.class.php';
  require_once 'playlist.class.php';
  $smarty = new SmartyMusicverse();
  $smarty->display('musicverse.tpl');
  $i=0;
  $canciones=$_SESSION['songs'];
  $c=$canciones[(int)$_POST["search"]];
  if(isset($_SESSION['private'])){
    $private=true;
  }
  else{
    $private=false;
  }
  $song = new song($c['title'],$c['artist'],$c['album'],(int)$c["track"],$c["year"],$_SESSION["file"],$c["image"], $private);
  $smarty->display('success.tpl');
  playlist::setplaylist();
  $smarty->assign('playlist',$_SESSION['playlist']);
  $smarty->display('end.tpl');
?>
