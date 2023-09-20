<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "pokedex")
or die ("Fallo");

$consulta = mysqli_query($conexion, "select * from usuario") or die("Fallo");

$usuario = isset( $_POST["usuario"])?$_POST["usuario"] : "";
$password = isset( $_POST["password"])?$_POST["password"] : "";

if ( validarUsuario($usuario, $password) == TRUE){
    $_SESSION["usuario"] = $usuario;
    header("location:home.php");
    exit();
} else {
    header("location:index.php");
    exit();
}

function validarUsuario($usuario, $password){
    return $usuario == "lucas" && $password == "1234";
}
