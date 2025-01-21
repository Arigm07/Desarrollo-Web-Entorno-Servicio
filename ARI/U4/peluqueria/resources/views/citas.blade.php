<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('crearC') }}" method="post">
        @csrf

        <input type="date" name="fecha" value="{{ echo date('Y-m-d') }}">
            @error('fecha')
                <p style="color: red;">Rellena fecha</p>
            @enderror

        <input type="time" name="hora" value="{{ echo date('H:i') }}">
            @error('hora')
                <p style="color: red;">Rellena hora</p>
            @enderror

        <input type="date" name="cliente" placeholder="CLiente">
            @error('cliente')
                <p style="color: red;">Rellena cliente</p>
            @enderror

        <button type="submit" name="crearC">Crear Cita</button>
    </form>

    @if (session('mensaje'))
        <p style="color: red;">{{session('mensaje')}}</p>
    @endif

    <table>
        <tr>
            <td>Id</td>
            <td>Fecha</td>
            <td>Hora</td>
            <td>Cliente</td>
            <td>Precio</td>
            <td>Acciones</td>
        </tr>

        @foreach ($citas as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->fecha }}</td>
            <td>{{ $c->hora }}</td>
            <td>{{ $c->cliente }}</td>
            <td>{{ $c->total }}</td>
            <td>
                <form action="{{route('cargarDetalle',[$c->id])}}" method="get">
                    @csrf
                    <button type="submit" name="detalleC">Detalle</button>
                </form>

                <form action="{{route('borrarC',[$c->id])}}" method="post">
                    @method('DELETE')
                    <button type="submit" name="borrarC">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</body>
</html>