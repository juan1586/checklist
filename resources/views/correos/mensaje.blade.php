<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="page-header">
          <h2>Pendientes tienda <small>{{ $data['name']}}</small></h2>
        </div>
        <p>Auditor:<b>{{ $data['usuario']}}</b></p>
        <p>Comentarios: <b>{{ $data['mensaje']}}</b></p>
        <p>Preguntas no respondidas:</p>
        @foreach($respuestasNO as $respuesta)
        {{ $respuesta->Nombre }}
        @endforeach
    </div>
    <button class="btn btn-ifo"></button>
</body>
</html>