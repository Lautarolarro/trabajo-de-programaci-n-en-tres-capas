<?php

require_once __DIR__ . '/../../negocio/Ticket.php';
require_once __DIR__ . '/../../datos/TicketRepository.php';

$mensaje = null;
$error   = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo      = $_POST['titulo']      ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    
    if (empty(trim($titulo)) || empty(trim($descripcion))) {
        $error = 'El título y la descripción son obligatorios.';
    } else {
        try {
        
            $ticket = new Ticket($titulo, $descripcion);

            $repo = new TicketRepository();
            $id   = $repo->guardar($ticket);

            $mensaje = "Ticket creado correctamente con ID: {$id}. Estado: pendiente.";
        } catch (Exception $e) {
            $error = 'Error al guardar el ticket: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Ticket</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 600px; margin: 2rem auto; padding: 0 1rem; }
        label { display: block; margin-top: 1rem; font-weight: 600; }
        input, textarea { width: 100%; padding: 0.5rem; margin-top: 0.25rem; box-sizing: border-box; }
        button { margin-top: 1.5rem; padding: 0.6rem 1.2rem; cursor: pointer; }
        .mensaje { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .exito { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>Alta de Ticket</h1>

    <?php if ($mensaje): ?>
        <div class="mensaje exito"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="mensaje error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required
               value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="5" required><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>

        <button type="submit">Crear Ticket</button>
    </form>
</body>
</html>
