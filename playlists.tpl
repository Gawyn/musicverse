<form enctype="multipart/form-data" action="upload.php" method="post">
File: <input type="file" id="file" name="file" /><br />
Desea guardar información? <input type="checkbox" name="check" id="info" />
<input type="submit" />
</form>
<br />
<br />
<form action="playlists.php" method="post">
<ul>
{foreach $playlists as $p}
  <li>{$p['playlistid']} <input type="radio" name="playlist" value="{$p['playlistid']}"></li>
{/foreach}
</ul>
<input type="submit">
</form>
<br />
<br />
<form action"playlists.php" method="get">
<input type="text" name="searchsong">
<input type="submit">
</form>
<form action="newplaylist.php" method="post">
<ul>
{foreach $songs as $song}
  <li>{$song['title']} <input type="checkbox" name="{$song['metadataid']}"></li>
{/foreach}
</ul>
<input type="submit">
</form>
