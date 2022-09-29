<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");

$sql="SELECT * FROM usuarios,estados, tipo_usuarios WHERE usuarios.tipo_usuario = tipo_usuarios.tipo_usuario and usuarios.id_est= estados.id_est and usuarios.id_usuario='".$_GET['id']. "'";
$query = mysqli_query($mysqli,$sql);
$result = mysqli_fetch_assoc($query);

$sql_tusu= "Select * from tipo_usuarios";
$query_tusu=mysqli_query($mysqli, $sql_tusu);
$fila=mysqli_fetch_assoc($query_tusu);

?>
<?php
if(isset($_POST["update"]))
{
    $id_usuario= $_POST["doc"];
    $nombres= $_POST["nom"];
    $ape= $_POST["ape"];
    $dir= $_POST["dir"];
    $tel= $_POST["tel"];
    $correo= $_POST["correo"];
    $tpro= $_POST["tprof"];
    $tipousu= $_POST["tipousu"];
    $pass= $_POST["pass"];
    
    
   $sql_update="UPDATE usuarios SET id_usuario= '$id_usuario', nombres ='$nombres',apellidos='$ape',direccion = '$dir',telefono = '$tel',
   correo = '$correo',tarj_prof = '$tpro',tipo_usuario='$tipousu', password = '$pass' WHERE id_usuario = '".$_GET['id']."'";
   $cs=mysqli_query($mysqli, $sql_update);
   echo '<script>alert (" Actualización Exitosa ");</script>';

}
elseif(isset($_POST["delete"]))
{
   $sql_delete="DELETE FROM usuarios WHERE id_usuario = '".$_GET['id']."'";
   $cs=mysqli_query($mysqli, $sql_delete);
   echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
}

?>



<!DOCTYPE html>
<html lang="en">
    <script> 
        function centrar() { 
            iz=(screen.width-document.body.clientWidth) / 2; 
            de=(screen.height-document.body.clientHeight) / 2; 
            moveTo(iz,de); 
        }     
        </script>
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="centrar();"> 
    <table border="1"class="center" >
        <form name="frm_consulta" method="POST" autocomplete="off">
            <tr>
                <td>documento</td>
                <td><input readonly name="doc" type="text" value= "<?php echo $result ['id_usuario']  ?>"></td>
            </tr>
            <tr>
                <td>Nombres</td>
                <td><input name="nom" type="text" value= "<?php echo $result ['nombres']  ?>"></td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td><input name="ape" type="text" value= "<?php echo $result ['apellidos']  ?>"></td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td><input name="dir" type="text" value= "<?php echo $result ['direccion']  ?>"></td>
            </tr>
            <tr>
                <td>telefono</td>
                <td><input name="tel" type="text" value= "<?php echo $result ['telefono']  ?>"></td>
            </tr>
            <tr>
                <td>Correo</td>
                <td><input name="correo" type="email" value= "<?php echo $result ['correo']  ?>"></td>
            </tr>
            <tr>
                <td>Tarjeta</td>
                <td><input name="tprof" type="text" value= "<?php echo $result ['tarj_prof']  ?>"></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input name="pass" type="password" value= "<?php echo $result ['password']  ?>"></td>
            </tr>
            <tr>
                <td>Tipo usuario</td>
                <td>                  
                    <select name ="tipousu">
                    <option value="<?php echo $result ['tipo_usuario']  ?>"><?php echo $result ['rol']  ?></option>
                       <?php
                        //Codigo php ciclo
                        do{
              
                        ?>
                    <option value="<?php echo ($fila['tipo_usuario'])?>"><?php echo ($fila['rol'])?></option>
                    <?php   } while ($fila=mysqli_fetch_assoc($query_tusu));
                    ?>
                    </select>
            </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
                <td><input type="submit" name="update" value="Update"></td>
                

                <td><input type="submit" name="delete" value="Delete"></td>
                
                
            </tr>












        </form>

    </table>
</body>
</html>  
