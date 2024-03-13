<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Reseteo de contraseña</title>
</head>
<body>
    <p>Hola!, hemos reseteado tu contraseña de tu cuenta en la plataforma de proyectos de investigación del CUCSH.</p>
    <p>Estos son los datos del usuario:</p>
    <ul>
        
        <li>Nombre: {{ $usuario->name }}</li>
        <li>Correo: {{ $usuario->email }}</li>
        <li>Contraseña nueva: {{ $contraseña }}</li>
    </ul>
</body>
</html>