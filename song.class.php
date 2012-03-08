<?php
  require_once 'conn.class.php';
class song{
  public function  __construct($title, $author, $album, $track, $year, $file, $image, $private) {
    $sql = "INSERT into metadata (title, artist, album, track,year,file,image, private, userid) 
      VALUES (:title,:artist,:album,:track,:year,:file,:image, :private, :userid)";
    $conn = conn::getInstance();
    $q = $conn-> prepare($sql);
    $q->execute(array(':title'=>$title,':title'=>$title,':artist'=>$author,':album'=>$album,':track'=>$track,
      ':year'=>$year,':file'=>$file,':image'=>$image,':private'=>$private,':userid'=>$_SESSION['user']));
  }
  public static function searchsong($busca){
    $sql="SELECT * from metadata WHERE title LIKE '%$busca%'";
    $conn = conn::getInstance();
    $result = $conn-> query($sql);
    return $result;
  }
  public static function allsongs(){
    $userid=$_SESSION['user'];
    $sql="SELECT * from metadata WHERE private=0 OR userid='$userid'";
    $conn = conn::getInstance();
    $result = $conn-> query($sql);
    return $result;
  }

  public static function searchmusicbrain($title, $author){

  $doc = new DOMDocument();
  $doc->load("http://musicbrainz.org/ws/2/recording/?query=recording:".$title." and artist:".$author);

  $songs = $doc->getElementsByTagName( "recording" );
  $i=0;
  foreach( $songs as $song ) {
    $canciones[$i]['title'] = $song->getElementsByTagName("title")->item(0)->nodeValue;
    $canciones[$i]['artist'] = $song->getElementsByTagName("name")->item(0)->nodeValue;
    $releaseid = $song->getElementsByTagName("release")->item(0)->getAttribute("id");
    $canciones[$i]['album'] = $song->getElementsByTagName("title")->item(1)->nodeValue;
    $canciones[$i]['year'] = $song ->getElementsByTagName("date")->item(0)->nodeValue;
    $track = $song->getElementsByTagName("track-list")->item(0)->getAttribute("offset");
    $canciones[$i]['track'] = (int)$track+1;
    $doc2 = new DOMDocument();
    $doc2->load("http://musicbrainz.org/ws/2/release/".$releaseid);
    $asin = $doc2->getElementsByTagName("asin")->item(0)->nodeValue;
    $canciones[$i]['image'] = 'http://images.amazon.com/images/P/ASIN/'.$asin;
    $i++;
  }
  return $canciones;
  }
}
