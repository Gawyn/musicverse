<form action="info.php" method="post">
<table>
{$i=0}
{foreach $canciones as $c}
<tr>
<td>{$c['title']}</td>
<td>{$c['artist']}</td>
<td>{$c['album']}</td>
<td>{$c['track']}</td>
<td>{$c['year']}</td>
<td><img src="{$c['image']}"></td>
<td><input type="radio" name="search" value="{$i}"></td>
</tr>
{$i++}
{/foreach}
</table>
<input type="submit">
</form>
