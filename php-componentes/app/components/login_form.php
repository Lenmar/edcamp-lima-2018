<form method="post" id="LoginForm">
  <input type="text" name="user" placeholder="usuario" required>
  <input type="password" name="password" placeholder="password" required>
  <input type="submit">
  <input type="hidden" name="send_login">
</form>
<?php
  if ( isset( $_GET['op'] ) && $_GET['op'] === 'error-login' ) {
    echo '
      <br><br>
      <p>
        <mark>Tu usuario y/o password son incorrectos.</mark>
      </p>
    ';
  }

  if ( isset( $_POST['send_login'] ) ) {
    login();
  }
?>
