<nav class="Menu">
  <ul>
    <li><a href="<?php echo APP['home_url'] ?>portafolio">Portafolio</a></li>
    <li><a href="<?php echo APP['home_url'] ?>contacto">Contacto</a></li>
    <?php if ( isset($_SESSION['auth']) ) { ?>
      <li><a href="<?php echo APP['home_url'] ?>admin">Admin</a></li>
      <li><a href="<?php echo APP['home_url'] ?>logout">Logout</a></li>
      <li>Hola <?=$_SESSION['user_data']['user']?></li>
    <?php } else { ?>
      <li><a href="<?php echo APP['home_url'] ?>login">Login</a></li>
    <?php } ?>
  </ul>
</nav>
