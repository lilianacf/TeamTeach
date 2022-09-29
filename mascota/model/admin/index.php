
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
        <input type="submit" formaction="../index.php" value="Regresar" />
    

        
        
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
                    <a href="agregar-usu.php">
                        <img src="img/agregar.png" alt="" class="imagen">
                        <span class="text-item">Agregar tipo usuario</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="usuario.php">
                        <img src="img/user.png" alt="" class="imagen">
                        <span class="text-item">Agregar Usuarios</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="mascota.php">
                        <img src="img/pet.png" alt="" class="imagen">
                        <span class="text-item">Agregar Mascota</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="medicamentos.php">
                        <img src="img/med.png" alt="" class="imagen">
                        <span class="text-item">Agregar Medicamentos</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="hist_clinica.php">
                        <img src="img/his.png" alt="" class="imagen">
                        <span class="text-item">Agregar Historia Clínica</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li class="first-item">
                    <a href="cons_tipusu.php">
                        <img src="img/conusu.png" alt="" class="imagen">
                        <span class="text-item">Consultar tipos de usuario</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="lista_usuarios.php">
                        <img src="img/conmas.png" alt="" class="imagen">
                        <span class="text-item">Consultar Usuarios</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                
    
                <li>
                    <a href="list_mascota.php">
                        <img src="img/list.png" alt="" class="imagen">
                        <span class="text-item">Consultar Mascotas</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="cons_medicamentos.php">
                        <img src="img/conmed.png" alt="" class="imagen">
                        <span class="text-item">Consultar Medicamentos</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li>
                    <a href="cons_hclinica.php">
                        <img src="img/conhist.png" alt="" class="imagen">
                        <span class="text-item">Consultar Historia Clinica</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                
            </ul>
            
        </nav>
    </body>
</html>