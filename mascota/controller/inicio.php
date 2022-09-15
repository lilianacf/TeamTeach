<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){
	// inicia sesion para los usuarios
	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from usuarios where id_usuario= '$usuario' and password = '$clave'"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);
	
	if($fila){		
		/// si el usuario y la clave son correctas, creamos las sessiones 
			
		$_SESSION['id_usuario'] = $fila['id_usuario']; 
		$_SESSION['nombres'] = $fila['nombres']; 
		$_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
		///$_SESSION['usuario'] = $fila['usuario'];
		
				/// dependiendo del tipo de usuario lo redireccionamos a una pagina
		/// si es un admin
		if($_SESSION['tipo_usuario'] == 1){
			header("Location: ../model/admin/index.php"); 
			exit();
		
		}
		/// si es un veterinario
		elseif($_SESSION['tipo_usuario'] == 2){
			header("Location:../model/funcionario/index.php"); 
			exit();		
		}
		else{
			header("Location:../model/propietario/index.php"); 
			exit();
		}
			}
		else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inicio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>