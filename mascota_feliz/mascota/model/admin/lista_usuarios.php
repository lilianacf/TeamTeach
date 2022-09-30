
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
//consulta tabla tipo de usuario
    //select * from 'tipo_usuarios'
    $sql_tusu= "Select * from tipo_usuarios";
    $query_tusu=mysqli_query($mysqli, $sql_tusu);
    $fila=mysqli_fetch_assoc($query_tusu);
    //consulta tipo estado
    $sql_est= "SELECT * from estados WHERE ID_EST< 3 ";
    $query_est=mysqli_query($mysqli, $sql_est);
    $fila_est=mysqli_fetch_assoc($query_est);
?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombres']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../admin/index.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
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
            <h1><?php echo $usua['rol']?> FORMULARIO CONSULTAR USUARIOS</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_consulta" method="POST" autocomplete="off">
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        Documento                    
                    </td>

                    <td>
                        Nombre 
                    </td>
                    
                    <td>
                        Apellido 
                    </td>
                    
                    <td>
                        Direccion 
                    </td>

                    <td>
                        Teléfono 
                    </td>

                    <td>
                        Correo 
                    </td>

                    <td>
                        Tarjeta Profesional
                    </td>

                    <td>
                        Tipo usuario
                    </td>

                    <td>
                        Estado
                    </td>

                    <td>
                        Acción
                    </td>

                </tr>
                <?php
                    $sql="SELECT * FROM usuarios,estados, tipo_usuarios WHERE usuarios.tipo_usuario = tipo_usuarios.tipo_usuario and usuarios.id_est= estados.id_est";
                    $i=0;
                    $query = mysqli_query($mysqli,$sql);
                    while($result=mysqli_fetch_assoc($query)){
                        $i++;                    
                ?>
                <tr>
                    <td><?php echo $i ?></td>  
                    <td><input name="doc" type="text" value= "<?php echo $result ['id_usuario']  ?>"> </td>  
                    <td><input name="nom" type="text" value= "<?php echo $result ['nombres']  ?>"> </td>  
                    <td><input name="ape" type="text" value= "<?php echo $result ['apellidos']  ?>"> </td>  
                    <td><input name="dir" type="text" value= "<?php echo $result ['direccion']  ?>"> </td>  
                    <td><input name="tel" type="text" value= "<?php echo $result ['telefono']  ?>"> </td>  
                    <td><input name="correo" type="text" value= "<?php echo $result ['correo']  ?>"> </td>  
                    <td><input name="tp" type="text" value= "<?php echo $result ['tarj_prof']  ?>"> </td>                      
                    <td><input name="est" type="text" value= "<?php echo $result ['rol']  ?>"> </td>  
                    <td><input name="rol" type="text" value= "<?php echo $result ['desc_est']  ?>"> </td>  
                    <td><a href="?id=<?php echo $result['id_usuario'] ?>" onclick="window.open('update.php?id=<?php echo $result['id_usuario'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>    
                </tr>
                    <?php 
                    }
                    ?>  
            </form>


        </table>


            
        
    </body>
</html>