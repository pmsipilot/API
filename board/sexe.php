<?php

### ACTION ###

// inclusions de la librairie permettant une connexion curl
require_once dirname(__FILE__).'/../lib/RestConnection.php';

$requestHeader = array('Accept: application/json', 'Content-Type: application/json');

$api = new RESTConnection('http://localhost/referentiels/app.php/api', $requestHeader, 'recueil', 'recueil69');

$api->request('/identites');

$sexes = array();
$total = 0;

foreach (json_decode($api->getResponseBody(), true) as $sexe)
{
  if (isset($sexe['sexe']))
  {
    $aSexe = $sexe['sexe'];
    if (!isset($sexes[$aSexe]))
    {
      $sexes[$aSexe] = 0;
    }

    $sexes[$aSexe]++;
    $total++;
  }
}

ksort($sexes);

### TEMPLATE ###

?>

<div class="board">
  <table class="highchart" data-graph-container-before="1" data-graph-type="column"><thead>
  <caption>Sexe</caption>
    <thead>
    <tr>
      <th>Type</th>
      <th>Pourcentage</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sexes as $type => $number): ?>
    <tr>
      <td><?php echo $type ?></td>
      <td><?php echo round($number / $total * 100, 0) . '%' ?></td>
    </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>