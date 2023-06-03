<?php
  require "config.php";
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

    thead {
      background-color: #3760BB;
      color: white;
      text-decoration: underline;
    }

    table {
      border-spacing: 0.5px;
    }

    tbody {
      background-color: #D3DDE7;
    }

    td,
    th {
      border: 1px solid white;
      padding: 5px;
    }

    button>a {
      color: white;
    }

    button>a:hover {
      color: white !important;
    }
  </style>
</head>

<body style="background-color:black;padding:30px;font-family:monospace;">
  <div style="background-image:url(/img/bknd_body.jpg);background-repeat:repeat-x;position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;"></div>
  <img src="/logo_2.png">
  <br><br><br>
  <div style="text-align:center;position:relative;">
    <div style="background-color:white;display:inline-block;border-radius:5px;padding:15px;position:relative;">
      <button style="position:absolute;left:-110px;width:110px;"><a href="/"><i class="fas fa-house"></i> Home</a></button>
      <button style="position:absolute;left:-110px;width:110px;top:50px;"><a href="/cat/movies/"><i class="fa-solid fa-film"></i> Movies</a></button>
      <button style="position:absolute;left:-110px;width:110px;top:85px;"><a href="/cat/tv%20series/"><i class="fa-solid fa-tv"></i> TV</a></a></button>
      <button style="position:absolute;left:-110px;width:110px;top:120px;"><a href="/cat/games/"><i class="fa-solid fa-game-console-handheld"></i> Games</a></button>
      <button style="position:absolute;left:-110px;width:110px;top:155px;"><a href="/cat/music/"><i class="fa-solid fa-music"></i> Music</a></button>
      <button style="position:absolute;left:-110px;width:110px;top:190px;"><a href="/cat/anime/"><i class="fa-solid fa-a"></i> Anime</a></button>
      <button style="position:absolute;left:-110px;width:110px;top:225px;"><a href="/cat/apps/"><i class="fa-brands fa-app-store-ios"></i> Apps</a></button>
      <button style="position:absolute;left:-110px;width:110px;top:260px;"><a href="/cat/other/"><i class="fa-solid fa-question"></i> Other</a></button>

      <h3>Recommended Torrents:</h3>
      ...Placeholder..<br><br>
      <div style="background-color:#D3DDE7;padding:15px;width:600px;display:inline-block;border-radius:3px;">
        <form action="/search/" method="GET">
          <input name="q" type="text" style="width:calc(100% - 200px);height:30px;" placeholder="Search Torrents">
          <button>
            <i class="fas fa-search"></i>
            Search
          </button>
          <button class="closed" onclick="if(this.classList.contains('closed')){this.innerHTML='&lt;&lt;';this.classList.remove('closed');this.classList.add('open');this.nextElementSibling.nextElementSibling.nextElementSibling.style.display='block';}else{this.innerHTML='&gt;&gt;';this.classList.remove('open');this.classList.add('closed');this.nextElementSibling.nextElementSibling.nextElementSibling.style.display='none';}return false;">&gt;&gt;</button>
          <br><br>
          <div style="display:none;text-align:left;">
            <input type="radio" name="cat" id="radMovies">
            <label for="radMovies" class="one">
              <a href="/cat/movies/">Movies</a>
            </label>

            <input type="radio" name="cat" id="radTV">
            <label for="radTV" class="one">
              <a href="/cat/tv/">TV Shows</a>
            </label>

            <input type="radio" name="cat" id="radGames">
            <label for="radGames" class="one">
              <a href="/cat/games/">Games</a>
            </label>


            <input type="radio" name="cat" id="radMusic">
            <label for="radMusic" class="one">
              <a href="/cat/music/">Music</a>
            </label>

            <hr>

            <input type="radio" name="cat" id="radAnime">
            <label for="radAnime" class="two">
              <a href="/cat/anime/">Anime</a>
            </label>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="radio" name="cat" id="radApps">
            <label for="radApps" class="two">
              <a href="/cat/apps/">Apps</a>
            </label>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="radio" name="cat" id="radOther">
            <label for="radOther" class="two">
              <a href="/cat/other/">Other</a>
            </label>

            <br><br>

            <div style="text-align:center;">
              <a href="#" onclick="this.parentElement.parentElement.reset();">[x] Clear Categories</a>
            </div>
          </div>
        </form>
      </div>

      <br><br><br><br>
      <?php
      $jsonData = json_decode(file_get_contents($api_url.'/?key='.$api_key))->data;
      ?>

      <table>
        <thead>
          <th>
            Cat.
          </th>
          <th>
            File
          </th>
          <th>
            Category
          </th>
          <th>
            Added
          </th>
          <th>
            Size
          </th>
          <th>
            S.
          </th>
          <th>
            L.
          </th>
        </thead>
        <tbody>
          <?php
          $catNameMappings = [
            'games' => 'Games',
            'movies' => 'Movies',
            'music' => 'Music',
            'software' => 'Software',
            'tv' => 'TV',
          ];

          $catLinkMappings = [
            'ebooks' => ['image' => 'images/categories/cat_new7.gif', 'details' => '/eBooks'],
            'games_pc_iso' => ['image' => 'images/categories/cat_new27.gif', 'details' => '/ISO'],
            'games_pc_rip' => ['image' => 'images/categories/cat_new28.gif', 'details' => '/RIP'],
            'ps3' => ['image' => 'images/categories/cat_new40.gif', 'details' => '/PS3'],
            'ps4' => ['image' => 'images/categories/cat_new53.gif', 'details' => '/PS4'],
            'xbox360' => ['image' => 'images/categories/cat_new32.gif', 'details' => '/X360'],
            'movies' => ['image' => 'images/categories/cat_new44.gif', 'details' => ''],
            'movies_bd_full' => ['image' => 'images/categories/cat_new42.gif', 'details' => '/Bluray'],
            'movies_bd_remux' => ['image' => 'images/categories/cat_new46.gif', 'details' => '/BD Remux'],
            'movies_x264' => ['image' => 'images/categories/cat_new44.gif', 'details' => '/x264'],
            'movies_x264_3d' => ['image' => 'images/categories/cat_new47.gif', 'details' => '/x264 3D'],
            'movies_x264_4k' => ['image' => 'images/categories/cat_new50.gif', 'details' => '/x264 4K'],
            'movies_x264_720' => ['image' => 'images/categories/cat_new45.gif', 'details' => '/x264 720p'],
            'movies_x265' => ['image' => 'images/categories/cat_new52.gif', 'details' => '/x265'],
            'movies_x265_4k' => ['image' => 'images/categories/cat_new52.gif', 'details' => '/x265 4K'],
            'movies_x265_4k_hdr' => ['image' => 'images/categories/cat_new52.gif', 'details' => '/x265 4K HDR'],
            'movies_xvid' => ['image' => 'images/categories/cat_new14.gif', 'details' => '/XVID'],
            'movies_xvid_720' => ['image' => 'images/categories/cat_new14.gif', 'details' => '/XVID 720p'],
            'music_flac' => ['image' => 'images/categories/cat_new25.gif', 'details' => '/FLAC'],
            'music_mp3' => ['image' => 'images/categories/cat_new23.gif', 'details' => '/MP3'],
            'software_pc_iso' => ['image' => 'images/categories/cat_new35.gif', 'details' => '/ISO'],
            'tv' => ['image' => 'images/categories/cat_new41.gif', 'details' => '/HD'],
            'tv_sd' => ['image' => 'images/categories/cat_new18.gif', 'details' => '/SD'],
            'tv_uhd' => ['image' => 'images/categories/cat_new49.gif', 'details' => '/UHD'],
          ];

          foreach ($jsonData as $item) {
            $catName = $item->cat;
            $catLink = $item->cat;
            $catDetails = "";

            // Map the catName
            foreach ($catNameMappings as $keyword => $mappedName) {
              if (str_contains($catName, $keyword)) {
                $catName = $mappedName;
                break;
              }
            }

            // Map the catLink
            foreach ($catLinkMappings as $keyword => $mapping) {
              if (str_contains($catLink, $keyword)) {
                $catLink = $mapping['image'];
                $catDetails = $mapping['details'];
                break;
              }
            }



            echo '<tr>
              <td>
                <img src="/' . $catLink . '">
              </td>
              <td>
                <div style="text-align:left;">
                  <a href="/torrent/' . $item->ext_id . '" style="font-weight:900;">' . $item->name . '</a>
                </div>
              </td>
              <td>
                <a href="/cat/' . $catName . '" style="font-weight:900;">' . $catName . $catDetails . '</a>
              </td>
              <td>
                <div style="display:inline-block;">'.explode(" ", $item->date)[0].'<br>'.explode(" ", $item->date)[1].'</div>
              </td>
              <td>
                 ' . (($item->size < 1073741824) ? number_format($item->size / 1048576, 1) . " MB" : number_format($item->size / 1073741824, 2) . " GB") . ' 
              </td>
              <td style="color:green;">
                ?
              </td>
              <td style="color:red;">
                ?
              </td>
            </tr>';
          }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</body>

</html>
