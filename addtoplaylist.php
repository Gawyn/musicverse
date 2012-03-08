<?php session_start();
  require 'SmartyMusicverse.php';
  require_once 'user.class.php';
  require_once 'song.class.php';
  require_once 'playlist.class.php';
  $smarty = new SmartyMusicVerse();
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
    if(isset($_POST["playlist"])){
      $i=0;
      $N=0;
      $songs = song::allsongs();
      foreach($songs as $song){
        $N++;
      }
      while($i<$N){
        if(isset($_POST[$i])){
          playlist::afegirsong($_POST['playlist'],$i);
        }
        $i++;
      }
    }
    $smarty->assign('songs',$songs);
    $smarty->display('addsongtoplaylist.tpl');
  }
  else{
    $smarty->display('restringido.tpl');
  }
  $playlists = playlist::setplaylist();
  $smarty->assign('playlist',$_SESSION['playlist']);
  $smarty->display('end.tpl');
?>

