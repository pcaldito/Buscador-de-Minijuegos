<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados</title>
        <link rel="stylesheet" href="css/css.css">
    </head>
    <body>

    <div class="resultados">
        <h2>Resultados</h2>

        <?php   
            include('configdb.php');
            $conexion = mysqli_connect($host, $usuario, $pw, $db);

            if (!$conexion) {
                die('<p class="error">Error en la conexión</p>');
            }

            if (isset($_POST['terminos'])) {
                if ($_POST['terminos'] == 1) {
                    echo '<p class="exito">Términos aceptados</p>';
                } else {
                    echo '<p class="error">No aceptaste los términos</p>';
                    echo '<a href="ambitos.php">Volver</a>';
                }
            } else {
                echo '<p class="error">No has seleccionado los términos</p>';
                echo '<a href="ambitos.php">Volver</a>';
            }
/*
            if (isset($_POST['ambitos'])) {
                echo "<div class='ambitos'><h3>Ámbitos seleccionados:</h3>";
                foreach ($_POST['ambitos'] as $ambito) {
                    echo "<p>$ambito</p>";
                }
                echo "</div>";
            } else {
                echo '<p class="error">No has seleccionado ningún ámbito</p>';
                echo '<a href="index.php">Volver</a>';
            }

            mysqli_close($conexion);
            echo '<hr>';
*/
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
                                echo "<p>Nombre del juego: <br>" . $mostrar['nombreJuego'] . "  |  " .  $mostrar['nombreAmbito'] . "</p>";
                                echo "<hr>";
                            }
                        } else {
                            echo "<p class='error'>Error en la consulta: " . mysqli_error($conexion) . "</p>";
                            echo '<a href="ambitos.php">Volver</a>';
                        }
                        echo "</div>";
                        echo '<a href="ambitos.php">Volver</a>';
                    } else {
                        echo '<p class="error">No hay ámbitos válidos seleccionados.</p>';
                        echo '<a href="ambitos.php">Volver</a>';
                    }
                } else {
                    echo '<p class="error">No se han seleccionado ámbitos para buscar minijuegos.</p>';
                    echo '<a href="ambitos.php">Volver</a>';
                }
            } else {
                echo '<p class="error">No aceptaste los términos</p>';
                echo '<a href="ambitos.php">Volver</a>';
            }
        ?>

    </div>

    </body>
</html>
