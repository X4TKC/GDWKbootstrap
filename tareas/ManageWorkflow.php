<?php
include_once '../clases/database.php';
include_once '../clases/user.php';
include_once '../clases/ticket.php';
session_start();
$_SESSION['id']=$_GET['id'];
$id=$_GET['id'];
$type=$_GET['uno'];
$idtarea=$_GET['dos'];
$fecha = date(" Y-m-d ");

if(!empty($id && ($_SESSION['rol']=="1"||$_SESSION['rol']=="666"))){
  $database = new Database();
  $db = $database->getConnection();
  $user = new User($db);

  $tareamodificada = new Ticket($db);

  if($type==1){//Validar
    $tareamodificada->validarTarea($idtarea);
  }
  if($type==2){//Finalizar
    $tareamodificada->resolverTarea($idtarea,$fecha);
  }
}

header("Location: workflowpaginaprincipal.php?id=".$id);

?>
