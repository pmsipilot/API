<?php

/*******************************************
 * DEFINITION DE L'API IDENTITE MOUVEMENTS *
 *******************************************/

$identitesMouvements = array(
  'name' => 'Identités Mouvements',
  'desc' => 'Connecteur Identiés/Mouvements et Actes.',
  'resources' => array()
);

$identitesMouvements_Identites = array(
  'name'   => 'identites',
  'method' => 'GET',
  'url'    => 'api/identites',
  'desc'   => <<<EOF
Retourne les identités.<br /><br />
Chaque identité contient ses propres informations ainsi que l'ensemble des séjours associés.<br />
Chaque séjour associé contient ses propres informations ainsi que l'ensemble des mouvements associés.<br />
D'autres API sont disponibles pour accéder directement aux <a href="sejours.html">séjours</a> ou aux <a href="mouvements.html">mouvements</a>.
EOF
  ,
  'secure'     => false,
  'exemple'    => 'api/identites',
  'parameters' => array(
    'caption' => 'Tous les paramètres sont optionnels.',
    'rows'    => array(
      array(
        'name'      => 'from',
        'mandatory' => false,
        'desc'      => <<<EOF
<p>Borne inférieur de récupération des données.</p>
<p><strong>format</strong>: <code>token</code> ou <code>{champ: valeur}</code></p>
<p><em>Les champs disponibles <code>DateNaissance</code>, <code>CreatedAt</code> et <code>UpdatedAt</code></em></p>
<p><strong>exemple de token </strong>: <code>1826</code></p>
<p><strong>exemple de champs </strong>: <code>{"DateNaissance":"2011-05-25"}</code></p>
EOF
      ),
      array(
        'name'        => 'until',
        'mandatory'   => false,
        'desc' => <<<EOF
<p>Borne supérieur de récupération des données.</p>
<p><strong>format</strong>: <code>token</code> ou <code>{champ: valeur}</code></p>
<p><em>Les champs disponibles <code>DateNaissance</code>, <code>CreatedAt</code> et <code>UpdatedAt</code></em></p>
<p><strong>exemple de token </strong>: <code>1826</code></p>
<p><strong>exemple de champs </strong>: <code>{"DateNaissance":"2011-05-25"}</code></p>
EOF
      ),
      array(
        'name'        => 'only',
        'mandatory'   => false,
        'desc' => <<<EOF
<p>Permet de sélectionner uniquement certains champs. Si ce paramètre n'est pas présent tous les champs sont retournés. Le caractère <code>*</code> peut être utilisé pour retourner tous les champs.</p>
<p><strong>exemple de valeur</strong>: 2011-05-25</p>
<p>Liste des champs disponibles pour l'identité :
  <ul>
    <li><code>*</code></li>
    <li><code>LastMessageId</code></li>
    <li><code>LastMessageId</code></li>
    <li><code>Ipp</code></li>
    <li><code>NomUsage</code></li>
    <li><code>NomNaissance</code></li>
    <li><code>NomNaissanceMere</code></li>
    <li><code>Sexe</code></li>
    <li><code>RangGemellaire</code></li>
    <li><code>DateNaissance</code></li>
    <li><code>NbSemaineGestation</code></li>
    <li><code>Adresse1</code></li>
    <li><code>Adresse2</code></li>
    <li><code>Commune</code></li>
    <li><code>CodePostal</code></li>
    <li><code>Cedex</code></li>
    <li><code>Pays</code></li>
    <li><code>TelephoneDomicile</code></li>
    <li><code>TelephonePortable</code></li>
    <li><code>TelephonePro</code></li>
  </ul>
</p>
<p>Liste des champs disponibles pour le séjour :
  <ul>
    <li><code>*</code></li>
    <li><code>IdentiteId</code></li>
    <li><code>LastMessageId</code></li>
    <li><code>TypeAdmission</code></li>
    <li><code>CirconstanceSortie</code></li>
    <li><code>ModeTransportEntree</code></li>
    <li><code>ModeTransportSortie</code></li>
    <li><code>ModeTraitement</code></li>
    <li><code>ModeEntree</code></li>
    <li><code>ModeSortie</code></li>
    <li><code>Provenance</code></li>
    <li><code>Destination</code></li>
    <li><code>Iep</code></li>
    <li><code>NumeroPreadmission</code></li>
    <li><code>DatePreadmission</code></li>
    <li><code>Vip</code></li>
    <li><code>EtablissementDestination</code></li>
    <li><code>EtablissementProvenance</code></li>
    <li><code>DateAdmission</code></li>
    <li><code>DateHospitalisationAnterieure</code></li>
    <li><code>DateSortie</code></li>
  </ul>
</p>
<p>Liste des champs disponibles pour le mouvement :
  <ul>
    <li><code>*</code></li>
    <li><code>LastMessageId</code></li>
    <li><code>SejourId</code></li>
    <li><code>Numero</code></li>
    <li><code>NatureMouvement</code></li>
    <li><code>DateMouvement</code></li>
    <li><code>Chambre</code></li>
    <li><code>Lit</code></li>
    <li><code>UfHebergement</code></li>
    <li><code>UfSoins</code></li>
    <li><code>UfResponsabiliteMedicale</code></li>
    <li><code>Dmt</code></li>
    <li><code>ModeEntree</code></li>
    <li><code>ModeSortie</code></li>
    <li><code>Provenance</code></li>
    <li><code>Destination</code></li>
  </ul>
</p>
EOF
      )
    )
  ),
  'returns' => array(
    'caption' => '',
    'rows'    => array(
      array(
        'name'        => 'token',
        'desc' => <<<EOF
Entier auto incrémenté permettant au client de conserver l'index du dernier appel.<br/>
Le client peut ainsi récupérer les informations de manière incrémentale en passant cette valeur lors du prochain appel à l'API.
EOF
      ),
      array(
        'name'        => 'api',
        'desc' => <<<EOF
Contient l'ensemble des données demandées.
EOF
      )
    )
  ),
  'query' => array(
    'url'    => 'api/identites?from=2011-05-25&only={"identite":["*"],"sejour":["Iep"]}',
    'value'  => <<<EOF
{
  token: 2,
  datas: [{
    fields: {
      LastMessageId: 2,
      Ipp: "1106000987",
      NomUsage: null,
      NomNaissance: "TEST",
      Pseudonyme: null,
      Prenom: "CLIMCO",
      NomNaissanceMere: null,
      Sexe: "M",
      RangGemellaire: null,
      DateNaissance: "1970-01-01 00:00:00",
      NbSemaineGestation: null,
      Adresse1: "BP 525",
      Adresse2: null,
      Commune: "AMBILLY",
      CodePostal: "74100",
      Cedex: null,
      Pays: "100",
      TelephoneDomicile: null,
      TelephonePro: null,
      TelephonePortable: null,
      CreatedAt: "2011-12-13 15:37:10",
      UpdatedAt: "2011-12-13 15:37:10"
    },
    sejours: [{
      fields: {
        Iep: "111060963"
      }
    }]
  }]
}
EOF
  )
);

// ajout des ressources à l'api
$identitesMouvements['resources'] = array(
  $identitesMouvements_Identites
);

// Retourne la structure à générer
return array(
  $identitesMouvements
);