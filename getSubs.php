<?php
  require "config.php";
  $tmdb_response = json_decode(file_get_contents("https://api.themoviedb.org/3/find/$_GET[id]?api_key=$tmdb_api_key&external_source=imdb_id"));
  if (isset($tmdb_response->movie_results[0])) {
    $id = $tmdb_response->movie_results[0]->id;
    $title = $tmdb_response->tv_results[0]->title;
    $type = "Movie";
  }
  else {
    $id = $tmdb_response->tv_results[0]->id;
    $title = $tmdb_response->tv_results[0]->name;
    $type = "TV";
  }
  echo "<h1>Subs for $title</h1>";
  echo "<form action=\"/getSubs.php\" method=\"GET\">
    <input type=\"hidden\" value=\"$_GET[id]\">
    Season Number <input type=\"text\" name=\"s\" value=\"$_GET[s]\">
    Episode Number <input type=\"text\" name=\"e\" value=\"$_GET[e]\">
    <button type=\"submit\">Submit</button>
  </form>";
  $consumet_response = json_decode(file_get_contents("$consumetInstanceURL/meta/tmdb/info/$id?type=$type"));
  $episodeId = $consumet_response->seasons[$_GET['s'] - 1]->episodes[$_GET['e'] - 1]->id;
  $showId = $consumet_response->id;
  $streaming_links = json_decode(file_get_contents("$consumetInstanceURL/meta/tmdb/watch/$episodeId?id=$showId"));
  $subs = $streaming_links->subtitles;
  echo "<ol>";
  foreach($subs as $item) {
    if ($item->lang == "Default (maybe)") { continue; }
    echo "<li><a href=\"$item->url\">$item->lang</a></li>";
  }
  echo "</ol>";
?>
