<?php
/*
  Documentación PDO
  http://php.net/manual/es/book.pdo.php
  http://php.net/manual/es/intro.pdo.php
  http://php.net/manual/es/pdo.connections.php
  http://php.net/manual/es/class.pdostatement.php
  http://php.net/manual/es/pdo.prepared-statements.php
*/

function db_connect () {
  $dsn = 'mysql:host=localhost;dbname=edcamp_lima';
  $user = 'root';
  $pass = '';
  $options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

  try {
    $db = new PDO( $dsn, $user, $pass, $options );
    //echo '<p>¡¡¡Conectado!!!</p>';
    return $db;
  } catch ( PDOException $e ) {
      echo '<p>¡Error!: <mark>' . $e->getMessage() . '</mark></p>';
      die();
  }
}

function db_query ( $sql, $data = array(), $is_search = false, $search_one = false ) {
  $db = db_connect();

  $mysql = $db->prepare( $sql );

  $mysql->execute( $data );

  if ( $is_search ) {
    if ( $search_one ) {
      $result = $mysql->fetch();
    } else {
      $result = $mysql->fetchAll();
    }
    $db = null;
    return $result;
  } else {
    $db = null;
    return true;
  }
}
