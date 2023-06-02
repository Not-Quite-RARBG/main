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
  <div style="background-image:url(/img/bknd_body.jpg);position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;"></div>
  <h1 style="position:absolute;top:-10px;color:#3760BB;text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white;">Not Quite</h1>
  <img src="/logo.png">
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
        <form>
          <input type="text" style="width:calc(100% - 200px);height:30px;" placeholder="Search Torrents">
          <button>
            <i class="fas fa-search"></i>
            Search
          </button>
          <button class="closed" onclick="if(this.classList.contains('closed')){this.innerHTML='&lt;&lt;';this.classList.remove('closed');this.classList.add('open');this.nextElementSibling.nextElementSibling.nextElementSibling.style.display='block';}else{this.innerHTML='&gt;&gt;';this.classList.remove('open');this.classList.add('closed');this.nextElementSibling.nextElementSibling.nextElementSibling.style.display='none';}return false;">&gt;&gt;</button>
          <br><br>
          <div style="display:none;text-align:left;">
            <input type="radio" name="cat" id="radMovies">
            <label for="radMovies" class="one">
              <a href="/movies/">Movies</a>
            </label>

            <input type="radio" name="cat" id="radTV">
            <label for="radTV" class="one">
              <a href="/tv/">TV Shows</a>
            </label>

            <input type="radio" name="cat" id="radGames">
            <label for="radGames" class="one">
              <a href="/games/">Games</a>
            </label>


            <input type="radio" name="cat" id="radMusic">
            <label for="radMusic" class="one">
              <a href="/music/">Music</a>
            </label>

            <hr>

            <input type="radio" name="cat" id="radAnime">
            <label for="radAnime" class="two">
              <a href="/anime/">Anime</a>
            </label>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="radio" name="cat" id="radApps">
            <label for="radApps" class="two">
              <a href="/apps/">Apps</a>
            </label>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="radio" name="cat" id="radOther">
            <label for="radOther" class="two">
              <a href="/other/">Other</a>
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
      $jsonData = json_decode(file_get_contents("https://api--nqr.slidemovies.org/"))->data;
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
          foreach ($jsonData as $item) {
            $catName = $item->cat;
            $catLink = $item->cat;
            $catDetails = "";

            switch ($catName) {
              case str_contains($catName, "games"):
                $catName = "Games";
                break;
              case str_contains($catName, "movies"):
                $catName = "Movies";
                break;
              case str_contains($catName, "music"):
                $catName = "Music";
                break;
              case str_contains($catName, "software"):
                $catName = "Software";
                break;
              case str_contains($catName, "tv"):
                $catName = "TV";
                break;
              case str_contains($catName, "xxx"):
                $catName = "XXX";
                break;
              default:
                $catName = "Misc.";
            }

            switch ($catLink) {

              case str_contains($catLink, "ebooks"):
                $catLink = 'images/categories/cat_new7.gif';
                $catDetails = "/eBooks";
                break;
              case str_contains($catLink, "games_pc_iso"):
                $catLink = 'images/categories/cat_new27.gif';
                $catDetails = "/ISO";
                break;
              case str_contains($catLink, "games_pc_rip"):
                $catLink = 'images/categories/cat_new28.gif';
                $catDetails = "/RIP";
                break;
              case str_contains($catLink, "ps3"):
                $catLink = 'images/categories/cat_new40.gif';
                $catDetails = "/PS3";
                break;
              case str_contains($catLink, "ps4"):
                $catLink = 'images/categories/cat_new53.gif';
                $catDetails = "/PS4";
                break;
              case str_contains($catLink, "xbox360"):
                $catLink = 'images/categories/cat_new32.gif';
                $catDetails = "/X360";
                break;
              case str_contains($catLink, "movies"):
                $catLink = 'images/categories/cat_new44.gif';
                $catDetails = "";
                break;
              case str_contains($catLink, "movies_bd_full"):
                $catLink = 'images/categories/cat_new42.gif';
                $catDetails = "/Bluray";
                break;
              case str_contains($catLink, "movies_bd_remux"):
                $catLink = 'images/categories/cat_new46.gif';
                $catDetails = "/BD Remux";
                break;
              case str_contains($catLink, "movies_x264"):
                $catLink = 'images/categories/cat_new44.gif';
                $catDetails = "/x264";
                break;
              case str_contains($catLink, "movies_x264_3d"):
                $catLink = 'images/categories/cat_new47.gif';
                $catDetails = "/x264 3D";
                break;
              case str_contains($catLink, "movies_x264_4k"):
                $catLink = 'images/categories/cat_new50.gif';
                $catDetails = "/x264 4K";
                break;
              case str_contains($catLink, "movies_x264_720"):
                $catLink = 'images/categories/cat_new45.gif';
                $catDetails = "/x264 720p";
                break;
              case str_contains($catLink, "movies_x265"):
                $catLink = 'images/categories/cat_new52.gif';
                $catDetails = "/x265";
                break;
              case str_contains($catLink, "movies_x265_4k"):
                $catLink = 'images/categories/cat_new52.gif';
                $catDetails = "/x265 4K";
                break;
              case str_contains($catLink, "movies_x265_4k_hdr"):
                $catLink = 'images/categories/cat_new52.gif';
                $catDetails = "/x265 4K HDR";
                break;
              case str_contains($catLink, "movies_xvid"):
                $catLink = 'images/categories/cat_new14.gif';
                $catDetails = "/XVID";
                break;
              case str_contains($catLink, "movies_xvid_720"):
                $catLink = 'images/categories/cat_new14.gif';
                $catDetails = "/XVID 720p";
                break;
              case str_contains($catLink, "music_flac"):
                $catLink = 'images/categories/cat_new25.gif';
                $catDetails = "/FLAC";
                break;
              case str_contains($catLink, "music_mp3"):
                $catLink = 'images/categories/cat_new23.gif';
                $catDetails = "/MP3";
                break;
              case str_contains($catLink, "software_pc_iso"):
                $catLink = 'images/categories/cat_new35.gif';
                $catDetails = "/ISO";
                break;
              case str_contains($catLink, "tv"):
                $catLink = 'images/categories/cat_new41.gif';
                $catDetails = "/HD";
                break;
              case str_contains($catLink, "tv_sd"):
                $catLink = 'images/categories/cat_new18.gif';
                $catDetails = "/SD";
                break;
              case str_contains($catLink, "tv_uhd"):
                $catLink = 'images/categories/cat_new49.gif';
                $catDetails = "/UHD";
                break;
              case str_contains($catLink, "xxx"):
                $catLink = 'images/categories/cat_new35.gif';
                $catDetails = "";
                break;
              default:
                #Misc. icon
                $catLink = 'images/categories/cat_new7.gif';
                $catDetails = "";
                break;
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
                <div style="display:inline-block;">2023-06-01<br>08:06:43</div>
              </td>
              <td>
                ' . round($item->size / 1e+6) . ' MB
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