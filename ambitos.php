<?php
    include('configdb.php');
    $conexion=mysqli_connect($host,$usuario,$pw,$db);
    if($conexion){
        echo 'Conexion aceptada';
    }else{
        echo 'Error en la conexión';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Miniuegos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/css.css">
    </head>
    <body>
        <h2>Seleccione los ambitos</h2>
        <form action="procesar.php" class="formulario" method="post">
            <label for="ambitos">Ambitos:</label><br>
            <?php
                $sql="SELECT * FROM ambitos";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){
                    echo '<input type="checkbox" name="ambitos[]" value="'.$mostrar['idAmbito'] . '">'.$mostrar['nombre'].'<br>';
                }
            ?>
            <!-- Terminos -->
            <label for="terminos">Aceptar los términos y condiciones</label><br>
            <input type="checkbox" id="terminos" name="terminos" value="1">Acepto
            <input type="checkbox" id="terminos" name="terminos" value="0">No acepto
            <br><br>
            <input type="submit" value="Enviar">
        </h2>
    </body>
</html>