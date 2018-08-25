<?php require_once './app/helpers/routes.php'; ?>
<!DOCTYPE html>
<html lang="<?=APP['language']?>">
<head>
  <?php require_once './app/helpers/meta_tags.php'; ?>
</head>
<body>
  <?php require_once './app/components/header.php'; ?>
  <main class="Main">
    <?php
      require_once $page;
      echo '<br><br>';
      echo '<p>Ruta: <b>' . $route . '</b></p>';
      echo '<br><br>';
      echo '<h3>Variables por GET</h3>';
      echo '<pre>';
        var_dump($_GET);
      echo '</pre>';
      echo '<br><br>';
      echo '<h3>Variables por POST</h3>';
      echo '<pre>';
        var_dump($_POST);
      echo '</pre>';
      echo '<br><br>';
      echo '<h3>Variables de Sesión</h3>';
      echo '<pre>';
        var_dump($_SESSION);
      echo '</pre>';
    ?>
  </main>
  <?php require_once './app/components/footer.php'; ?>
</body>
</html>
