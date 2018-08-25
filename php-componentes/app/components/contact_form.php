<form method="post">
  <input type="text" name="nombre" placeholder="nombre" required>
  <input type="email" name="email" placeholder="email" required>
  <input type="text" name="asunto" placeholder="asunto a tratar" required>
  <textarea name="comentarios" cols="50" rows="5" placeholder="escribe tus comentarios" required></textarea>
  <input type="submit">
  <input type="hidden" name="send_form" value="1">
</form>
<?php
  if ( isset($_POST['send_form'])  ) {
    $name = $_POST['nombre'];
    $email = $_POST['email'];
    $subject = $_POST['asunto'];
    $comments = $_POST['comentarios'];
    $domain = $_SERVER['HTTP_HOST'];

    $to = "$name < $email >";
    $subject = "Contacto desde el sitio $domain: $subject";
    $message = "
      <html>
        <head>
          <title>
            Datos enviados desde el formulario del sitio $domain
          </title>
        </head>
        <body>
          <p>
            Datos enviados desde el formulario del sitio <b>$domain</b>
          </p>
          <ul>
            <li>Nombre: <b>$name</b></li>
            <li>Email: <b>$email</b></li>
            <li>Asunto: <b>$subject</b></li>
            <li>Comentarios: <b>$comments</b></li>
          </ul>
        </body>
      </html>
    ";

    $headers = "MIME-Version: 1.0\r\n" . "Content-Type: text/html; charset=utf-8\r\n" . "From: Jonathan MirCha < hola@jonmircha.com >";

    $send_mail = mail($to, $subject, $message, $headers);

    if ( $send_mail ) {
      echo '<p>Tus datos han sido enviados.</p>';
    } else {
      echo '<p>Error al enviar tus datos. Intenta nuevamente</p>';
    }
  }
?>
