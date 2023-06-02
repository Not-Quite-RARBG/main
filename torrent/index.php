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
  <body style="background-color:black;padding:30px;font-family:monospace;">
    <div style="background-image:url(/img/bknd_body.jpg);position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;"></div>
    <h1 style="position:absolute;top:-10px;color:#3760BB;text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white;">Not Quite</h1>
    <img src="/logo.png">
    <br><br><br>
    <div style="text-align:center;position:relative;">
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
          $jsonData = json_decode(file_get_contents("https://api--nqr.slidemovies.org/torrent.php?id=$id"));
        ?>

        <h3><?php echo $jsonData->name; ?></h3>
        <br><br>

        <table style="display:block;">
          <tr>
            <th>
              Torrent:
            </th>
            <td>
              <a href="/torrent.php?u=<?php echo $jsonData->hash; ?>"><img src="/download.png"> <?php echo $jsonData->name; ?></a> <a href="magnet:?xt=urn:btih:<?php echo $jsonData->hash; ?>&dn=<?php echo urlencode($jsonData->name); ?>&tr=udp://tracker.opentrackr.org:1337/announce&tr=http://tracker.opentrackr.org:1337/announce&tr=udp://opentracker.i2p.rocks:6969/announce&tr=https://opentracker.i2p.rocks:443/announce&tr=http://tracker.openbittorrent.com:80/announce&tr=udp://tracker.openbittorrent.com:6969/announce&tr=udp://open.demonii.com:1337/announce&tr=udp://open.stealth.si:80/announce&tr=udp://exodus.desync.com:6969/announce&tr=udp://tracker.torrent.eu.org:451/announce&tr=udp://tracker.moeking.me:6969/announce&tr=udp://tracker.bitsearch.to:1337/announce&tr=udp://p4p.arenabg.com:1337/announce&tr=udp://explodie.org:6969/announce&tr=udp://tracker1.bt.moack.co.kr:80/announce&tr=udp://tracker.theoks.net:6969/announce&tr=udp://tracker.altrosky.nl:6969/announce&tr=udp://movies.zsw.ca:6969/announce&tr=https://tracker.tamersunion.org:443/announce&tr=https://tracker.moeblog.cn:443/announce&tr=https://tr.burnabyhighstar.com:443/announce&tr=http://tracker1.bt.moack.co.kr:80/announce&tr=http://open.acgnxtracker.com:80/announce&tr=udp://v1046920.hosted-by-vdsina.ru:6969/announce&tr=udp://uploads.gamecoast.net:6969/announce&tr=udp://trackerb.jonaslsa.com:6969/announce&tr=udp://tracker2.dler.org:80/announce&tr=udp://tracker.tiny-vps.com:6969/announce&tr=udp://tracker.monitorit4.me:6969/announce&tr=udp://tracker.leech.ie:1337/announce&tr=udp://tracker.joybomb.tw:6969/announce&tr=udp://tracker.jonaslsa.com:6969/announce&tr=udp://tracker.bittor.pw:1337/announce&tr=udp://tracker.auctor.tv:6969/announce&tr=udp://tracker.4.babico.name.tr:3131/announce&tr=udp://thouvenin.cloud:6969/announce&tr=udp://thagoat.rocks:6969/announce&tr=udp://sanincode.com:6969/announce&tr=udp://run.publictracker.xyz:6969/announce&tr=udp://private.anonseed.com:6969/announce&tr=udp://open.dstud.io:6969/announce&tr=udp://moonburrow.club:6969/announce&tr=udp://laze.cc:6969/announce&tr=udp://htz3.noho.st:6969/announce&tr=udp://epider.me:6969/announce&tr=udp://bt1.archive.org:6969/announce&tr=udp://bt.ktrackers.com:6666/announce&tr=udp://astrr.ru:6969/announce&tr=udp://acxx.de:6969/announce&tr=udp://aarsen.me:6969/announce&tr=udp://6ahddutb1ucc3cp.ru:6969/announce&tr=https://tracker.loligirl.cn:443/announce&tr=https://tracker.lilithraws.org:443/announce&tr=https://tracker.kuroy.me:443/announce&tr=https://tracker.imgoingto.icu:443/announce&tr=https://t1.hloli.org:443/announce&tr=http://tracker2.dler.org:80/announce&tr=http://tracker.renfei.net:8080/announce&tr=http://tracker.mywaifu.best:6969/announce&tr=http://montreal.nyap2p.com:8080/announce&tr=udp://wepzone.net:6969/announce&tr=udp://v2.iperson.xyz:6969/announce&tr=udp://tracker1.myporn.club:9337/announce&tr=udp://tracker.qu.ax:6969/announce&tr=udp://tracker.pimpmyworld.to:6969/announce&tr=udp://tamas3.ynh.fr:6969/announce&tr=udp://rep-art.ynh.fr:6969/announce&tr=udp://opentracker.io:6969/announce&tr=udp://new-line.net:6969/announce&tr=udp://fe.dealclub.de:6969/announce&tr=udp://download.nerocloud.me:6969/announce&tr=udp://chouchou.top:8080/announce&tr=udp://carr.codes:6969/announce&tr=udp://bt2.archive.org:6969/announce&tr=udp://black-bird.ynh.fr:6969/announce&tr=https://tr.ready4.icu:443/announce&tr=http://wepzone.net:6969/announce&tr=http://tracker.qu.ax:6969/announce&tr=http://tracker.files.fm:6969/announce&tr=http://tracker.dler.org:6969/announce&tr=udp://tracker.swateam.org.uk:2710/announce&tr=udp://tracker.srv00.com:6969/announce&tr=udp://tracker.skyts.net:6969/announce&tr=udp://tracker.publictracker.xyz:6969/announce&tr=udp://tracker.dler.org:6969/announce&tr=udp://tracker.cubonegro.lol:6969/announce&tr=udp://tracker.ccp.ovh:6969/announce&tr=udp://ryjer.com:6969/announce&tr=udp://run-2.publictracker.xyz:6969/announce&tr=udp://open.tracker.ink:6969/announce&tr=udp://inferno.demonoid.is:3391/announce&tr=udp://freedom.1776.ga:6969/announce&tr=udp://free.publictracker.xyz:6969/announce&tr=https://1337.abcvg.info:443/announce&tr=http://www.peckservers.com:9000/announce&tr=http://tracker.skyts.net:6969/announce&tr=http://tracker.bt4g.com:2095/announce&tr=http://open.tracker.ink:6969/announce&tr=http://1337.abcvg.info:80/announce&tr=udp://tracker.artixlinux.org:6969/announce&tr=udp://tracker-udp.gbitt.info:80/announce&tr=udp://tr.bangumi.moe:6969/announce&tr=udp://torrents.artixlinux.org:6969/announce&tr=udp://t.zerg.pw:6969/announce&tr=udp://psyco.fr:6969/announce&tr=udp://mail.artixlinux.org:6969/announce&tr=udp://fh2.cmp-gaming.com:6969/announce&tr=udp://concen.org:6969/announce&tr=udp://boysbitte.be:6969/announce&tr=udp://aegir.sexy:6969/announce&tr=https://tracker.gbitt.info:443/announce&tr=https://t.zerg.pw/announce&tr=http://tracker1.itzmx.com:8080/announce&tr=http://tracker.gbitt.info:80/announce&tr=http://t.acg.rip:6699/announce&tr=http://bt.endpot.com:80/announce"><img src="../img/magnet.gif"></a>
            </td>
          </tr>
          <tr>
            <th>
              VPN:
            </th>
            <td>
              Downloading torrents is getting riskier every day. Use a VPN to make yourself hidden while downloading torrents.<br>It is recommended you use ProtonVPN, which is free and safe.
            </td>
          </tr>
          <tr>
            <th>IMDb ID:</th>
            <td><?php echo $jsonData->imdb_id; ?></td>
          </tr>
          <tr>
            <th>IMDb Score:</th>
            <td><?php 
              if ($jsonData->imdb_id) {
                echo '<span class="imdbRatingPlugin" data-user="ur134494520" data-title="'.$jsonData->imdb_id.'" data-style="p3"><a target="_blank" href="https://www.imdb.com/title/'.$jsonData->imdb_id.'/?ref_=plg_rt_1"><img src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/images/imdb_37x18.png" alt="IMDb Rating" /></a></span>';
              }
            ?></td>
          </tr>
          <tr>
            <th>Description:</th>
            <td>This torrent was scraped from the original RARBG, hence the description was lost in the process of archival.</td>
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
udp://tracker.opentrackr.org:1337/announce<br>

