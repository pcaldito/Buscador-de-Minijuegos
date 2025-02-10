<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Juego</title>
    <link rel="stylesheet" href="v1css/v1css.css">
</head>
<body>
    <div class="contenido">
        <?php   
            include('v1configdb.php');

            if(isset($_GET['nombreJuego']) || !empty($_GET['nombreJuego'])){
                $nombre=$_GET['nombreJuego'];
                echo '<p><strong>Nombre:</strong> ' . $nombre . '</p>';
            } else {
                echo '<p>No se ha recibido el nombre</p>';
            }

            $conexion=mysqli_connect($host,$usuario,$pw,$db);
            if($conexion){
                //echo 'Conexion aceptada';
            }else{
                echo '<p>Error en la conexión</p>';
            }

            $sql="SELECT * 
                FROM  minijuegos
                INNER JOIN ambitos ON minijuegos.idAmbito = ambitos.idAmbito 
                WHERE minijuegos.nombre='$nombre'";
            $result=mysqli_query($conexion,$sql);
            while($mostrar=mysqli_fetch_array($result)){
                echo '<div class="detalles">';
                echo '<p><strong>Ámbito:</strong> ' . $mostrar['nombre'] . '</p>';
                echo '<p><strong>URL del Juego:</strong> <a href="' . $mostrar['URLJuego'] . '" target="_blank">' . $mostrar['URLJuego'] . '</a></p>';
                echo '<p><strong>URL Admin:</strong> <a href="' . $mostrar['URLAdmin'] . '" target="_blank">' . $mostrar['URLAdmin'] . '</a></p>';
                echo '<p><strong>ID Ámbito:</strong> ' . $mostrar['idAmbito'] . '</p>';
                echo '</div>';
            }
            mysqli_close($conexion);

            echo '<a href="v1ambitos.php">Volver</a>';
        ?>
    </div>
</body>
</html>
