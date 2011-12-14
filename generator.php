<?php

if(0 !== sizeof($_FILES)):

ini_set('display_errors', 1);

require_once 'lib/Genapi.class.php';

try
{
  $file = $_FILES['file']['tmp_name'];
  if(!is_file($file))
  {
    throw new Exception(sprintf('Le fichier `%s` ,\'existe pas.', $file));
  }

  $apis = require $file;

  $genapi = new Genapi($apis);
  $genapi->run();
}
catch(Exception $e)
{
  echo sprintf('%s - %s', date('d/m/Y H:i:s'), $e->getMessage());
}

else: ?>

<!DOCTYPE html>
<html>
<head>
  <title>Genapi - Generateur de template des APIs PMSIpilot</title>
</head>
<body>
  <div class="container">
    <div class="content">
      <h1>Genapi - Generateur de template des APIs PMSIpilot</h1>
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
        <input type="file" name="file">
        <input type="submit" value="Envoyer">
      </form>
    </div>
  </div>
</body>
</html>

<?php endif; ?>
