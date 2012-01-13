<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Referentiels board</title>
  <meta charset="utf-8">
  <link href="css/base.css" type="text/css" rel="stylesheet">
</head>
</html>
<body>
<div id="wrapper">
  <h1>Referentiels / <span>Exemple d'utilisation des api</span></h1>
  <?php require dirname(__FILE__).'/../board/sejourPerMonth.php'; ?>
  <?php require dirname(__FILE__).'/../board/sexe.php'; ?>
  <?php require dirname(__FILE__).'/../board/sejourPerIdentite.php'; ?>
</div>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script src="js/jquery.highchartTable.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('table.highchart').highchartTable();
  });
</script>
</body>
