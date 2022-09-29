
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND usuarios.tipo_usuario = tipo_usuarios.tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frmusu"))
{
    $id_usuario=$_POST["id_usu"];
    $tipo_usu=$_POST["tipousu"];
    //CONSULTA QUE VALIDA QUE EL USUARIO NO SE ENCUENTRE REGISTRADO
    $sql_val= " SELECT * from usuarios where id_usuario =$id_usuario AND tipo_usuario=$tipo_usu";
    $tip=mysqli_query($mysqli,$sql_val);
    $row= mysqli_fetch_assoc($tip);
   
    if ($row){
        echo'<script>alert ("El usuario ya está registrado como Administrador");</script>';
        echo'<script>window.location="usuario.php"</script>';
    }

    elseif ($_POST["id_usu"]=="" || $_POST["nombre"]== "" || $_POST ["apellido"] == "" || $_POST["dir"]==""
    || $_POST["tel"]=="" || $_POST["email"]== "" || $_POST["tprof"]=="" ||$_POST["passwd"]==""
    || $_POST["tipousu"]=="" || $_POST["estusu"] == ""){
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="usuario.php"</script>';
    }
    

else{
    $id = $_POST["id_usu"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dir = $_POST["dir"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $tprof = $_POST["tprof"];
    $passwd = $_POST["passwd"];
    $tipousu = $_POST["tipousu"];
    $idest = $_POST["estusu"];
    $sql_usu="INSERT INTO usuarios (id_usuario,nombres,apellidos,direccion,telefono,correo,tarj_prof,tipo_usuario,id_est,password) 
    values ('$id','$nombre','$apellido','$dir','$tel','$email','$tprof','$tipousu','$idest','$passwd')";
    $tip = mysqli_query($mysqli, $sql_usu);    
    echo'<script>alert ("Registro ingresado exitosamente");</script>';
    echo'<script>window.location="usuario.php"</script>';

}

}





//consulta tabla tipo de usuario
    //select * from 'tipo_usuarios'
    $sql_tusu= "Select * from tipo_usuarios";
    $query_tusu=mysqli_query($mysqli, $sql_tusu);
    $fila=mysqli_fetch_assoc($query_tusu);
    //consulta tipo estado
    $sql_est= "SELECT * from estados WHERE ID_EST< 3 ";
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
            <h1><?php echo $usua['rol']?> FORMULARIO AGREGAR USUARIOS</h1>
        </section>
        <table border="1"class="center" >
            <form name="frm_usu" method="POST" autocomplete="off">
              <tr>
                    <th colspan="2">Crear Usuarios </th>
              </tr> 

              <tr>
                  <th>Documento Identificación Usuario</th>
                  <th><input type="number" name="id_usu" placeholder="Ingrese documento usuario"></th>
              </tr>


              <tr>
                  <th>Nombres del Usuario</th>
                  <th><input type="text" name="nombre" placeholder="Ingrese nombres usuario"></th>
              </tr>

              <tr>
                  <th>Primer Apellido del Usuario</th>
                  <th><input type="text" name="apellido" placeholder="Ingrese apellidos usuario"></th>
              </tr>

              <tr>
                  <th>Dirección del Usuario</th>
                  <th><input type="text" name="dir" placeholder="Ingrese la dirección"></th>
              </tr>

              <tr>
                  <th>Teléfono del Usuario</th>
                  <th><input type="number" name="tel" placeholder="Ingrese el teléfono"></th>
              </tr>

              <tr>
                  <th>Correo del Usuario </th>
                  <th><input type="text" name="email" placeholder="Ingrese el correo electrónico"></th>
              </tr>

              <tr>
                  <th>Tarjeta profesional</th>
                  <th><input type="text" name="tprof" placeholder="Ingrese la tarjeta profesional"></th>
              </tr>
              
              <tr>
                  <th> Contraseña Usuario</th>
                  <th><input type="password" name="passwd" placeholder="Ingrese la contraseña del usuario"></th>
              </tr>
              
            <tr>
                <th> Tipo Usuario</th>
                <th>
                    <select name ="tipousu"> 
                    <option value="">Seleccione Tipo de usuario</option>
                       <?php
                        //Codigo php ciclo
                        do{
              
                        ?>
                    <option value="<?php echo ($fila['tipo_usuario'])?>"><?php echo ($fila['rol'])?></option>
                    <?php   } while ($fila=mysqli_fetch_assoc($query_tusu));
                    ?>
                </select>
                </th>
            </tr>

            <tr>
                <th>Estado Usuario</th>
                <th>
                <select name ="estusu")
                    <option value="">Seleccione Estado Usuario</option>
                    <?php
                        //Codigo php ciclo
                        do{
              
                    ?>
                    <option value="<?php echo ($fila_est['id_est'])?>"><?php echo ($fila_est['desc_est'])?></option>
                    <?php   } while($fila_est=mysqli_fetch_assoc($query_est));
                    ?>

                </select)
                </th>
            </tr>
            
            <tr>
                            <th colspan="2"><input type="submit" value="Guardar" name="btnguardar"></th>
                            <input type="hidden" name="guardar" value="frmusu">
            </tr>
            
           
            </form>


        </table>


            
        
    </body>
</html>