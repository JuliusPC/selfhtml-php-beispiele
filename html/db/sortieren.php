<?php
// Datenbank-Verbindung aufbauen:
$dbh = new \PDO('sqlite:'.__DIR__.'/../../adressen.sqlite3');
$dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

// anzuzeigende Spalten in der DB den anzuzeigenden Namen zuordnen:
$spalten = [
  'vorname' => 'Vorname',
  'nachname' => 'Nachname',
  'stadt' => 'Stadt',
  'strasse' => 'Straße',
  'plz' => 'PLZ',
  'notiz' => 'Anmerkung'
];

$reihenfolgen = [
  'ASC' => 'aufsteigend',
  'DESC' => 'absteigend'
];

// Sortierung bestimmen:
$order = array_key_exists($_GET['order']??'', $reihenfolgen);
$by = array_key_exists($_GET['by']??'', $spalten);
if($order && $by) {
  $order = ' ORDER BY '.$_GET['by'].' '.$_GET['order'];
} elseif($order xor $by) {
  // hier fummelt wer an den Parametern herum...
  header('Location: ./');
  die();
} else {
  $_GET['by'] = 'nachname';
  $_GET['order'] = 'ASC';
}
$order = ' ORDER BY '.$_GET['by'].' '.$_GET['order'];



?><!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortieren</title>
    <style>
      html {
        font-family:sans-serif;
      }

      table, th, tr, td {
        border-collapse:collapse;
        border: thin solid gray;
      }

      th, td {
        padding: 0.2em 0.4em;
      }
    </style>
  </head>
  <body>
    <table>
      <thead>
        <tr>
<?php
foreach ($spalten as $schluessel => $name) {
  echo '<th>';
  
  if($_GET['by'] == $schluessel) {
     
    if($_GET['order'] == 'ASC') {
      $order_by = 'DESC';
      $order_symbol = '⌃';
      $title = 'Nach dieser Spalte absteigend sortieren';
    } else {
      $order_by = 'ASC';
      $order_symbol = '⌄';
      $title = 'Nach dieser Spalte aufsteigend sortieren';
    }
  } else {
    $order_by = 'ASC';
    $order_symbol = '';
    $title = 'Nach dieser Spalte aufsteigend sortieren';
  }
  echo '<a href="?by='.htmlspecialchars(urlencode($schluessel).'&order='.urlencode($order_by)).'" title="'.htmlspecialchars($title).'">',
  htmlspecialchars($name), $order_symbol, '</a>';
  echo '</th>';
}
?>
        </tr>
      </thead>
      <tbody>
<?php
$results = $dbh->query('SELECT * FROM `adressen`'.$order);

foreach($results as $result) {
  echo '<tr>';

  foreach ($spalten as $schluessel => $name) {
    echo '<td>', htmlspecialchars($result[$schluessel]), '</td>';
  }
  
  echo '</tr>';
}
?>
      <tbody>
    <table>
  </body>
</html>
