<?php
  require_once 'conn.class.php';
class playlist{
  public function  __construct($canciones,$userid){
    $newxml = playlist::newplay();
    $myfile = "xml/".$newxml.".xspf";
    $fh = fopen($myfile, 'w');
    fwrite($fh, '<?xml version="1.0" encoding="UTF-8"?>
      <playlist version="1" xmlns="http://xspf.org/ns/0/">
        <trackList>
      ');
    $songs = song::allsongs();
    $i=1;
    foreach($songs as $song){
      if(isset($canciones[$i])){
        fwrite($fh,"<track><location>".$song['file']."</location>
          <title>".$song['title']."</title>
          <creator>".$song['artist']."</creator>
          <image>".$song['image']."</image>
          <album>".$song['album']."</album>
          </track>\n");
      }
      $i++;
    }
    fwrite($fh,"</trackList>\n</playlist>");
    fclose($fh);
    $sql = "INSERT into playlists (xml, userid) 
      VALUES (:xml,:userid)";
    $conn = conn::getInstance();
    $q = $conn-> prepare($sql);
    $q->execute(array(':xml'=>$myfile,':userid'=>$userid));
  }
  public static function afegirsong($playid,$songid){
    $sql="SELECT * from metadata WHERE metadataid='$songid'";
    $conn = conn::getInstance();
    $song = $conn->query($sql);
    $sql="SELECT * from playlists WHERE playlistid='$playid'"; 
    $playlist = $conn->query($sql);
    foreach($song as $s){
      $songfound = $s;
    }
    foreach($playlist as $p){
      $playfile = $p['xml'];
    }
    $doc = new SimpleXMLElement($playfile,null,true);
    $tracklist = $doc->trackList;
    $track = $tracklist->addChild('track');
    $track->addChild('title',$songfound['title']);
    $track->addChild('creator',$songfound['artist']);
    $track->addChild('image',$songfound['image']);
    $track->addChild('album',$songfound['album']);
    $doc->asXML($playfile);
    $doc->asXML("xml/aa.xml");
  }
  public static function getPlaylistbyID($id){
    $sql="SELECT * from playlists WHERE playlistid='$id'";
    $conn = conn::getInstance();
    $result = $conn-> query($sql);
    foreach($result as $row){
      return $row['xml'];
    }
  }
  public static function allmyplaylists(){
    $userid = $_SESSION["user"];
    $sql="SELECT * from playlists WHERE userid='$userid'";
    $conn = conn::getInstance();
    $result = $conn-> query($sql);
    return $result;
  }
  public static function newplay(){
    $sql = "SELECT * from playlists ORDER BY playlistid DESC";
    $conn = conn::getInstance();
    $result = $conn->query($sql);
    foreach($result as $row){
      return $row['playlistid'];
    }
  }
  public static function setplaylist(){
    if(!(isset($_SESSION['playlist']))){
      $_SESSION['playlist']='xml/userplaylist.xspf';
    }
  }
}
