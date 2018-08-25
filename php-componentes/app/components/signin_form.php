<form method="post" id="SigninForm">
  <input type="text" name="user" placeholder="usuario" value="<?=( isset( $_SESSION['sign_user'] ) ) ? $_SESSION['sign_user'] : null?>">
  <input type="text" name="username" placeholder="nombre" value="<?=( isset( $_SESSION['sign_username'] ) ) ? $_SESSION['sign_username'] : null?>">
  <input type="email" name="email" placeholder="email" value="<?=( isset( $_SESSION['sign_email'] ) ) ? $_SESSION['sign_email'] : null?>">
  <input type="password" name="password" placeholder="password" value="<?=( isset( $_SESSION['sign_password'] ) ) ? $_SESSION['sign_password'] : null?>">
  <input type="submit">
  <input type="hidden" name="send_signin">
</form>
<?php
  if ( isset( $_GET['op'] ) && ($_GET['op'] === 'error-signin' || $_GET['op'] === 'ok-signin') ) {
    echo '<br><br>';
    echo $_SESSION['messages'];
  }

  if ( isset( $_POST['send_signin'] ) ) {
    signin();
  }
?>
