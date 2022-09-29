
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"]=="frm_usu"))
{
    $tip_us = $_POST ['tipusu'];
    $sql_us ="SELECT * FROM TIPO_USUARIOS where rol='$tip_us'";
    $tip= mysqli_query($mysqli,$sql_us);
    $row= mysqli_fetch_assoc($tip);

    if ($row){
        echo '<script>alert ("El usuario ya existe. Cambielo!");</script>';
        echo '<script>window.location="agregar-usu.php"</script>';

    }
    elseif ($_POST["tipusu"] == "" ){
        echo '<script>alert ("Campos vacios");</script>';
        echo '<script>window.location="agregar-usu.php"</script>';
    }

    else{
        $tipo = $_POST ["tipusu"];
        $sql_usu ="INSERT INTO TIPO_USUARIOS (rol) values ('$tipo')";
        $tip= mysqli_query($mysqli,$sql_usu);
        //$row= mysqli_fetch_assoc($tipo);
        echo '<script>alert ("Registro ingresado con éxito");</script>';
        echo '<script>window.location="agregar-usu.php"</script>';

    }
}

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
            <h1><?php echo $usua['rol']?> FORMULARIO AGREGAR TIPOS USUARIO</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_usu" method="POST" autocomplete="off">
              <tr>
                 <th colspan="2">CREAR TIPOS DE USUARIO </th>
              </tr> 
              <tr>
                  <th>Identificador</th>
                  <th><input type="text"readonly></th>
              </tr>
              <tr>
                  <th>Tipo Usuario</th>
                  <th><input type="text"name="tipusu" placeholder= "Ingresar el tipo de Usuario "></th>
              </tr>
              <tr>
                 <th colspan="2">&nbsp</th>
              </tr> 
              <tr>
                 <th colspan="2"><input type="submit" value="Guardar" name="btn-guardar"</th>
                 <input type="hidden" name="guardar" value="frm_usu">

              </tr> 
                            
            </form>
        </table>


            

    </body>
</html>