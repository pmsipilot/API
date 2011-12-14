<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mbrunot
 * Date: 14/12/11
 * Time: 10:27
 */


class Genapi
{
  const OUTPUT_DIR = '/../output';

  /**
   * Tableau la documentation des APIs
   * @var array
   */
  private $apis = array();

  /**
   * @param array $apis
   */
  public function __construct(array $apis)
  {
    $this->apis = $apis;
  }

  /**
   * Lance la génération des apis
   */
  public function run()
  {
    $downloadDir = realpath(dirname(__FILE__) . self::OUTPUT_DIR);
    if (!is_dir($downloadDir))
    {
      throw new Exception(sprintf('Le dossier `%s` n\'existe pas.', $downloadDir));
    }

    if (!is_writable($downloadDir))
    {
      throw new Exception(sprintf('Api-generator ne peut pas écrire dans le dossier `%s` (chmod 777 %s).', $downloadDir, $downloadDir));
    }

    $this->generate();
  }

  /**
   * @return void
   */
  private function generate()
  {
    $this->generateApis();
  }

  private function generateApis()
  {
    $template =  sprintf(<<<EOF
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>API publiques de la suite logicielle PMSIpilot</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/base.css">
</head>
<body>

  <div class="topbar">
    <div class="fill">
      <div class="container">
        <a class="brand" href="index.html">API PMSIpilot</a>
      </div>
    </div>
  </div>

  <div class="container">
    <div id="breadcrumbs">
      <div class="breadcrumb">
        <a href="index.html">API PMSIpilot</a>
      </div>
    </div><!-- end #breadcrumbs -->
    <div class="content">
      <h1 id="title">API PMSIpilot</h1>
      <div class="span16">
        %s
      </div>
    </div>
  </div> <!-- /container -->
</body>
</html>
EOF
      , $this->generateApi()
    );

    file_put_contents(realpath(dirname(__FILE__) . self::OUTPUT_DIR) . '/index.html', $template);
  }

  private function generateApi()
  {
    $output = '';
    foreach ($this->apis as $api)
    {
      $output .= sprintf(<<<EOF
        <table class="views-table">
          <caption>
            <strong>%s</strong>
            <p>%s</p>
          </caption>
          <thead>
            <tr>
              <th class="views-field-title">Resource</th>
              <th class="views-field-body">Description</th>
            </tr>
          </thead>
          <tbody>
            %s
          </tbody>
        </table>
EOF
        , $api['name']
        , $api['desc']
        , $this->generateApiResources($api['resources'])
      );
    }

    return $output;
  }

  private function generateApiResources($resources)
  {
    $output = '';
    foreach ($resources as $resource)
    {
      $output .= sprintf(<<<EOF
            <tr>
              <td class="views-field-title">
                <a href="%s.html">%s %s</a>
              </td>
              <td class="views-field-body">
                %s
              </td>
            </tr>
EOF
        , $resource['name']
        , $resource['method']
        , $resource['url']
        , substr($resource['desc'], 0, 300)
      );

      $this->generateResource($resource);
    }

    return $output;
  }

  /**
   * @param array $resource
   * @return void
   */
  private function generateResource(array $resource)
  {
    $template =  sprintf(<<<EOF
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>API publiques de la suite logicielle PMSIpilot</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/base.css">
</head>
<body>
  <div class="topbar">
    <div class="fill">
      <div class="container">
        <a class="brand" href="index.html">API PMSIpilot</a>
      </div>
    </div>
  </div>
  <div class="container">
    <div id="breadcrumbs">
      <div class="breadcrumb">
        <a href="index.html">API PMSIpilot</a> → <a href="#">%s</a>
      </div>
    </div><!-- end #breadcrumbs -->
    <div class="content row">
      <div class="span12">
        <h1 id="title">%s %s</h1>
        <p>%s</p>
        <h2>Exemple d'appel :</h2>
        <pre><strong>%s</strong> %s</pre>
        <table class="parameters-table">
          <caption>
            <strong>Paramètres :</strong><p>%s</p>
          </caption>
          <tbody>
            %s
          </tbody>
        </table>
        <table class="parameters-table">
          <caption>
            <strong>Retour :</strong><p>%s</p>
          </caption>
          <tbody>
            %s
          </tbody>
        </table>
        <h2>Exemple de requête :</h2>
        <pre><strong>%s</strong> %s</pre>
        <pre class="highlight">
%s</pre>
      </div>
      <div class="span5">
        <div class="block-api">
          <h2>Informations</h2>
          <table>
            <tbody>
               <tr><th>Requiert une authentification ?</th><td>%s</td> </tr>
               <tr><th>Méthode HTTP</th><td>%s</td> </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> <!-- /container -->
  <footer>

  </footer>
  <script type="text/javascript">window.hijs = '.highlight';</script>
  <script type="text/javascript" src="js/hijs.js"></script>
</body>
</html>
EOF
      , ucfirst($resource['name'])
      , $resource['method']
      , $resource['url']
      , $resource['desc']
      , $resource['method']
      , $resource['exemple']
      , $resource['parameters']['caption']
      , $this->generateResourceParameters($resource['parameters']['rows'])
      , $resource['returns']['caption']
      , $this->generateResourceReturns($resource['returns']['rows'])
      , $resource['method']
      , $resource['query']['url']
      , $resource['query']['value']
      , $resource['secure'] ? 'Oui' : 'Non'
      , $resource['method']
    );

    file_put_contents(realpath(dirname(__FILE__) . self::OUTPUT_DIR) . '/' . $resource['name'] . '.html', $template);
  }

  /**
   * @param array $rows
   * @return string
   */
  public function generateResourceParameters($rows)
  {
    $output = '';
    foreach($rows as $row)
    {
      $output .= sprintf(<<<EOF
            <tr>
              <td class="parameters-field-title">%s <span>%s</span></td>
              <td class="parameters-field-body">
                %s
              </td>
            </tr>
EOF
        , $row['name']
        , $row['mandatory'] ? 'requis' : 'optionnel'
        , $row['desc']
      );
    }

    return $output;

  }

  /**
   * @param array $rows
   * @return string
   */
  public function generateResourceReturns($rows)
  {
    $output = '';
    foreach($rows as $row)
    {
      $output .= sprintf(<<<EOF
            <tr>
              <td class="parameters-field-title">%s</td>
              <td class="parameters-field-body">
                %s
              </td>
            </tr>
EOF
        , $row['name']
        , $row['desc']
      );
    }

    return $output;

  }
}
