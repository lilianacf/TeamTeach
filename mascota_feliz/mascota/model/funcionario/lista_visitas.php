
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
//consulta id de la visita
    $sql_idvis= "Select * from visita";
    $query_idvis=mysqli_query($mysqli, $sql_idvis);
    $fila=mysqli_fetch_assoc($query_idvis);
   
?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombres']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
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
    <title>visitas</title>
    
</head>
    <body>
        <section class="title">
            <h1><?php echo $usua['rol']?> FORMULARIO CONSULTAR VISITAS</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_convis" method="POST" autocomplete="off">
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        Id Visita                  
                    </td>

                    <td>
                        Fecha 
                    </td>

                    <td>
                        Identificación Veterinario 
                    </td>
                   
                 
                    <td>
                        Nombre Mascota
                    </td>

                    <td>
                        Estado Salud 
                    </td>

                    <td>
                        Temperatura
                    </td>

                    <td>
                        Frecuencia Respiratoria
                    </td>

                    <td>
                        Frecuencia Cardíaca
                    </td>

                    <td>
                        Estado Ánimo
                    </td>

                    <td>
                        Peso
                    </td>

                    <td>
                        Recomendaciones
                    </td>

                    <td>
                        Costo Visita
                    </td>

                </tr>
                <?php
                
                    
                    $sql= "SELECT * FROM visita,usuarios, mascotas_clientes,estados 
                    WHERE visita.id_usuario = usuarios.id_usuario
                    and visita.id_est = estados.id_est
                    and mascotas_clientes.cod_masc = visita.cod_masc
                    and mascotas_clientes.id_usuario =  usuarios.id_usuario";
                    $i=0;
                    $query = mysqli_query($mysqli,$sql);
                    while($result=mysqli_fetch_assoc($query)){
                        $i++;                    
                ?>
                <tr>
                    <td><?php echo $i ?></td>  
                    <td><input name="id_vis" type="text" value= "<?php echo $result ['id_vis']  ?>"> </td>  
                    <td><input name="fecha_visita" type="" value= "<?php echo $result ['fecha_visita']  ?>"> </td>  
                    <td><input name="id_usuario" type="text" value= "<?php echo $result ['id_usuario']  ?>"> </td>  
                    <td><input name="nom_masc" type="text" value= "<?php echo $result ['nom_masc']  ?>"> </td>  
                    <td><input name="id_est" type="text" value= "<?php echo $result ['desc_est']  ?>"> </td>  
                    <td><input name="temperatura" type="number" value= "<?php echo $result ['temperatura']  ?>"> </td>  
                    <td><input name="fr_resp" type="number" value= "<?php echo $result ['fr_resp']  ?>"> </td>                      
                    <td><input name="fr_card" type="number" value= "<?php echo $result ['fr_card']  ?>"> </td>  
                    <td><input name="est_animo" type="text" value= "<?php echo $result ['est_animo']  ?>"> </td> 
                    <td><input name="peso" type="text" value= "<?php echo $result ['peso']  ?>"> </td> 
                    <td><input name="recomendacion" type="text" value= "<?php echo $result ['recomendacion']  ?>"> </td> 
                    <td><input name="costo_visita" type="number" value= "<?php echo $result ['costo_visita']  ?>"> </td>   
 
                </tr>
                    <?php 
                    }
                    ?>  
            </form>


        </table>


            
        
    </body>
</html>