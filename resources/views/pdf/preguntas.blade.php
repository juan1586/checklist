<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <style>
        table {
            width: 100%;
            border: 1px solid #000;
        }
        th, td {
           
            text-align: left;
            vertical-align: top;
            border: 1px solid #000;
            border-collapse: collapse;
        }
    </style>
    <title>Preguntas</title>
</head>
<body>
    <center><p><h3>PREGUNTAS</h3></p></center>
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="30px">#</th>
                <th>Pregunta</th>
                <th>Descripcion</th>
                <th width="20px">Si</th>
                <th  width="20px">No</th>
        
            </tr>                            
        </thead>
        <tbody>
            @php($con = 1)
            @foreach($preguntasImprimir as $pregunta)
            <tr>
                <td>{{$con++}}</td>
                <td>{{ $pregunta->Nombre }}</td>
                <td>{{ $pregunta->descripcion }}</td>
                <td ></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html