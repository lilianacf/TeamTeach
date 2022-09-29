
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frm_cons"))
{
    $id_med=$_POST["id_med"];
    $desc_med = $_POST["desc_med"];
    //CONSULTA QUE VALIDA QUE EL MEDICAMENTO NO SE ENCUENTRE REGISTRADA
    $sql_val= " SELECT * FROM MEDICAMENTOS WHERE id_med='$id_med' AND desc_med='$desc_med'";
    $tip=mysqli_query($mysqli,$sql_val);
    $row= mysqli_fetch_assoc($tip);
   
    if ($row){
        echo'<script>alert ("El Código del medicamento se encuentra registrado");</script>';
        echo'<script>window.location="medicamentos.php"</script>';
    }

    elseif ($_POST["id_med"]=="" || $_POST["desc_med"]== "")
    {
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="medicamentos.php"</script>';
    }
    

else{
    $id_med= $_POST["id_med"];
    $desc_med = $_POST["desc_med"];
    $sql_mas="INSERT INTO medicamentos(id_med,desc_med) 
    values ('$id_med','$desc_med')";
    $tip = mysqli_query($mysqli, $sql_mas);    
    echo'<script>alert ("Registro ingresado exitosamente");</script>';
    echo'<script>window.location="medicamentos.php"</script>';

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <section class="title">
            <h1><?php echo $usua['rol']?> FORMULARIO CONSULTAR MEDICAMENTOS</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_cons" method="POST" autocomplete="off">
                <tr>
                    <td>
                       &nbsp;
                    </td>
                    <td>
                        Código Medicamentos 
                    </td>
                    <td>
                        Descripción Medicamentos
                    </td>
                    <td>
                        Acción
                    </td>
                  
                    <?php
                        $sql= "SELECT * FROM medicamentos ";
                        $i=0;
                        $query = mysqli_query($mysqli,$sql);
                        while($result=mysqli_fetch_assoc($query)){
                            $i++;                       
                    ?>
                <tr>
                    <td><?php echo $i ?></td> 
                    <td style="text-transform: uppercase;"><?php echo $result['id_med']?></td> 
                    <td style="text-transform: uppercase;"><?php echo $result['desc_med']?></td>
                    <td><a href="?id=<?php echo $result['id_med'] ?>" onclick="window.open('update_med.php?id=<?php echo $result['id_med'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>    
                </tr>  
                    <?php
                    }
                    ?>             
                </tr>
               
            </form>

        </table>
               
        
    </body>
</html>