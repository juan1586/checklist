<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <p>Estos fueron los pendientes de la tienda <b>{{ $data['name']}}</b></p>
    <p>Auditor:<b>{{ $data['usuario']}}</b></p>
    <p>Comentarios: <b>{{ $data['mensaje']}}</b></p>
    <p>Preguntas no respondidas:</p>
    @foreach($respuestasNO as $respuesta)
     {{ $respuesta->Nombre }}
    @endforeach
</body>
</html>