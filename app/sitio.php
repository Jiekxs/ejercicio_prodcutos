<?php
session_start();
$user = $_SESSION['user'] ?? null;
if (is_null($user)) {
    header("Location:index.php");
    exit();
}
require "vendor/autoload.php";
use utilidades\DB;
use Dotenv\Dotenv;
$env =  Dotenv::createImmutable("./../");
$env->safeLoad();


$db = new DB();

$familias = $db->obtener_familias();


$familiaSeleccionada = "";

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se hizo clic en el botón "submit"
    if (isset($_POST["submit"])) {
        // Obtiene el valor seleccionado en el dropdown
        $familiaSeleccionada = $_POST["familia"];
        echo "Familia seleccionada: " . $familiaSeleccionada . "<br>";
    }
}

$productos = $db->obtener_productos_por_familia($familiaSeleccionada);

if (!empty($productos)) {
    echo "<h2>Productos de la familia seleccionada:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Código</th><th>Nombre</th><th>PVP</th></tr>";

    foreach ($productos as $producto) {
        echo "<tr>";
        echo "<td>" . $producto['cod'] . "</td>";
        echo "<td>" . $producto['nombre_corto'] . "</td>";
        echo "<td>" . $producto['PVP'] . "</td>";
        echo "<td>" ."  <form action='prodcuto.php' method='post'>
                        <input type='submit' value='Modificar' name='submit'>
                        </form>" ."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay productos disponibles para la familia seleccionada.</p>";
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Bienvenido <?=$user?></h1>


<form action="" method="post">
    <select name="familia" id="">
        <?php
        foreach ($familias as $familia) {
            $cod = $familia[0];
            $nombre = $familia[0];
            $selected = ($familiaSeleccionada == $cod) ? "selected" : "";

            echo "<option value='$cod' $selected>$nombre</option>";
        }
        ?>
    </select>
    <input type="submit" value="Ver Productos" name="submit">

</form>

</body>
</html>