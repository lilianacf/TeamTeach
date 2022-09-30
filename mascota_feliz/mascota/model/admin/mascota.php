
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frmmas"))
{
    $codmasc=$_POST["codmasc"];
    $idusuario = $_POST["idusu"];
    //CONSULTA QUE VALIDA QUE LA MASCOTA NO SE ENCUENTRE REGISTRADA
    $sql_val= " SELECT * FROM mascotas_clientes WHERE cod_masc='$codmasc' AND id_usuario=$idusuario";
    $tip=mysqli_query($mysqli,$sql_val);
    $row= mysqli_fetch_assoc($tip);
   
    if ($row){
        echo'<script>alert ("El código de la mascota está registrado");</script>';
        echo'<script>window.location="mascota.php"</script>';
    }

    elseif ($_POST["codmasc"]=="" || $_POST["nommasc"]== "" || $_POST["idusu"]== "" || $_POST ["tipmasc"] == "" || $_POST["color"]==""|| $_POST["raza"]=="")
    {
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="mascota.php"</script>';
    }
    

else{
    $codmasc= $_POST["codmasc"];
    $nommasc = $_POST["nommasc"];
    $idusuario = $_POST["idusu"];
    $idmasc = $_POST["tipmasc"];
    $color = $_POST["color"];
    $raza = $_POST["raza"];
    $sql_mas="INSERT INTO mascotas_clientes (cod_masc,nom_masc,id_usuario,color,id_masc,raza) 
    values ('$codmasc','$nommasc','$idusuario','$color','$idmasc','$raza')";
    $tip = mysqli_query($mysqli, $sql_mas);    
    echo'<script>alert ("Registro ingresado exitosamente");</script>';
    echo'<script>window.location="mascota.php"</script>';

    }

}





//consulta tabla tipo de usuario
    //select * from 'tipo_usuarios'
    $sql_tusu= "Select * from tipo_usuarios";
    $query_tusu=mysqli_query($mysqli, $sql_tusu);
    $fila=mysqli_fetch_assoc($query_tusu);
    //consulta tipo mascota
    $sql_est= "SELECT * from tipo_mascotas WHERE ID_MASC > 0 ";
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
            <h1><?php echo $usua['rol']?> FORMULARIO AGREGAR MASCOTA</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_mas" method="POST" autocomplete="off">
              <tr>
                    <th colspan="2">Crear Mascota </th>
              </tr> 

              <tr>
                  <th>Código Mascota</th>
                  <th><input type="text" name="codmasc" placeholder="Código mascota"></th>
              </tr>

              <tr>
                  <th>Nombres de la Mascota</th>
                  <th><input type="text" name="nommasc" placeholder="Ingrese nombre mascota"></th>
              </tr>
              
              <tr>
                    <th>Propietario</th>
                    <th>
                    <select name ="idusu")
                        <option value="">Seleccione propietario</option>
                        <?php
                            $sql_tusu= "Select * from usuarios where tipo_usuario=3";
                            $query_tusu=mysqli_query($mysqli, $sql_tusu);
                            $fila=mysqli_fetch_assoc($query_tusu);
                            //Codigo php ciclo
                            do{
              
                        ?>
                        <option value="<?php echo ($fila['id_usuario'])?>"><?php echo ($fila['nombres'])?> <?php echo ($fila['apellidos'])?></option>
                        <?php   } while($fila=mysqli_fetch_assoc($query_tusu));
                        ?>

                    </select)
                    </th>
                </tr>

              <tr>
                  <th>Color Mascota</th>
                  <th><input type="text" name="color" placeholder="Ingrese el color mascota"></th>
              </tr>

              <tr>
                  <th>Tipo Mascota</th>
                  <th>
                  <select name ="tipmasc")
                     <option value="">Seleccione el tipo de mascota</option>
                    <?php

                        //Codigo php ciclo
                        do{
              
                    ?>
                    <option value="<?php echo ($fila_est['id_masc'])?>"><?php echo ($fila_est['tip_masc'])?></option>
                    <?php   } while($fila_est=mysqli_fetch_assoc($query_est));
                    ?>
                  </select)
                  </th>                                
                </tr>

              <tr>
                  <th>Raza mascota </th>
                  <th><input type="text" name="raza" placeholder="Ingrese la raza mascota"></th>
              </tr>
                    
            <tr>
                            <th colspan="2"><input type="submit" value="Guardar" name="btnguardar"></th>
                            <input type="hidden" name="guardar" value="frmmas">
            </tr>
            
           
            </form>


        </table>


            
        
    </body>
</html>