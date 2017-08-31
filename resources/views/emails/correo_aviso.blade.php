@extends('layouts.app')

@section('content')
<div class="container">
  <?php
    $aviso = $revisiones->prox_rev;
    $equipo = $revisiones->equipo;
    $name = $revisiones->name;
    $descripcion = $revisiones->descripcion;

    $mesg = "El próximo día <strong style='color:red;'>" . $aviso . "</strong> se revisará el artículo <u>" . $equipo . "</u> que se encuentra en <u>" . $name . "</u>. Observación: ".$descripcion;

    $headers = 'From: jesus@iniciativasmultimedia.com' . "\r\n" .
    'Reply-To: jesus@iniciativasmultimedia.com' . "\r\n" .
    'Content-Type: text/html; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    //( to, asunto, message, headers);
    mail("jesus@iniciativasmultimedia.com", "Revisión programada 2", $mesg, $headers);
  ?>
</div>
@endsection
