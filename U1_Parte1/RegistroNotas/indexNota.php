<?php

require_once 'Modelo.php';
require_once 'Notas.php';

$modelo = new Modelo();

// Cargar asignaturas en un array
$asignaturas = $modelo->obtenerAsignaturas();
$notas = $modelo->obtenerNotas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $asignatura = $_POST['asignatura'];
    $descripcion = $_POST['descripcion'];
    $nota = $_POST['nota'];
    $tipo = $_POST['tipo'];

    // Crear una nueva instancia de Nota
    $notaObj = new Nota(
        $asignatura,
        $tipo,
        $descripcion,
        $nota,
        date('Y-m-d H:i:s') // Fecha actual
    );
    
    // Guardar la nota usando el modelo
    $modelo->crearNota($notaObj);
    
    // Redirigir o refrescar para evitar reenvío del formulario
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de notas</title>
</head>
<body>

    <h3>Gestión de notas y exámenes</h3>

    <form action="#" method="post">
        <label for="asignatura">Asignatura:</label>
        <select name="asignatura" id="asignatura" required>
            <?php foreach ($asignaturas as $asig): ?>
                <option value="<?php echo htmlspecialchars($asig); ?>">
                    <?php echo htmlspecialchars($asig); ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" required>
        <br>

        <label for="nota">Nota:</label>
        <input type="number" name="nota" id="nota" required min="0" max="10" step="0.01">
        <br>

        <label>Tipo:</label>
        <input type="radio" name="tipo" value="examen" required> Examen
        <input type="radio" name="tipo" value="tarea" required> Tarea
        <br>

        <button type="submit">Crear Nota</button>
    </form>

    <h3>Notas Registradas</h3>
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Asignatura</th>
            <th>Descripción</th>
            <th>Nota</th>
            <th>Tipo</th>
        </tr>

        <?php 
        // Mostrar notas registradas
        $notasRegistradas = $modelo->obtenerNotas();
        foreach ($notasRegistradas as $nota) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($nota->getFecha()) . '</td>';
            echo '<td>' . htmlspecialchars($nota->getAsignatura()) . '</td>';
            echo '<td>' . htmlspecialchars($nota->getDescripcion()) . '</td>';
            echo '<td>' . htmlspecialchars($nota->getNota()) . '</td>';
            echo '<td>' . htmlspecialchars($nota->getTipo()) . '</td>';
            echo '</tr>';
        } ?>
    </table>
    
</body>
</html>
