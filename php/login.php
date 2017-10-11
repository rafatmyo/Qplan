<?php
SESSION_START();
include("conectar.php");
$con = conectar();
if(isset($_REQUEST['user'])& isset($_REQUEST['pass'])){
	//echo "Iniciar";
	$sql = $con->prepare("SELECT user FROM usuarios WHERE user = ? and password = ?");
	$sql->bindParam(1, $_REQUEST['user']);
	$sql->bindParam(2, $_REQUEST['pass']);
	$sql->execute();
	$num_rows = $sql->rowCount();
	if ($num_rows > 0) {
		//iniciar Session
		$_SESSION['user']= strtolower($_REQUEST['user']);

		$user = $_SESSION['user'];
		header('Location: ../');
	} else {
		echo "Incorrecto";
		//$msg = 'Correo/Contraseña Invalido(s)';
		//echo $msg;
	}
}

if(isset($_REQUEST['user2'])& isset($_REQUEST['pass2'])){
	//crear la carpeta
	$carpeta = '../images/'.strtolower($_REQUEST['user2']);
	mkdir($carpeta);

	$sql = $con->prepare("INSERT INTO usuarios (user, password) VALUES (?, ?)");
	$sql->bindParam(1, strtolower($_REQUEST['user2']));
	$sql->bindParam(2, $_REQUEST['pass2']);
	$sql->execute();
	$num_rows = $sql->rowCount();
	if ($num_rows > 0) {
		$_SESSION['user']=$_REQUEST['user2'];

		header('Location: ../');
	}
}

if(isset($_REQUEST['userCheck'])){
	$sql = $con->prepare("SELECT user FROM usuarios WHERE user = ?");
	$sql->bindParam(1, $_REQUEST['userCheck']);
	$sql->execute();
	$num_rows = $sql->rowCount();
	if ($num_rows > 0) {
		//Usuario Existe
		echo "Existe";
	}
}

if(isset($_REQUEST['cerrar'])){
	SESSION_UNSET();
	SESSION_DESTROY();
	//echo "Secion Cerrada";
	header('Location: ../');
}

$con = null;

//echo "".$_SESSION['user'];
?>