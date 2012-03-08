<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'song.class.php';
  require_once 'playlist.class.php';
  $smarty = new SmartyMusicverse();
  $playlist = new playlist($_POST,$_SESSION['user']);
  $smarty->display('success.tpl');
  $smarty->display('end.tpl');
?>
