<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Overlay</title>
    <link rel="icon" href="../media/Logo_Poitrine_Armorikès.svg" />
    <link href="../css/hotlines_page.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <div id="background">
      <a href="../index.php"
        ><button id="backButton">
          <i class="arrow left"></i></button
      ></a>
      <?php
        require("fun.php");

        if (array_key_exists('pp', $_FILES)) {
            $arr = overlay();
            if (!$arr[0]){
                echo $arr[1]; //message d'erreur
            }
            else{
                $src_pp = $arr[1];
                echo <<<FIN
                <h2>
                  <div id="form-container">
                    <a href="$src_pp" download>Télécharger</a><br>
                    <img src="$src_pp" width="250" height="250" alt="photo profil avec overlay">
                    <p>Je ne suis pas satisfait du montage, je souhaite réaliser l'overlay moi même: <br><a href="img/overlay.png" download>Télécharger l'overlay</a></p>
                  </div>
                </h2>
                FIN;
            }
        } else {
      ?>
      <div id="form-container">
        <form enctype="multipart/form-data" action="fusion.php" method="post">
          <div class="mb-3">
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="pp" class="form-label">Photo de profil</label><br>
            <input type="file" class="form-control" name="pp" id="pp" />
          </div>
          <br>
          <div class="form-command sub">
            <button type="submit" id="validate">Envoyer et appliquer l'overlay</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html> 
<?php
}


//make sure to modify upload size & post size