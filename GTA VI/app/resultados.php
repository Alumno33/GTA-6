<?php
require_once 'includes/config.php';
include 'includes/datos.php';
include 'includes/funciones.php';
include 'includes/header.php';

// Recoger datos de la URL (GET)
$nombre = $_GET['nombre'] ?? 'Agente anónimo';
$dificultad = $_GET['dificultad'] ?? 'Fácil';
$protagonista = $_GET['protagonista'] ?? '';
$comentario = trim($_GET['comentario'] ?? '');
// Filtrar misiones según la dificultad seleccionada
$misionesFiltradas = filtrarPorDificultad($misiones, $dificultad);
usort($misionesFiltradas, function (array $a, array $b): int {
    return $b['recompensa'] <=> $a['recompensa'];
});
// Calcular recompensa total
$totalRecompensa = calcularRecompensaTotal($misionesFiltradas);
$misionTop = obtenerMisionMasCara($misionesFiltradas);
?>

<h2>📋 Resultados de la operación</h2>

<p><?php echo saludarAgente($nombre); ?></p>
<p><strong>Dificultad seleccionada:</strong> <?php echo htmlspecialchars($dificultad); ?></p>
<p><strong>Protagonista asignado:</strong> <?php echo htmlspecialchars($personajes[$protagonista] ?? $protagonista); ?></p>

<?php if ($comentario !== ''): ?>
    <p><strong>Comentario:</strong> <?php echo nl2br(htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8')); ?></p>
<?php endif; ?>

<?php if ($misionTop !== null): ?>
    <p><strong>🏆 Misión más lucrativa:</strong> 
        <?php echo htmlspecialchars($misionTop['nombre']); ?> 
        (GTA$ <?php echo number_format($misionTop['recompensa'], 0, ',', '.'); ?>)
    </p>
<?php endif; ?>

<hr>

<h3>🎯 Misiones asignadas (<?php echo count($misionesFiltradas); ?>)</h3>

<?php if (count($misionesFiltradas) > 0): ?>
    <?php foreach ($misionesFiltradas as $mision): ?>
        
        
        <div class="card">
            <h4><?php echo htmlspecialchars($mision['nombre']); ?></h4>
            <p><?php echo htmlspecialchars($mision['descripcion']); ?></p>
             <p>Dificultad: <?= generarEstrellas($mision['dificultad']) ?></p>
            <p>
                <span class="badge"><?php echo htmlspecialchars($mision['dificultad']); ?></span>
                <strong>Recompensa:</strong> <?php echo MONEDA . ' ' . number_format($mision['recompensa'], 0, ',', '.'); ?>
            </p>
            <p><strong>Protagonista original:</strong> <?php echo htmlspecialchars($mision['protagonista']); ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="card">
        <p>No hay misiones disponibles con esa dificultad. ¡Prueba con otra!</p>
    </div>
<?php endif; ?>

<hr>

<h3>💰 Resumen económico</h3>
<div class="card">
    <p><strong>Recompensa total:</strong> <?php echo MONEDA . ' ' . number_format($totalRecompensa, 0, ',', '.'); ?></p>
    <p><strong>Número de misiones:</strong> <?php echo count($misionesFiltradas); ?></p>
</div>

<p><a href="index.php">← Volver a asignar otra misión</a></p>

<?php include 'includes/footer.php'; ?>