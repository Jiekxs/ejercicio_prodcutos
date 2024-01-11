<?php

require "vendor/autoload.php";
use utilidades\DB;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable("./../");
$dotenv->safeLoad(); //Con esto ya tienes acceso a todas las variables del .env

$opcion = $_POST['submit'];


$bd = new DB();

switch ($opcion){
    case "Acceder":
        $user = $_POST['user'];
        $password = $_POST['password'];

        if ($bd->validar_usuario($user, $password)){
            session_start();
            $_SESSION['user']=$user;
            header("Location:sitio.php");
            exit();
        }
        $msj = "Datos incorrectos";

        break;

    case "Registrarme":
        $user = $_POST['user'];
        $password = $_POST['password'];
        $rtdo = $bd->insertar_datos($user, $password);
        $msj = $rtdo? "Se ha insertado $user": "Error al insertar usuario";

        break;

    case "Familias":

        break;

    case "Desconectar":
        $msj = "Sesion cerrada";
        session_destroy();

        break;

    default:

}


?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Base de Datos</title>
</head>
<body>
<h1><?=$msj?></h1>
<fieldset>
    <legend>Datos de acceso</legend>
    <form action="" method="post">
        Usuario <input type="text" name="user" placeholder="Usuario"><br>
        Password <input type="text" name="password" placeholder="Passeword"><br>
        <input type="submit" value="Acceder" name="submit">
        <input type="submit" value="Registrarme" name="submit">
    </form>
</fieldset>
</body>
</html>