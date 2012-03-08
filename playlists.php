<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'song.class.php';
  require_once 'playlist.class.php';
  $smarty = new SmartyMusicverse();
  $smarty->display('musicverse.tpl');
  if(isset($_SESSION["user"])){
    $playlists = playlist::allmyplaylists();
    $smarty->assign('playlists',$playlists);
    if(isset($_GET["searchsong"])){
      $songs = song::searchsong($_GET["searchsong"]);
    }
    else{
      $songs = song::allsongs();
    }
    $smarty->assign('songs',$songs);
    $smarty->display('playlists.tpl');
    if(isset($_POST["playlist"])){
      $_SESSION["playlist"]=playlist::getPlaylistbyID($_POST['playlist']);
    }
  }
  else{
    $smarty->display('restringido.tpl');
  }
  $playlists = playlist::setplaylist();
  $smarty->assign('playlist',$_SESSION['playlist']);
  $smarty->display('end.tpl');
?>
