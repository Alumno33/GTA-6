<?php
require_once 'includes/config.php';
include 'includes/datos.php';

// Recoger datos del formulario
$nombre = $_POST['nombre'] ?? '';
$dificultad = $_POST['dificultad'] ?? '';
$protagonista = $_POST['protagonista'] ?? '';
$comentario = trim($_POST['comentario'] ?? '');

// Validación básica
if (empty($nombre) || empty($dificultad) || empty($protagonista)) {
    header('Location: index.php?error=Todos los campos son obligatorios');
    exit;
}

if (mb_strlen($comentario) > 200) {
    header('Location: index.php?error=El comentario no puede superar los 200 caracteres');
    exit;
}

// Si todo es válido, redirigir a resultados con los parámetros por GET
$parametros = http_build_query([
    'nombre' => $nombre,
    'dificultad' => $dificultad,
    'protagonista' => $protagonista,
    'comentario' => $comentario
]);

header('Location: resultados.php?' . $parametros);
exit;