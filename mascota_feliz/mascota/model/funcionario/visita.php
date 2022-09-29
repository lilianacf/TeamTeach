
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frmvis"))
{
    $id_vis=$_POST["id_vis"];
    //CONSULTA QUE VALIDA QUE LA VISITA NO SE ENCUENTRE REGISTRADA
    $sql_val= " SELECT * from visita where id_vis =$id_vis";
    $tip=mysqli_query($mysqli,$sql_val);
    $row= mysqli_fetch_assoc($tip);
   
    if ($row){
        echo'<script>alert ("La visita ya está registrada");</script>';
        echo'<script>window.location="visita.php"</script>';
    }   elseif 
    ($_POST["id_vis"]=="" || $_POST["fecha_visita"]== "" || $_POST ["id_usuario"] == "" || $_POST["cod_masc"]==""
    || $_POST["id_estado"]=="" || $_POST["temperatura"]== "" || $_POST["fr_resp"]=="" ||$_POST["fr_card"]==""
    || $_POST["est_animo"]=="" || $_POST["peso"] == "" || $_POST["recomendacion"] == "" || $_POST["costo_visita"] == "")
    {
        echo '<script>alert ("Existen campos vacíos");</script>';
        echo '<script>window.location="visita.php"</script>';
    }else
    {
        $id_vis = $_POST["id_vis"];
        $fecha_visita = $_POST["fecha_visita"];
        $id_usuario = $_POST["id_usuario"];
        $cod_masc = $_POST["cod_masc"];
        $id_est = $_POST["id_estado"];
        $temperatura = $_POST["temperatura"];
        $fr_resp = $_POST["fr_resp"];
        $fr_card = $_POST["fr_card"];
        $est_animo = $_POST["est_animo"];
        $peso = $_POST["peso"];
        $recomendacion = $_POST["recomendacion"];
        $costo_visita = $_POST["costo_visita"];
        $sql_vis="INSERT INTO visita (id_vis,fecha_visita,id_usuario,cod_masc,id_est,temperatura,fr_resp,fr_card,est_animo,peso,recomendacion,costo_visita)
        values ('$id_vis','$fecha_visita','$id_usuario','$cod_masc','$id_est','$temperatura','$fr_resp','$fr_card','$est_animo','$peso','$recomendacion','$costo_visita')";
        $tip = mysqli_query($mysqli, $sql_vis);    
        echo'<script>alert ("Registro ingresado exitosamente");</script>';
        echo'<script>window.location="visita.php"</script>';
       
    }
}
    //consulta tabla usuarios
    $sql_usu= "Select * from usuarios where tipo_usuario=3";
    $query_usu=mysqli_query($mysqli, $sql_usu);
    $fila=mysqli_fetch_assoc($query_usu);
    
    //consulta tabla mascotas_clientes
    $sql_masc= "SELECT * FROM mascotas_clientes,tipo_mascotas where mascotas_clientes.id_masc=tipo_mascotas.id_masc";
    $query_masc=mysqli_query($mysqli, $sql_masc);
    $fila_masc=mysqli_fetch_assoc($query_masc);
    
    //consulta tipo estado
    $sql_est= "SELECT * from estados WHERE ID_EST > 2 ";
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
    <title>VISITA</title>
    
</head>
    <body>
        <section class="title">
            <h1><?php echo $usua['rol']?> FORMULARIO VISITA MASCOTAS</h1>
        </section>
        <table border="1"class="center" >
            <form name="frmvis" method="POST" autocomplete="off">
              <tr>
                    <th colspan="2">Registrar Visita Mascota </th>
              </tr> 
              <tr>
                  <th>Número de Visita</th>
                  <th><input type="number" name="id_vis" placeholder="No. Visita"></th>
              </tr>
              <tr>
                  <th>Fecha de la visita</th>
                  <th><input type="date" name="fecha_visita" placeholder="Seleccione la fecha"></th>
              </tr>
              <tr>
                <th> Propietario</th>
                <th>
                <select name ="id_usuario"> 
                      <option value="">Seleccione el propietario</option>
                       <?php
                        //Codigo php ciclo
                        do{
                       ?>
                        <option value="<?php echo ($fila['id_usuario']) ?>"><?php echo ($fila['nombres']) ?> <?php echo ($fila['apellidos']) ?></option>
                        <?php   } while ($fila = mysqli_fetch_assoc($query_usu));
                       ?>
                </select>
                </th>
            </tr>
            <th> Mascota</th>
                <th>
                <select name ="cod_masc"> 
                      <option value="">Seleccione nombre mascota</option>
                       <?php
                        //Codigo php ciclo
                        do{
                       ?>
                    <option value="<?php echo ($fila_masc['cod_masc']) ?>"><?php echo ($fila_masc['nom_masc']) ?></option>
                        <?php   } while ($fila_masc = mysqli_fetch_assoc($query_masc));
                    ?>
                </select>
                </th>
            </tr>
            <th> Estado de la mascota</th>
                <th>
                <select name ="id_estado"> 
                      <option value="">Seleccione el estado de la mascota</option>
                       <?php
                        //Codigo php ciclo
                        do{
                       ?>
                        <option value="<?php echo ($fila_est['id_est']) ?>"><?php echo ($fila_est['desc_est']) ?></option>
                        <?php   } while ($fila_est = mysqli_fetch_assoc($query_est));
                       ?>
                </select>
            </th>
            </tr>
                 
            <tr>
                  <th>Temperatura de la mascota</th>
                  <th><input type="number" name="temperatura" placeholder="Ingrese la temperatura"></th>
              </tr>

              <tr>
                  <th>Frecuencia Respiratoria</th>
                  <th><input type="text" name="fr_resp" placeholder="Ingrese la Frecuencia Respiratoria"></th>
              </tr>

              <tr>
                  <th>Frecuencia Cardiaca</th>
                  <th><input type="text" name="fr_card" placeholder="Ingrese la Frecuencia Cardiaca"></th>
              </tr>

              <tr>
                  <th>Estado de Animo </th>
                  <th><input type="text" name="est_animo" placeholder="Ingrese el Estado de Animo"></th>
              </tr>

              <tr>
                  <th>Peso </th>
                  <th><input type="text" name="peso" placeholder="Ingrese el peso"></th>
              </tr>
              
              <tr>
                  <th>Recomendaciones:</th>
                  <th><input type="text" name="recomendacion" placeholder="Ingrese las recomendaciones"></th>
              </tr>
              <tr>
                  <th>Costo Visita </th>
                  <th><input type="number" name="costo_visita" placeholder="Ingrese el costo a cobrar: "></th>
              </tr>
                        
            
            <tr>
                            <th colspan="2"><input type="submit" value="Guardar" name="btnguardar"></th>
                            <input type="hidden" name="guardar" value="frmvis">
            </tr>
            
           
            </form>


        </table>
         
       
    </body>
</html> 