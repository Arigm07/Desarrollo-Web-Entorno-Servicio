<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>

</head>

<body>
    <form action="{{route('registrar')}}" method="post">
        @csrf
        Nombre
            <input type="text" name="nombre"/><br/>
        Email
            <input type="email" name="email"/><br/>
        Contraseña
            <input type="password" name="ps"/><br/>
        Confirmar contraseña
            <input type="password" name="ps"/><br/>

        <button type="submit" name="crearUsuario">Crear</button>
        <a href="{{route('vistaRegistro')}}">Volver</a>
    </form>
</body>

</html>