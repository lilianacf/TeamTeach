<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '" . $_SESSION['id_usuario'] . "' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombres'] ?></td>
    </tr>
    <tr><br>
        <td colspan='2' align="center">


            <input type="submit" value="Cerrar sesión" name="btncerrar" />
        </td>
        <input type="submit" formaction="../admin/index.php" value="Regresar" />
    </tr>
</form>

<?php

if (isset($_POST['btncerrar'])) {
    session_destroy();


    header('location: ../../index.html');
}

?>

</div>

</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>taller</title>
    
</head>
    <body>
        <section class="title">
            <h1><?php echo $usua['rol']?> CONSULTAR TIPOS DE USUARIO</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_consulta" method="POST" autocomplete="off">
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        Tipo usuario                   
                    </td>

                    <td>
                        Rol
                    </td>  
                    
                </tr>
                <?php
                    $sql="SELECT * FROM tipo_usuarios";
                    $i=0;
                    $query = mysqli_query($mysqli,$sql);
                    while($result=mysqli_fetch_assoc($query)){
                        $i++;                    
                ?>
                <tr>
                    <td><?php echo $i ?></td>  
                    <td><input name="tip" type="text" value= "<?php echo $result ['tipo_usuario']  ?>"> </td>  
                    <td><input name="rol" type="text" value= "<?php echo $result ['rol']  ?>"> </td>  
                </tr>
                    <?php 
                    }
                    ?>  
            </form>


        </table>


            
        
    </body>
</html>