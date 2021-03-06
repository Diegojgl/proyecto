<?php

// Comprobando si los datos se envian por el metodo POST
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 	echo "Se enviaron por POST";
// }

$errores = '';
$enviado = '';

// Comprobamos que el formulario haya sido enviado.
if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
	$correo = $_POST['correo'];
	$mensaje = $_POST['mensaje'];

// Comprobamos que el nombre no este vacio.
	if (!empty($nombre)) {
		// Saneamos el nombre para eliminar caracteres que no deberian estar.
		$nombre = trim($nombre);
		$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
		// Comprobamos que el nombre despues de quitar los caracteres ilegales no este vacio.
		if ($nombre == "") {
			$errores.= 'Por favor ingresa un nombre.<br />';
		}
	} else {
		$errores.= 'Por favor ingresa un nombre.<br />';
	}

    if (!empty($cargo)) {
		// Saneamos el nombre para eliminar caracteres que no deberian estar.
		$cargo = trim($cargo);
		$cargo = filter_var($cargo, FILTER_SANITIZE_STRING);
		// Comprobamos que el nombre despues de quitar los caracteres ilegales no este vacio.
		if ($cargo == "") {
			$errores.= 'Por favor ingresa un cargo.<br />';
		}
	} else {
		$errores.= 'Por favor ingresa un cargo.<br />';
	}

	if (!empty($correo)) {
		$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
		// Comprobamos que sea un correo valido
		if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$errores.= "Por favor ingresa un correo valido.<br />";
		}
	} else {
		$errores.= 'Por favor ingresa un correo.<br />';
	}


	if (!empty($mensaje)) {
		// Podemos sanear la cadena de texto con filter_var, pero queremos que en el mensaje los signos se conviertan en entidades HTML
		$mensaje = htmlspecialchars($mensaje);
		$mensaje = trim($mensaje);
		$mensaje = stripslashes($mensaje);
	} else {
		$errores.= 'Por favor ingresa el mensaje.<br />';
	}

// Comprobamos si hay errores, si no hay entonces enviamos.
	if (!$errores) {
		$enviar_a = 'argider46@gmail.com';
		$asunto = 'Correo enviado desde solicitudes.com';
		$mensaje = "De: $nombre \n";
		$mensaje.= "Correo: $correo \n";
		$mensaje.= 'Mensaje: ' . $_POST['mensaje'];

		// mail($enviar_a, $asunto, $mensaje);
		$enviado = 'true';
	}
}

include_once '../views/realiza.view.php';

?>