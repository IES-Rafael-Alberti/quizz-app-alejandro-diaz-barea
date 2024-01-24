<?php
// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define las respuestas correctas para cada pregunta
    $respuestasCorrectas = [
        'q1' => 'b',
        'q2' => 'c',
        'q3' => 'b',
        'q4' => 'a',
        'q5' => 'd',
        'q6' => 'c',
        'q7' => 'b',
        'q8' => 'b',
        'q9' => 'a',
        'q10' => 'a',
    ];

    // Inicializa la puntuación del usuario
    $puntuacion = 0;

    // Itera a través de las respuestas del formulario y compara con las respuestas correctas
    foreach ($_POST as $pregunta => $respuestaUsuario) {
        if (isset($respuestasCorrectas[$pregunta]) && $respuestaUsuario == $respuestasCorrectas[$pregunta]) {
            // Incrementa la puntuación si la respuesta es correcta
            $puntuacion++;
        }
    }

    // Muestra la puntuación y comentarios al usuario
    echo "<h2>Resultados del Cuestionario</h2>";
    echo "<p>Tu puntuación es: $puntuacion / 10</p>";

    // Puedes agregar comentarios específicos según la puntuación si lo deseas
    if ($puntuacion >= 8) {
        echo "<p>¡Excelente trabajo! Has demostrado un sólido conocimiento de PHP.</p>";
    } else {
        echo "<p>Parece que hay áreas en las que podrías mejorar. ¡Sigue practicando!</p>";
    }

    // Agrega un enlace para repetir el cuestionario
    echo "<p><a href='quiz.php?retake=true'>Repetir el Cuestionario</a></p>";
} else {
    // Si el formulario no ha sido enviado, redirige a la página del cuestionario
    header("Location: quiz.php");
    exit();
}
?>
