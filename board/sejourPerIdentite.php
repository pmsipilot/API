<?php

### ACTION ###

// inclusions de la librairie permettant une connexion curl
require_once dirname(__FILE__).'/../lib/RestConnection.php';

$requestHeader = array('Accept: application/json', 'Content-Type: application/json');

$api = new RESTConnection('http://localhost/referentiels/app.php/api', $requestHeader, 'recueil', 'recueil69');

$api->request('/identites');

$identites = array();
$total = 0;

foreach (json_decode($api->getResponseBody(), true) as $identite)
{
  if (isset($identite['ipp']))
  {
    $ipp = $identite['ipp'];
    $api->request(sprintf('/identites/%s/sejours', $ipp));
    $identites[$ipp] = sizeof(json_decode($api->getResponseBody(), true));
  }
}

ksort($identites);

### TEMPLATE ###

?>

<div class="board triple">
  <table class="highchart" data-graph-container-before="1" data-graph-type="column"><thead>
  <caption>Séjours par identité</caption>
    <thead>
    <tr>
      <th>Ipp</th>
      <th>Nombre</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($identites as $ipp => $number): ?>
    <tr>
      <td><?php echo $ipp ?></td>
      <td><?php echo $number ?></td>
    </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>