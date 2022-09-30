
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
  
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../funcionario/index.php" value="Regresar" />
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
            <h1>INTERFAZ    <?php echo $usua['rol']?></h1>
        </section>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">
                    <a href="visita.php">
                        <img src="img/agre.png" alt="" class="imagen">
                        <span class="text-item">Visita</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="lista_visitas.php">
                        <img src="img/med.png" alt="" class="imagen">
                        <span class="text-item">Detalle de visita</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                
               
            </ul>
          
        </nav>
    </body>
</html>