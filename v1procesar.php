<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados</title>
        <link rel="stylesheet" href="v1css/v1css.css">
    </head>
    <body>

    <div class="resultados">
        <h2>Resultados</h2>

        <?php   
            include('v1configdb.php');
            $conexion = mysqli_connect($host, $usuario, $pw, $db);

            if (!$conexion) {
                die('<p class="error">Error en la conexión</p>');
            }

            if (isset($_POST['terminos'])) {
                if ($_POST['terminos'] == 1) {
                    echo '<p class="exito">Términos aceptados</p>';
                } else {
                    echo '<p class="error">No aceptaste los términos</p>';
                    echo '<a href="v1ambitos.php">Volver</a>';
                }
            } else {
                echo '<p class="error">No has seleccionado los términos</p>';
                echo '<a href="v1ambitos.php">Volver</a>';
            }

            $conexion = mysqli_connect($host, $usuario, $pw, $db);

            if($_POST['terminos'] == 1){
                //echo '<p class="exito">Términos aceptados</p>';

                if (isset($_POST['ambitos']) && is_array($_POST['ambitos'])) {
                    $minijuegos = [];
                
                    foreach ($_POST['ambitos'] as $ambito) {
                        if (is_numeric($ambito)) {
                            $minijuegos[] = intval($ambito);
                        }
                    }
                
                    if (!empty($minijuegos)) {
                        $minijuegos_str = implode(",", $minijuegos);
                
                        $sql = "SELECT minijuegos.nombre AS nombreJuego, minijuegos.URLJuego, minijuegos.URLAdmin, 
                                ambitos.nombre AS nombreAmbito 
                                FROM minijuegos 
                                INNER JOIN ambitos ON minijuegos.idAmbito = ambitos.idAmbito
                                WHERE minijuegos.idAmbito IN ($minijuegos_str)";
                
                        $result = mysqli_query($conexion, $sql);
                
                        echo '<div class="minijuegos"><h3>Minijuegos según los ámbitos seleccionados:</h3>';
                
                        if ($result) {
                            while ($mostrar = mysqli_fetch_assoc($result)) {
                                echo "<p>Nombre del juego: <br><a href='v1datos.php?nombreJuego=" . $mostrar['nombreJuego'] . "' target='_blank'>" . $mostrar['nombreJuego'] . "</a> | " . $mostrar['nombreAmbito'] . "</p>";
                                echo "<hr>";
                            }
                        } else {
                            echo "<p class='error'>Error en la consulta: " . mysqli_error($conexion) . "</p>";
                            echo '<a href="v1ambitos.php">Volver</a>';
                        }
                        echo "</div>";
                        echo '<a href="v1ambitos.php">Volver</a>';
                    } else {
                        echo '<p class="error">No hay ámbitos válidos seleccionados.</p>';
                        echo '<a href="v1ambitos.php">Volver</a>';
                    }
                } else {
                    echo '<p class="error">No se han seleccionado ámbitos para buscar minijuegos.</p>';
                    echo '<a href="v1ambitos.php">Volver</a>';
                }
            } else {
                echo '<p class="error">No aceptaste los términos</p>';
                echo '<a href="v1ambitos.php">Volver</a>';
            }
        ?>

    </div>

    </body>
</html>
