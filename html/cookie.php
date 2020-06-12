<?php
define('COOKIE_NAME', 'SELF_test');

if (!isset($_COOKIE[COOKIE_NAME])) {
    $aufruf = 1;
} else {
    $aufruf = $_COOKIE[COOKIE_NAME] + 1;
}

$meldung = 'Dies ist Aufruf Nr. ' . $aufruf;

setcookie(COOKIE_NAME, $aufruf);
?><!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie</title>
  </head>
  <body>
    <p><?= htmlspecialchars($meldung) ?></p>

    <form method="post">
      <button formmethod="get">Seite neu laden (oder F5 drücken)</button>
    </form>
  </body>
</html>
