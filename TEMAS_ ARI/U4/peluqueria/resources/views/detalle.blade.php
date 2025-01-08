<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(session('mensaje'))
        <p style="color: red;"></p>
    @endif
    
    <h3>Fecha:{{$cita->fecha}} Hora:{{$cita->hora}} Cliente:{{$cita->cliente}}</h3>
    <h3><a href="{{route('verCitas')}}">Volver</a></h3>

    <form action="{{route('crearD',$cita->id)}}" method="post">
        <h2>Seleccionar Servicio</h2>

        <select name="servicio" id="servicio">
            @foreach($servicios as $s)
                <option value="{{$s->id}}">{{ $s->descripcion }}</option>
            @endforeach
        </select>
    </form>

    <h3>Servicios Cita</h3>
    <form action="">
        <button type="submit">Finalizar Cita</button>
    </form>

    <table border="1" width="50%">
        <tr>
            <td>Id</td>
            <td>Descripción</td>
            <td>Importe</td>
        </tr>

        @foreach($cita-> obtenerDetalle() as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->servicio_id}}</td>
            <td>{{ $d->precio }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>