<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombres']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../propietario/index.php" value="Regresar" />
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
        <table border="1"class="center table table-striped" >
            <form name="frm_cons" method="POST" autocomplete="off">
                <tr>
                    <td>
                       &nbsp;
                    </td>
                    <td>
                       CÓDIGO MASCOTA
                    </td>
                    <td>
                        NOMBRE MASCOTA
                    </td>
                    <td>
                        COLOR
                    </td>
                    <td>
                        TIPO DE MASCOTA
                    </td>

                    <td>
                        RAZA
                    </td>

                  
                    <?php
                        //CONSULTA MASCOTAS DEL PROPIETARIO
                        $sql_idmasc= "SELECT * FROM mascotas_clientes,tipo_mascotas,usuarios where mascotas_clientes.id_masc=tipo_mascotas.id_masc and mascotas_clientes.id_usuario= usuarios.id_usuario and usuarios.id_usuario = '".$_SESSION['id_usuario']."'";
                        $i=0;
                        $query=mysqli_query($mysqli, $sql_idmasc);
                         while($result = mysqli_fetch_assoc($query)){
                            $i++;
                        
                    ?>
                <tr>
                <td style="text-transform: uppercase;" ><?php echo $i ?></td> 
                    <td style="text-transform: uppercase;" ><?php echo $result['cod_masc']?></td> 
                    <td style="text-transform: uppercase;" ><?php echo $result['nom_masc']?></td>
                    <td style="text-transform: uppercase;" ><?php echo $result['color']?></td> 
                    <td style="text-transform: uppercase;" ><?php echo $result['tip_masc']?></td> 
                    <td style="text-transform: uppercase;" ><?php echo $result['raza']?></td>

                </tr>  
                    <?php
                    }
                    ?>             
                </tr>
               
            </form>


        </table>


            
        
    </body>
</html>
