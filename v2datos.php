<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Juego</title>
    <link rel="stylesheet" href="v2css/v2-css.css">
</head>
<body>
    <div class="contenido">
        <?php   
            include('v2configdb.php');

            if(isset($_GET['URLJuego']) && !empty($_GET['URLJuego'])){
                $url=$_GET['URLJuego'];
                echo '<p><strong>URLJuego:</strong> ' . $url . '</p>';
            } else {
                echo '<p>No se ha recibido la url</p>';
                exit();
            }

            $conexion=mysqli_connect($host,$usuario,$pw,$db);
            if($conexion){
                //echo 'Conexion aceptada';
            }else{
                echo '<p>Error en la conexión</p>';
                exit();
            }

            $sql="SELECT * 
                FROM  minijuegos
                WHERE minijuegos.URLJuego='$url'";
            $result=mysqli_query($conexion,$sql);
            
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                header('Location: ' . $row['URLJuego']);
                exit();
            } else {
                echo '<p>No se encontró el juego</p>';
            }
            mysqli_close($conexion);

            echo '<a href="v2ambitos.php">Volver</a>';
        ?>
    </div>
</body>
</html>
