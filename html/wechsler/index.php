<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bildwechsler</title>
  </head>
  <body>
    Beispiel zum Tutorial <a href="https://wiki.selfhtml.org/wiki/PHP/Tutorials/Wechsellogik">Wechsellogik</a>
    <main>
  <?php
$bilder = glob(__DIR__.'/*.jpg');
$bild = basename($bilder[array_rand($bilder)]);
  ?>
  Das folgende Bild wird bei jedem Laden der Seite zufällig ausgewählt:<br>
  <img src="<?= htmlspecialchars($bild, ENT_HTML5 | ENT_QUOTES) ?>" alt="ein zufällig ausgewähltes Raumfahrtbild">
   </main>
  </body>
</html>
