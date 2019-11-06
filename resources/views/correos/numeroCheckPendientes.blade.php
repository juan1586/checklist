<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <title>Checklist Pendientes</title>
</head>
<body>
    <div class="container">
        <div class="page-header">
          <h2>Checklist pendientes</h2>
          <p>Estos son los checklist que tienes pendientes</p>
        </div>
        
        @foreach($checks as $check)
        <p>
         <h4>{{ $check->Nombre }}</h4>
        <p>
        @endforeach
    </div>
</body>
</html>