http://tracker.opentrackr.org:1337/announce<br>

udp://opentracker.i2p.rocks:6969/announce<br>

https://opentracker.i2p.rocks:443/announce<br>

http://tracker.openbittorrent.com:80/announce<br>

udp://tracker.openbittorrent.com:6969/announce<br>

udp://open.demonii.com:1337/announce<br>

udp://open.stealth.si:80/announce<br>

udp://exodus.desync.com:6969/announce<br>

udp://tracker.torrent.eu.org:451/announce<br>

udp://tracker.moeking.me:6969/announce<br>

udp://tracker.bitsearch.to:1337/announce<br>

udp://p4p.arenabg.com:1337/announce<br>

udp://explodie.org:6969/announce<br>

udp://tracker1.bt.moack.co.kr:80/announce<br>

udp://tracker.theoks.net:6969/announce<br>

udp://tracker.altrosky.nl:6969/announce<br>

udp://movies.zsw.ca:6969/announce<br>

https://tracker.tamersunion.org:443/announce<br>

https://tracker.moeblog.cn:443/announce<br>

https://tr.burnabyhighstar.com:443/announce<br>

http://tracker1.bt.moack.co.kr:80/announce<br>

http://open.acgnxtracker.com:80/announce<br>

udp://v1046920.hosted-by-vdsina.ru:6969/announce<br>

udp://uploads.gamecoast.net:6969/announce<br>

udp://trackerb.jonaslsa.com:6969/announce<br>

udp://tracker2.dler.org:80/announce<br>

