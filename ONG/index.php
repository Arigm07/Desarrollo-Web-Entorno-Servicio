<?php

use function Laravel\Prompts\alert;

session_start();
require_once 'Centro.php';
require_once 'Beneficiario.php';
require_once 'ServicioUsuario.php';

$mensaje = "";


// Selección de centro
if (isset($_POST['seleccionar_centro'])) {
    
    if (isset($_POST['id_centro']) && is_numeric($_POST['id_centro'])) {
        $query = $this->conexion->prepare("SELECT * FROM centros WHERE id = ?");
        var_dump($centroSeleccionado);  

        if ($centroSeleccionado) {
            $_SESSION['centro'] = $centroSeleccionado;
        } else {
            $mensaje = "El centro seleccionado no existe.";
        }
    } else {
        $mensaje = "ID de centro no válido.";
    }
}

// Cambiar de centro
if (isset($_POST['cambiar_centro'])) {
    unset($_SESSION['centro']);
}

// Agregar beneficiario
if (isset($_POST['agregar_beneficiario'])) {
    try {
        // Verificar
        if (!isset($_SESSION['centro']['id'])) {
            $error="No se ha seleccionado un centro.";
        }

        // Verifica que los datosno estén vacíos
        if (empty($_POST['nombre']) || empty($_POST['direccion'])) {
             $error="El nombre y la dirección del beneficiario son obligatorios.";
        }

        $query = $this->conexion->prepare("INSERT INTO beneficiarios (nombre, direccion, id_centro) VALUES (?, ?, ?)");
        $mensaje = "Beneficiario agregado correctamente.";
    } catch (Exception $e) {
        $mensaje = "Error al agregar beneficiario: " . $e->getMessage();
    }
}

// Ver servicios prestados
if (isset($_POST['ver_servicios'])) {
    if (isset($_POST['id_beneficiario'])) {
        $serviciosPrestados = ServicioUsuario::obtenerServiciosPorBeneficiario($_POST['id_beneficiario']);
    } else {
        $mensaje = "Debe seleccionar un beneficiario para ver los servicios.";
    }
}

// Borrar beneficiario
if (isset($_POST['borrar_beneficiario'])) {
    try {
        // Verifica si  es válido
        if (isset($_POST['id_beneficiario']) && is_numeric($_POST['id_beneficiario'])) {
            $query = $this->conexion->prepare("DELETE FROM beneficiarios WHERE id = ?");
            $mensaje = "Beneficiario eliminado correctamente.";
        } else {
             $error="ID de beneficiario no válido.";
        }
    } catch (Exception $e) {
        $mensaje = "Error al eliminar beneficiario: " . $e->getMessage();
    }
}

$query = $this->conexion->prepare("SELECT * FROM centros");
$beneficiarios = isset($_SESSION['centro']) ? $query = $this->conexion->prepare("SELECT * FROM beneficiarios WHERE id_centro = ?") : [];
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión ONG</title>
</head>
<body>
    <h1>Gestión de Centros y Beneficiarios</h1>

    <?php if ($mensaje): ?>
        <p><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['centro'])): ?>
        <h2>Seleccionar Centro</h2>
        <form method="POST">
            <select name="id_centro">
                <?php foreach ($centros as $centro): ?>
                    <option value="<?= htmlspecialchars($centro['id']) ?>"><?= htmlspecialchars($centro['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="seleccionar_centro">Seleccionar</button>
        </form>
    <?php else: ?>
        <h2>Información del Centro</h2>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION['centro']['nombre']) ?></p>
        <p><strong>Dirección:</strong> <?= htmlspecialchars($_SESSION['centro']['direccion']) ?></p>
        <p><strong>Localidad:</strong> <?= htmlspecialchars($_SESSION['centro']['localidad']) ?></p>

        <form method="POST">
            <button type="submit" name="cambiar_centro">Cambiar Centro</button>
        </form>

        <h2>Beneficiarios</h2>
        <ul>
            <?php foreach ($beneficiarios as $beneficiario): ?>
                <li>
                    <?= htmlspecialchars($beneficiario['nombre']) ?> (<?= htmlspecialchars($beneficiario['direccion']) ?>)
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id_beneficiario" value="<?= htmlspecialchars($beneficiario['id']) ?>">
                        <button type="submit" name="ver_servicios">Ver Servicios Prestados</button>
                        <button type="submit" name="borrar_beneficiario">Borrar Beneficiario</button>
                    </form>
                    <?php if (isset($serviciosPrestados) && $serviciosPrestados): ?>
                        <ul>
                            <?php foreach ($serviciosPrestados as $servicio): ?>
                                <li>
                                    <?= htmlspecialchars($servicio['descripcion']) ?> - <?= htmlspecialchars($servicio['fecha']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <h3>Agregar Beneficiario</h3>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre del beneficiario" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <button type="submit" name="agregar_beneficiario">Agregar</button>
        </form>

    <?php endif; ?>
</body>
</html>
