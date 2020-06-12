<?php

// Status der Sitzung lässt sich mittels session_status() abfragen
session_start();

if(isset($_POST['session']) && $_POST['session'] == 'recreate') {
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
      $params["domain"], $params["secure"], $params["httponly"]
    );
  }
  session_destroy();
  header('Location: session.php');
  die();
}

if(empty($_SESSION['zaehler'])) {
  $_SESSION['zaehler'] = 1;
} else {
  $_SESSION['zaehler'] += 1;
}
?><!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
  </head>
  <body>
  Beispiel zum Tutorial <a href="https://wiki.selfhtml.org/wiki/PHP/Tutorials/Einstieg/Cookies und Sessions">Cookies und Sessions</a>
<ul>
  <li>Name der Session: <?= htmlspecialchars(session_name()) ?></li>
  <li>Session-ID: <?= htmlspecialchars(session_id()) ?></li>
  <li>maximale Lebensdauer eines Session: <?= htmlspecialchars(ini_get('session.gc_maxlifetime')) ?></li>
  <li>Lebensdauer des Session-Cookies: <?= htmlspecialchars(session_get_cookie_params()['lifetime']) ?> (falls dieser Wert 0 ist, kann das bedeuten, dass er nicht gesetzt wurde. Dann wird der Browser das Cookie erst nach Sitzungsende löschen und nicht mehr mitsenden)</li>
  <li>Dies ist Aufruf Nummer: <?= htmlspecialchars($_SESSION['zaehler']) ?></li>
</ul>
<form method="post">
  <button name="session" value="recreate">Session löschen und neu erstellen</button>
  <button formmethod="get">Seite neu laden (oder F5 drücken)</button>
</form>
</body>
</html>