udp://tracker.tiny-vps.com:6969/announce<br>

udp://tracker.monitorit4.me:6969/announce<br>

udp://tracker.leech.ie:1337/announce<br>

udp://tracker.joybomb.tw:6969/announce<br>

udp://tracker.jonaslsa.com:6969/announce<br>

udp://tracker.bittor.pw:1337/announce<br>

udp://tracker.auctor.tv:6969/announce<br>

udp://tracker.4.babico.name.tr:3131/announce<br>

udp://thouvenin.cloud:6969/announce<br>

udp://thagoat.rocks:6969/announce<br>

udp://sanincode.com:6969/announce<br>

udp://run.publictracker.xyz:6969/announce<br>

udp://private.anonseed.com:6969/announce<br>

udp://open.dstud.io:6969/announce<br>

udp://moonburrow.club:6969/announce<br>

udp://laze.cc:6969/announce<br>

udp://htz3.noho.st:6969/announce<br>

udp://epider.me:6969/announce<br>

udp://bt1.archive.org:6969/announce<br>

udp://bt.ktrackers.com:6666/announce<br>

udp://astrr.ru:6969/announce<br>

udp://acxx.de:6969/announce<br>

udp://aarsen.me:6969/announce<br>

udp://6ahddutb1ucc3cp.ru:6969/announce<br>

https://tracker.loligirl.cn:443/announce<br>

https://tracker.lilithraws.org:443/announce<br>

https://tracker.kuroy.me:443/announce<br>

https://tracker.imgoingto.icu:443/announce<br>

https://t1.hloli.org:443/announce<br>

http://tracker2.dler.org:80/announce<br>

http://tracker.renfei.net:8080/announce<br>

http://tracker.mywaifu.best:6969/announce<br>

http://montreal.nyap2p.com:8080/announce<br>

udp://wepzone.net:6969/announce<br>

udp://v2.iperson.xyz:6969/announce<br>

udp://tracker1.myporn.club:9337/announce<br>

udp://tracker.qu.ax:6969/announce<br>

udp://tracker.pimpmyworld.to:6969/announce<br>

udp://tamas3.ynh.fr:6969/announce<br>

udp://rep-art.ynh.fr:6969/announce<br>

udp://opentracker.io:6969/announce<br>

udp://new-line.net:6969/announce<br>

udp://fe.dealclub.de:6969/announce<br>

udp://download.nerocloud.me:6969/announce<br>

udp://chouchou.top:8080/announce<br>

udp://carr.codes:6969/announce<br>

udp://bt2.archive.org:6969/announce<br>

udp://black-bird.ynh.fr:6969/announce<br>

https://tr.ready4.icu:443/announce<br>

http://wepzone.net:6969/announce<br>

http://tracker.qu.ax:6969/announce<br>

http://tracker.files.fm:6969/announce<br>

http://tracker.dler.org:6969/announce<br>

udp://tracker.swateam.org.uk:2710/announce<br>

udp://tracker.srv00.com:6969/announce<br>

udp://tracker.skyts.net:6969/announce<br>

udp://tracker.publictracker.xyz:6969/announce<br>

udp://tracker.dler.org:6969/announce<br>

udp://tracker.cubonegro.lol:6969/announce<br>

udp://tracker.ccp.ovh:6969/announce<br>

udp://ryjer.com:6969/announce<br>

udp://run-2.publictracker.xyz:6969/announce<br>

udp://open.tracker.ink:6969/announce<br>

udp://inferno.demonoid.is:3391/announce<br>

udp://freedom.1776.ga:6969/announce<br>

udp://free.publictracker.xyz:6969/announce<br>

https://1337.abcvg.info:443/announce<br>

http://www.peckservers.com:9000/announce<br>

http://tracker.skyts.net:6969/announce<br>

http://tracker.bt4g.com:2095/announce<br>

http://open.tracker.ink:6969/announce<br>

http://1337.abcvg.info:80/announce<br>

udp://tracker.artixlinux.org:6969/announce<br>

udp://tracker-udp.gbitt.info:80/announce<br>

udp://tr.bangumi.moe:6969/announce<br>

udp://torrents.artixlinux.org:6969/announce<br>

udp://t.zerg.pw:6969/announce<br>

udp://psyco.fr:6969/announce<br>

udp://mail.artixlinux.org:6969/announce<br>

udp://fh2.cmp-gaming.com:6969/announce<br>

udp://concen.org:6969/announce<br>

udp://boysbitte.be:6969/announce<br>

udp://aegir.sexy:6969/announce<br>

https://tracker.gbitt.info:443/announce<br>

https://t.zerg.pw/announce<br>

http://tracker1.itzmx.com:8080/announce<br>

http://tracker.gbitt.info:80/announce<br>

http://t.acg.rip:6699/announce<br>

http://bt.endpot.com:80/announce
            </td>
          </tr>
        </table>
        
      </div>
    </div>
    <script>(function(d,s,id){var js,stags=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js";stags.parentNode.insertBefore(js,stags);})(document,"script","imdb-rating-api");
    </script>
  </body>
</html>
