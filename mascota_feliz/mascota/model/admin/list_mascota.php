
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
    $sql_val= " SELECT * FROM mascotas_clientes WHERE cod_masc=$codmasc AND id_usuario=$idusuario";
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
    $sql_est= "SELECT * from tipo_mascotas WHERE ID_MASC > 2 ";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <section class="title">
            <h1><?php echo $usua['rol']?> FORMULARIO CONSULTAR MASCOTAS</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_cons" method="POST" autocomplete="off">
                <tr>
                    <td>
                       &nbsp;
                    </td>
                    <td>
                       Código Mascota 
                    </td>
                    <td>
                        Nombre Mascota
                    </td>
                    <td>
                        Color
                    </td>
                    <td>
                        Tipo de Mascota
                    </td>

                    <td>
                        Raza
                    </td>
                    <td>
                        Acción
                    </td>
                  
                    <?php
                        $sql= "SELECT * FROM mascotas_clientes,tipo_mascotas,usuarios where mascotas_clientes.id_usuario=usuarios.id_usuario and mascotas_clientes.id_masc=tipo_mascotas.id_masc";
                        $i=0;
                        $query = mysqli_query($mysqli,$sql);
                        while($result=mysqli_fetch_assoc($query)){
                            $i++;                       
                    ?>
                <tr>
                    <td><?php echo $i ?></td> 
                    <td style="text-transform: uppercase;"><?php echo $result['cod_masc']?></td> 
                    <td style="text-transform: uppercase;"><?php echo $result['nom_masc']?></td>
                    <td style="text-transform: uppercase;"><?php echo $result['color']?></td> 
                    <td style="text-transform: uppercase;"><?php echo $result['tip_masc']?></td> 
                    <td style="text-transform: uppercase;"><?php echo $result['raza']?></td>
                    <td><a href="?id=<?php echo $result['cod_masc'] ?>" onclick="window.open('update_masc.php?id=<?php echo $result['cod_masc'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>    
                </tr>  
                    <?php
                    }
                    ?>             
                </tr>
               
            </form>


        </table>


            
        
    </body>
</html>