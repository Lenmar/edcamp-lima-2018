<?php
require_once './app/store/config.php';
require_once './app/store/db.php';
require_once './app/helpers/auth.php';

$route = ( isset($_GET['p']) ) ? $_GET['p'] : 'home';

switch ($route) {
  case 'home':
    $page = './app/pages/home.php';
    $meta_title =  'Título del Home';
    $meta_description = 'Descripción del Home.';
    break;
  case 'portafolio':
    $page = './app/pages/portfolio.php';
    $meta_title =  'Título de la sección Portafolio';
    $meta_description = 'Descripción de la sección Portafolio.';
    break;
  case 'contacto':
    $page = './app/pages/contact.php';
    $meta_title =  'Título de la sección Contacto';
    $meta_description = 'Descripción de la sección Contacto.';
    break;
  case 'login':
    $page = './app/pages/login.php';
    $meta_title =  'Título de la sección Login';
    $meta_description = 'Descripción de la sección Login.';
    break;
  case 'admin':
    is_auth();
    $page = './app/pages/admin.php';
    $meta_title =  'Título de la sección Administración';
    $meta_description = 'Descripción de la sección Administración.';
    break;
  case 'logout':
    logout();
    break;
  default:
    $page = './app/pages/404.php';
    $meta_title =  'Error 404: Not Found';
    $meta_description = '¡UUPS! esta página no se encuentra disponible.';
    header('HTTP/1.0 404 Not Found');
    header('Status: 404 Not Found');
    break;
}
