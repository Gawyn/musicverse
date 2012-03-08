<form action="addtoplaylist.php" method="get">
<input type="text" name="searchsong">
<input type="submit">
</form>
<form action="addtoplaylist.php" method="post">
<ul>
{foreach $playlists as $p}
  <li>{$p['playlistid']} <input type="radio" name="playlist" value="{$p['playlistid']}"></li>
{/foreach}
</ul>
<br />
<br />
<ul>
{foreach $songs as $song}
  <li>{$song['title']} <input type="checkbox" name="{$song['metadataid']}"></li>
{/foreach}
</ul>
<input type="submit">
</form>
