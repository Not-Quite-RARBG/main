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
      td, th {
        border: 1px solid white;
        padding: 5px;
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
          <button style="position:absolute;left:-110px;width:110px;"><i class="fas fa-house"></i> Home</button>
          <button style="position:absolute;left:-110px;width:110px;top:50px;"><i class="fa-solid fa-film"></i> Movies</button>
          <button style="position:absolute;left:-110px;width:110px;top:85px;"><i class="fa-solid fa-tv"></i> TV Shows</button>
          <button style="position:absolute;left:-110px;width:110px;top:120px;"><i class="fa-solid fa-game-console-handheld"></i> Games</button>
          <button style="position:absolute;left:-110px;width:110px;top:155px;"><i class="fa-solid fa-music"></i> Music</button>
          <button style="position:absolute;left:-110px;width:110px;top:190px;"><i class="fa-solid fa-a"></i> Anime</button>
          <button style="position:absolute;left:-110px;width:110px;top:225px;"><i class="fa-brands fa-app-store-ios"></i> Apps</button>
          <button style="position:absolute;left:-110px;width:110px;top:295px;"><i class="fa-solid fa-question"></i> Other</button>
        
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
          $jsonData = json_decode(file_get_contents("https://rabrg.notslidemoviesss.repl.co/"))->data;
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

                if (str_contains($catLink, "xvid")) {
                  $catLink = 'xvid.gif';
                  $catDetails = "/XVid";
                }
                else if (str_contains($catLink, "x264")) {
                  $catLink = 'x264.gif';
                  $catDetails = "/X264";
                }
                else if (str_contains($catLink, "tv")) {
                  $catLink = 'tv.gif';
                  $catDetails = "";
                }
                else if (str_contains($catLink, "x265")) {
                  $catLink = 'x264.gif';
                  $catDetails = "/x265";
                }
                else if (str_contains($catLink, "remux")) {
                  $catLink = 'remux.gif';
                  $catDetails = "";
                }
                else if (str_contains($catLink, "anime")) {
                  $catLink = 'tv.gif';
                }
                else if (str_contains($catLink, "games")) {
                  $catLink = 'games_pc_iso.gif';
                  $catDetails = "";
                }
                else {
                  $catLink = 'pc_iso.gif';
                  $catDetails = "";
                }
                
                echo '<tr>
              <td>
                <img src="/'.$catLink.'">
              </td>
              <td>
                <div style="text-align:left;">
                  <a href="/torrent/'.$item->ext_id.'" style="font-weight:900;">'.$item->name.'</a>
                </div>
              </td>
              <td>
                <a href="/cat/'.$catName.'" style="font-weight:900;">'.$catName.$catDetails.'</a>
              </td>
              <td>
                <div style="display:inline-block;">2023-06-01<br>08:06:43</div>
              </td>
              <td>
                '.round($item->size / 1e+6).' MB
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
