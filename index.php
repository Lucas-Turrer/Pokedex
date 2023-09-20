<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokedex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
<?php
session_start();
if( isset($_SESSION["usuario"]) ){
    header("location:home.php");
    exit();
}
?>

<?php
include 'header.php';
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white p-4 rounded">
        <div class="container">
            <form action="" method="POST" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="busqueda" placeholder="Ingrese nombre, tipo o numero de pokemon">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"> Quien es este pokemon? </button>
                    </div>
                </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["busqueda"])) {
                $busqueda = $_POST["busqueda"];

                $conexion = mysqli_connect("localhost", "root", "", "pokedex") or die("Fallo");

                $query = "SELECT * FROM pokemon WHERE nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%' OR identificador = '$busqueda'";
                $resultado = mysqli_query($conexion, $query) or die("Fallo en la consulta");

                if (mysqli_num_rows($resultado) > 0) {
                    echo '<table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Tipo</th>
                                    <th>Descripción</th>
                                    <th>Identificador</th>
                                </tr>
                            </thead>
                            <tbody>';

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<tr>
                                <td>' . $fila['nombre'] . '</td>
                                <td><img src="imagenes/' . $fila['imagen'] . '.gif" alt="Imagen" class="img-fluid"></td>
                                <td>' . $fila['tipo'] . '</td>
                                <td>' . $fila['descripcion'] . '</td>
                                <td>' . $fila['identificador'] . '</td>
                              </tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo "Pokémon no encontrado.<br>";

                    $query = "SELECT * FROM pokemon";
                    $resultado = mysqli_query($conexion, $query) or die("Fallo en la consulta");

                    if (mysqli_num_rows($resultado) > 0) {
                        echo '<table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Tipo</th>
                                        <th>Descripción</th>
                                        <th>Identificador</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<tr>
                                    <td>' . $fila['nombre'] . '</td>
                                    <td><img src="imagenes/' . $fila['imagen'] . '.gif" alt="Imagen" class="img-fluid"></td>
                                    <td>' . $fila['tipo'] . '</td>
                                    <td>' . $fila['descripcion'] . '</td>
                                    <td>' . $fila['identificador'] . '</td>
                                  </tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo "No se encontraron registros.";
                    }
                }

                mysqli_close($conexion);
            } else {
                $conexion = mysqli_connect("localhost", "root", "", "pokedex") or die("Fallo");
                $query = "SELECT * FROM pokemon";
                $resultado = mysqli_query($conexion, $query) or die("Fallo en la consulta");

                if (mysqli_num_rows($resultado) > 0) {
                    echo '<table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Tipo</th>
                                    <th>Descripción</th>
                                    <th>Identificador</th>
                                </tr>
                            </thead>
                            <tbody>';

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<tr>
                                <td>' . $fila['nombre'] . '</td>
                                <td><img src="imagenes/' . $fila['imagen'] . '.gif" alt="Imagen" class="img-fluid"></td>
                                <td>' . $fila['tipo'] . '</td>
                                <td>' . $fila['descripcion'] . '</td>
                                <td>' . $fila['identificador'] . '</td>
                              </tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo "No se encontraron registros.";
                }

                mysqli_close($conexion);
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
