@extends('layouts.app')

@section('content')
<div class="container">
  <?php
    foreach ($revisiones as $x) {
      $aviso = $x->prox_rev;
      $equipo = $x->equipo;
      $name = $x->name;
      $descripcion = $x->descripcion;
      $correo_destino = $x->correo;

      $mesg = "El próximo día <strong style='color:red;'>" . $aviso . "</strong> se revisará el artículo <u>" . $equipo . "</u> que se encuentra en <u>" . $name . "</u>. Observación: ".$descripcion;


      // cambiar los headers en función del correo saliente
      // ...@hospitalcruzrojacordoba.es
      $headers = 'From: jesus@iniciativasmultimedia.com' . "\r\n" .
      'Reply-To: jesus@iniciativasmultimedia.com' . "\r\n" .
      'Content-Type: text/html; charset=UTF-8' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      //( to, asunto, message, headers);
      mail($correo_destino, "Revisión programada", $mesg, $headers);
    }
  ?>
  <div class="alert alert-success">Todos los mails enviados. Puede volver pulsando <a href="{{ url('home') }}">aquí</a></div>
</div>
@endsection
