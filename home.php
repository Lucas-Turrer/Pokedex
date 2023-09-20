<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokedex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>
<body><?php
session_start();
if( isset($_SESSION["usuario"]) ){
}
else{
    header("location:index.php");
    exit();
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white p-4 rounded">
        <div class="container">
            <h1>Home</h1>
            <?php
            $conexion = mysqli_connect("localhost", "root", "", "pokedex")
            or die ("Fallo");
            $consulta = mysqli_query($conexion, "select * from usuario") or die("Fallo");

            $nfilas = mysqli_num_rows($consulta);
            while($fila = mysqli_fetch_assoc($consulta)) {
                echo $fila["nombreUsuario"];
                echo $fila["password"];
            }
            ?>
            <form action="logoutPokedex.php" method="post">
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Salir"  >
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
