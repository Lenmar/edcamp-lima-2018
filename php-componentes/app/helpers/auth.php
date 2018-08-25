<?php
session_start();

function login () {
  $sql = 'SELECT * FROM users WHERE user = ?';
  $data = array( $_POST['user'] );
  $user_exist = db_query($sql, $data, true, true);
  $is_error = false;

  if ( $user_exist['user'] ) {
    $password_ok = password_verify($_POST['password'], $user_exist['password']);
    if (!$password_ok) {
      $is_error = true;
    }
  } else {
    $is_error = true;
  }

  if ( !$is_error ) {
    $_SESSION['auth'] = true;
    $_SESSION['user_data'] = $user_exist;
    unset($_SESSION['login_user']);
    unset($_SESSION['login_password']);
    header( 'Location: ' . APP['home_url'] . 'admin' );
  } else {
    $_SESSION['login_user'] = $_POST['user'];
    $_SESSION['login_password'] = $_POST['password'];
    header( 'Location: ' . APP['home_url'] . 'login/error-login' );
  }
}

function logout () {
  session_destroy();
  unset($_SESSION);
  header('Location: '. APP['home_url'] . 'login');
}

function is_auth () {
  if ( !$_SESSION['auth'] ) {
    logout();
  }
}

function signin () {
  $is_error = false;
  $errors = '<p>Revisa los siguientes campos:</p><ul>';

  if  ( !isset( $_POST['user'] ) || strlen( $_POST['user'] ) === 0 ) {
    $errors .= '<li>El campo usuario está vacío.</li>' ;
    $is_error = true;
  }

  if  ( strlen( $_POST['user'] ) < 6 ) {
    $errors .= '<li>El campo usuario al menos debe tener 6 caracteres.</li>' ;
    $is_error = true;
  }

  if  ( !isset( $_POST['username'] ) || strlen( $_POST['username'] ) === 0 ) {
    $errors .= '<li>El campo nombre está vacío.</li>' ;
    $is_error = true;
  }

  if  ( !isset( $_POST['email'] ) || strlen( $_POST['email'] ) === 0 ) {
    $errors .= '<li>El campo email está vacío.</li>' ;
    $is_error = true;
  }

  /*
    http://php.net/manual/es/function.filter-var.php
    http://php.net/manual/es/filter.filters.php
    http://php.net/manual/es/filter.filters.validate.php
  */
  if  ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
    $errors .= '<li>El campo email no es válido.</li>' ;
    $is_error = true;
  }

  if  ( !isset( $_POST['password'] ) || strlen( $_POST['password'] ) === 0 ) {
    $errors .= '<li>El campo password está vacío.</li>' ;
    $is_error = true;
  }

  if  ( strlen( $_POST['password'] ) < 6 ) {
    $errors .= '<li>El campo password al menos debe tener 6 caracteres.</li>' ;
    $is_error = true;
  }

  $errors .= '</ul>';

  $_SESSION['messages'] = $errors;
  $_SESSION['sign_user'] = $_POST['user'];
  $_SESSION['sign_username'] = $_POST['username'];
  $_SESSION['sign_email'] = $_POST['email'];
  $_SESSION['sign_password'] = $_POST['password'];

  if ( $is_error ) {
    header( 'Location: ' . APP['home_url'] . 'login/error-signin' );
  } else {
    $sql = 'SELECT * FROM users WHERE user = ? OR email = ?';
    $data = array( $_POST['user'], $_POST['email'] );
    $user_exist = db_query($sql, $data, true);

    if ( count($user_exist) === 0 ) {
      unset($_SESSION['messages']);
      unset($_SESSION['sign_user']);
      unset($_SESSION['sign_username']);
      unset($_SESSION['sign_email']);
      unset($_SESSION['sign_password']);
      unset($_SESSION['login_user']);
      unset($_SESSION['login_password']);
      /*
        http://php.net/manual/es/book.password.php
        http://php.net/manual/es/faq.passwords.php
        http://php.net/manual/es/function.password-hash.php
        http://php.net/manual/es/function.password-verify.php
      */
      $sql = 'INSERT INTO users (user, user_date, username, email, password) VALUES (?, NOW(), ?, ?, ?)';
      $data = array(
        $_POST['user'],
        $_POST['username'],
        $_POST['email'],
        password_hash( $_POST['password'], PASSWORD_DEFAULT )
      );
      db_query($sql, $data);

      $_SESSION['messages'] = '<p>Usuario <b>' . $_POST['user'] . '</b> creado con éxito.</p>';
      header( 'Location: ' . APP['home_url'] . 'login/ok-signin' );
    } else {
      $_SESSION['messages'] = '<p>El usuario <b>' . $_POST['user'] . '</b> o el correo <b>' . $_POST['email'] . '</b> ya existen.</p>';
      header( 'Location: ' . APP['home_url'] . 'login/error-signin' );
    }
  }
}
