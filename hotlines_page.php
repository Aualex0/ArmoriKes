<?php session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Commandes</title>
    <link rel="icon" href="media/Logo_Poitrine_Armorikès.svg" />
    <link href="css/hotlines_page.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <div id="background">
      <a href="index.php"
        ><button id="backButton">
          <i class="arrow left"></i></button
      ></a>
      <div id="form-container">
        <form action="hotlines_page.php" method="POST" header="" class="form-command">
          <div class="form-command sub">
            <label for="surname">Bénéficiaire : </label>
            <input
              type="text"
              name="surname"
              id="surname"
              placeholder="Aubelix"
              required
            />
          </div>
          <div class="form-command sub">
            <label for="room">Lieu : </label>
            <input
              type="text"
              name="room"
              id="room"
              placeholder="Alésia"
              required
            />
          </div>
          <div class="form-command sub">
            <label for="distinct">Signe Distinctif : </label>
            <input
              type="text"
              name="distinct"
              id="rdistinct"
              placeholder="Casque ailé"
              required
            />
          </div>
          <div class="form-command sub">
            <label for="id_hotline">Objet : </label>
            <select name="id_hotline" id="id_hotline-select" required>
              <option value="">--Choisir un objet--</option>
              <option value="1">Crêpe</option>
              <option value="2">Enlèvement</option>
              <option value="3">Accrosport</option>
              <option value="4">Turn Up</option>
              <option value="5">Anniversaire</option>
            </select>
          </div>
          <div class="form-command sub">
            <input type="submit" value="Saucisser !" id="validate" />
          </div>
          <div class="form-command sub" id="validater">
            <i class="material-icons md-36">check</i>
            <p class="validater-text">
              Votre commande a bien été <br />
              validée.
            </p>
          </div>
          <div class="form-command sub" id="problem">
            <i class="material-icons md-36">close</i>
            <p class="validater-text">
              Il y eu une erreur. <br />
              Veuillez rééssayer.
            </p>
          </div>
          <div class="form-command sub disclaimer">
            <i class="material-icons md-36">warning</i>
            <p class="disclaimer-text">
              Seules les commandes en PC <br />
              et en amphi seront honorées.
            </p>
          </div>
          <input type="hidden" name="token" value="<?php echo $token?>">
        </form>
      </div>
    </div>
  </body>
</html>

<?php include('formsubmit-pdo.php') ?>
