<?php

### ACTION ###

// inclusions de la librairie permettant une connexion curl
require_once dirname(__FILE__).'/../lib/RestConnection.php';

$requestHeader = array('Accept: application/json', 'Content-Type: application/json');

$api = new RESTConnection('http://localhost/referentiels/app.php/api', $requestHeader, 'recueil', 'recueil69');

$api->request('/sejours');

$sejourPerMonth = array();

foreach (json_decode($api->getResponseBody(), true) as $sejour)
{
  if (isset($sejour['date_admission']))
  {
    $month = date('Y/m', strtotime($sejour['date_admission']));
    if (!isset($sejourPerMonth[$month]))
    {
      $sejourPerMonth[$month] = 0;
    }

    $sejourPerMonth[$month]++;
  }
}

ksort($sejourPerMonth);

### TEMPLATE ###

?>

<div class="board double">
  <table class="highchart" data-graph-container-before="1" data-graph-type="column"><thead>
  <caption>Nombre de séjours par mois</caption>
    <thead>
    <tr>
      <th>Mois</th>
      <th>Nombre de séjours</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sejourPerMonth as $month => $number): ?>
    <tr>
      <td><?php echo $month ?></td>
      <td><?php echo $number ?></td>
    </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>