<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <th>Pregunta</th>
        <th>Respuesta</th>
        <th>Checklist</th>                
        <th>Tienda</th>                
        <th>Prueba</th>    
        <th>Fecha</th>                                                                                             
        <tbody>
        @foreach ($reportes as $reporte)
            <tr>
                <td>{{$reporte->pregunta->Nombre}}</td>               
                <td>{{ ($reporte->respuesta == 1)? "Si":"No" }}</td>
                <td>{{$reporte->pregunta->checklist->Nombre}}</td>                  
                <td>{{$reporte->user->name}}</td>                  
                <td>{{($reporte->imagen != Null)?"Cargada": "Sin archivos"}}</td>
                <td>{{$reporte->fecha->format('y-m-d')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>