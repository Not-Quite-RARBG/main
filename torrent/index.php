<?php
  require "../config.php";
?>
<!doctype html>
<html>
  <head>
    <title>Not Quite RARBG</title>
    <link href="https://slidemovies.org/FA6Pro/css/all.min.css" rel="stylesheet">
    <style>
      button {
        background-color: #3760BB;
        color: white;
        border-radius: 2px;
        cursor: pointer;
        height: 35px;
        border: 1px solid black;
        padding-left: 10px;
        padding-right: 10px;
        font-family: monospace;
      }
      label.one {
        margin-right: 50px;
      }
      a {
        color: #3760BB;
        font-family: monospace;
        text-decoration: none;
      }
      a:hover {
        color: #3760BB;
        text-decoration: underline;
      }
      th {
        background-color: #D3DDE7;
        text-align: right;
        color: black;
        border-radius: 5px;
      }
      table {
        border-spacing: 0.5px;
      }
      td, th {
        border-bottom: 1px solid lightgrey;
        padding: 5px;
      }
      td {
        text-align: left;
      }
      button > a {
        color: white;
      }
      button > a:hover {
        color: white !important;
      }
    </style>
  </head>
  <body style="background:#000 url(../img/bknd_body.jpg) repeat-x 0 0;;padding-top:30px;font-family:monospace;">
  <img src="/logo_2.png">
  <div style="text-align:center;position:relative;padding-left:104px;">
      <div style="background-color:white;display:inline-block;border-radius:5px;padding:15px;position:relative;width:700px;">
          <button style="position:absolute;left:-110px;width:110px;"><a href="/"><i class="fas fa-house"></i> Home</a></button>
          <button style="position:absolute;left:-110px;width:110px;top:50px;"><a href="/cat/movies/"><i class="fa-solid fa-film"></i> Movies</a></button>
          <button style="position:absolute;left:-110px;width:110px;top:85px;"><a href="/cat/tv%20series/"><i class="fa-solid fa-tv"></i> TV</a></a></button>
          <button style="position:absolute;left:-110px;width:110px;top:120px;"><a href="/cat/games/"><i class="fa-solid fa-game-console-handheld"></i> Games</a></button>
          <button style="position:absolute;left:-110px;width:110px;top:155px;"><a href="/cat/music/"><i class="fa-solid fa-music"></i> Music</a></button>
          <button style="position:absolute;left:-110px;width:110px;top:190px;"><a href="/cat/anime/"><i class="fa-solid fa-a"></i> Anime</a></button>
          <button style="position:absolute;left:-110px;width:110px;top:225px;"><a href="/cat/apps/"><i class="fa-brands fa-app-store-ios"></i> Apps</a></button>
          <button style="position:absolute;left:-110px;width:110px;top:260px;"><a href="/cat/other/"><i class="fa-solid fa-question"></i> Other</a></button>

      <?php
          $url_parts = explode("/", $_SERVER['REQUEST_URI']);
          $id = end($url_parts);
          $jsonData = json_decode(file_get_contents("$api_url/torrent.php?id=$id&key=$api_key"));
          // Render poster image
          if ($jsonData->imdb_id) {
              $result = file_get_contents("https://api.themoviedb.org/3/find/$jsonData->imdb_id?api_key=$tmdb_api_key&external_source=imdb_id");
              $tmdb_res = json_decode($result, true);
          }
        ?>

        <h3><?php echo $jsonData->name; ?></h3>
        <br><br>

        <table style="display:block;">
          <tr>
            <th>
              Torrent:
            </th>
            <td>
              <a href="/torrent.php?u=<?php echo $jsonData->hash; ?>"><img src="/download.png"> <?php echo $jsonData->name; ?></a> <a href="magnet:?xt=urn:btih:<?php echo $jsonData->hash; ?>&dn=<?php echo urlencode($jsonData->name);
                $trackers = file_get_contents("../trackers.txt");
                foreach(explode("\r\n", $trackers) as $item) {
                  echo "&tr=$item";
                }
             ?>"><img src="../img/magnet.gif"></a>
            </td>
                <?php
                    if ($jsonData->imdb_id) {
                        echo '<tr>';
                        echo '<th>Poster:</th>';
                        echo '<td>';
                        if (str_contains($jsonData->cat, "movies")) {
                            echo '<img src="https://image.tmdb.org/t/p/w500/' .$tmdb_res['movie_results'][0]['poster_path']. '">';
                        } else if (str_contains($jsonData->cat, "tv")) {
                            echo '<img src="https://image.tmdb.org/t/p/w500/'.$tmdb_res['tv_results'][0]['poster_path'].'">';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tr>
          </tr>
          <tr>
            <th>
              VPN:
            </th>
            <td>
              Placeholder
            </td>
          </tr>
        <?php
        if ($jsonData->imdb_id) {
            echo '<tr>';
            echo '<th>IMDb ID:</th>';
            echo '<td>'.$jsonData->imdb_id.'</td>';
            echo '</tr>';
          
            echo '<tr>';
            echo '<th>IMDb Score:</th>';
            echo '<td><span class="imdbRatingPlugin" data-user="ur134494520" data-title="'.$jsonData->imdb_id.'" data-style="p3"><a target="_blank" href="https://www.imdb.com/title/'.$jsonData->imdb_id.'/?ref_=plg_rt_1"><img src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/images/imdb_37x18.png" alt="IMDb Rating" /></a></span></td>';
            echo '</tr>';
    
            echo '
            <tr>
              <th>Download Subtitles: </th>
              <td><button onclick="window.open(\'/getSubs.php?id='.$jsonData->imdb_id.'&e=1&s=1\');">Download</button></td>
            </tr>';
        }
        
          <tr>
            <th>Description:</th>
          <td>
            <?php
              if ($jsonData->imdb_id) {
                if (str_contains($jsonData->cat, "movies")) {
                    echo $tmdb_res['movie_results'][0]['overview'];
                } else if (str_contains($jsonData->cat, "tv")) {
                    echo $tmdb_res['tv_results'][0]['overview'];
                }
              } else {
                  echo 'This torrent was scraped from the original RARBG, hence the description was lost in the process of archival.';
              }
          ?></td>
          </tr>
          <tr>
            <th>Category:</th>
            <td><?php
                $catName = $jsonData->cat;
                if ($catName == "pc_iso") {
                  $catName = "Apps";
                }
                else if (str_contains($catName, "games")) {
                  $catName = "Games";
                }
                else if (str_contains($catName, "tv")) {
                  $catName = "TV Series";
                }
                else if (str_contains($catName, "movies")) {
                  $catName = "Movies";
                }
                else if (str_contains($catName, "tv")) {
                  $catName = "Anime";
                }

                echo "<a href=\"/cat/$catName\">$catName</a>";

          ?></td>
          </tr>
          <tr>
            <th>Size:</th>
            <td><?php echo round($jsonData->size / 1e+6); ?> MB</td>
          </tr>
          <tr>
            <th>Added:</th>
            <td><?php echo $jsonData->date; ?></td>
          </tr>
          <tr>
            <th>Peers:</th>
            <td>Seeders: ?, Leechers: ?</td>
          </tr>
          <tr>
            <th>Trackers:</th>
            <td>
            <?php
              echo file_get_contents("../trackers.txt");  
            ?>
            </td>
          </tr>
        </table>
        
      </div>
    </div>
    <script>(function(d,s,id){var js,stags=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js";stags.parentNode.insertBefore(js,stags);})(document,"script","imdb-rating-api");
    </script>
  </body>
</html>
