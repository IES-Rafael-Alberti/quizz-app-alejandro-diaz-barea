<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Quiz</title>
	<link rel="stylesheet" href="quiz.css">
</head>
<body>
<?php
	session_start();

	if (isset($_SESSION['usuario_nombre'])) {
		echo "<h2>Bienvenido, " . $_SESSION['usuario_nombre'] . "!</h2>";
		echo "<a href='?cerrar=true' class='cerrar-sesion'>Cerrar sesión</a>";
	}

	if (isset($_GET["cerrar"])) {
		$_SESSION = array();
		session_destroy();
		header("Location: index.php");
		exit;
	}
?>

<form method="post">
	<h2>Registro de Usuario</h2>

	<label>Nombre de Usuario:</label>
	<input name="nombre_usuario">

	<label>Correo Electrónico:</label>
	<input name="correo">

	<label>Contraseña:</label>
	<input name="contrasena">

	<input type="submit" name="registrar" value="Registrar" />
</form>

<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		if (isset($_POST["registrar"])) {
			if (empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['nombre_usuario'])) {
				echo "Debes completar todos los datos.";
			} else {
				$servidor = "db";
				$usuarioDB = "root";
				$contrasenaDB = "pestillo123";
				$base_datos = "Quiz";

				$connRegistrar = new mysqli($servidor, $usuarioDB, $contrasenaDB, $base_datos);

				if ($connRegistrar->connect_error) {
					die("Error de conexión: " . $connRegistrar->connect_error);
				}

				$nombre_usuario = $_POST['nombre_usuario'];
				$correo = $_POST['correo'];
				$contrasena = $_POST['contrasena'];

				$consultaRegistrar = "INSERT INTO Usuario (nombre_usuario, contrasena, correo) VALUES ('$nombre_usuario', '$contrasena', '$correo')";

				$stmtRegistrar = $connRegistrar->prepare($consultaRegistrar);
				$stmtRegistrar->bind_param("sss", $nombre_usuario, $contrasena, $correo);

				if ($stmtRegistrar->execute()) {
					echo "<h2>Usuario registrado correctamente</h2>";
				} else {
					echo "Error al registrar usuario: " . $stmtRegistrar->error;
				}
			}
		}
	}
?>

</body>
</html>