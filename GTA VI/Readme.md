## 1 Enlace
https://github.com/Alumno33/GTA-6

## 2 Resumen de la practica

En esta práctica se ha desarrollado una aplicación web utilizando PHP basada en el universo de GTA VI, llamada *Los Santos Online*.

Se han trabajado constantes y variables, arrays asociativos, funciones reutilizables y estructuras de repetición (`foreach` y `for`). También se ha creado un formulario mediante el método POST para registrar personajes y seleccionar misiones según su dificultad.

Por último, se han procesado los datos, aplicado validaciones y mostrado los resultados y las recompensas mediante diferentes páginas PHP, utilizando `include` y `require_once` para organizar el código.

## 3 Elementos no realizados

Hice todo

## 4 Problemas  Encontrados 

Un error del puerto 8080 al reiniciar la maquina lo he arreglado, haciendo un docker compose down y up.


## 5 Mejoras realizadas

1-/**
 * @param string $dificultad Nivel de dificultad ('Fácil', 'Media', 'Difícil').
 * @return string Cadena con los emojis de estrellas correspondientes.
 */
function generarEstrellas(string $dificultad): string {
    $cantidad = match ($dificultad) {
        'Media' => 2,
        'Difícil' => 3,
        default => 1,
    };

    return str_repeat('⭐', $cantidad);
}

hemos formado esta funcion se basa en cuando elijamos una dificultad se muestren las estrellas que hemos seleccionado y luego tenemos que ir a resultados.php donde queremos que se refleje y poner esto <p>Dificultad: <?= generarEstrellas($mision['dificultad']) ?></p>

2- Esta mejora era la mas simple solo habia que cambiar este apartado
$personajes = [
    'Michael' => 'Michael De Santa',
    'Franklin' => 'Franklin Clinton',
    'Trevor' => 'Trevor Philips',
    'Jason'  =>  'Jason Morales'
];


3- * @param array $misiones Array de misiones (cada una con clave 'recompensa').
 * @return array|null Array asociativo de la misión más cara, o null si está vacío.
 */
function obtenerMisionMasCara(array $misiones): ?array {
    if (empty($misiones)) {
        return null;
    }

    $misionMasCara = $misiones[0];

    foreach ($misiones as $mision) {
        if ($mision['recompensa'] > $misionMasCara['recompensa']) {
            $misionMasCara = $mision;
        }
    }

    return $misionMasCara;
}

?>
Hemos hecho esta función basada en elegir de las misiones, la más cara. Hemos usado un foreach para que recorra el array y cuando aparece una misión más cara que la anterior, la variable misionmascara pasa a ser la misión que está recorriendo en ese momento

4-<label for="comentario">Comentario:</label>
<textarea id="comentario" name="comentario" rows="3" placeholder="Escribe un comentario..." style="width: 100%; padding: 10px; margin-top: 6px; margin-bottom: 16px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit; font-size: 14px; box-sizing: border-box; resize: vertical;"></textarea>
    <br>
    <button type="submit">Asignar misión</button>
Hemos hecho un label en el index dentro del formulario, hemos añadido 3 columnas para aumentar el tamaño y hemos usado un css para que tenga el mismo tamaño que el cuadrado de los demás,   luego hemos puesto en resultado.php para que salga 

<?php if ($comentario !== ''): ?>
    <p><strong>Comentario:</strong> <?php echo nl2br(htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8')); ?></p>
<?php endif; ?>

5-$misionesFiltradas = filtrarPorDificultad($misiones, $dificultad);
usort($misionesFiltradas, function (array $a, array $b): int {
    return $b['recompensa'] <=> $a['recompensa'];
});

Aquí, hemos usado usort para ordenar de mayor a menor las misiones para que se vea así