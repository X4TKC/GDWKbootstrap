<html>

<head>
    <title>Gestor de documentos página principal</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <?php

include_once '../clases/database.php';
include_once '../clases/user.php';
include_once '../clases/documento.php';
include_once '../clases/ticket.php';
session_start();
$database = new Database();
$db = $database->getConnection();
$id=$_GET['id'];
$user = new User($db);
$sql = 'SELECT * from Usuarios;';
$result = $db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

$creartarea = new Ticket($db);

if(!empty($id) && !empty($_SESSION['id']) && $_SESSION['id']==$id){

$creartarea->Prioridad = !empty($_POST['selectprioridad']) ? $_POST['selectprioridad'] : $creartarea->Prioridad;
$creartarea->Fechaestimada= !empty($_POST['fechauno']) ? $_POST['fechauno'] : $creartarea->Fechaestimada;
$creartarea->Fechaoficial= !empty($_POST['fechados']) ? $_POST['fechados'] : $creartarea->Fechaoficial;
$creartarea->Descripcion = !empty($_POST['descripciontarea']) ? $_POST['descripciontarea'] : $creartarea->Descripcion;
$creartarea->Id_usuario = $id;
$creartarea->Creadopor = $_SESSION['rol'];
$creartarea->Tipo = !empty($_POST['selecttarea']) ? $_POST['selecttarea'] : $creartarea->Tipo;
$creartarea->Fechadecreacion = date(" Y-m-d ");
$creartarea->NombreTarea= !empty($_POST['nombretarea']) ? $_POST['nombretarea'] : $creartarea->NombreTarea;


if(!empty($creartarea->Prioridad)){
  $creartarea->crearTarea();

  if($_SESSION['rol']=="1"||$_SESSION['rol']=="666"){
    header("Location: workflowpaginaprincipal.php?id=".$id);
  }else {
    header("Location: ../paginaprincipal.php?id=".$id);
  }


}
    ?>

        <header class="header">

            <nav class="navbar navbar-style">
                <div class="container">
                    <div class="navbar-header ">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="../paginaprincipal.php?id=<?php echo $id;?>"> <img class="logo" src="../images/logo.png"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="micon">
                        <ul class="nav navbar-nav navbar-right">

                          <?php if($_SESSION['rol']=="1"||$_SESSION['rol']=="666"){ ?>

                            <li><a href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">Workflow</a></li>

                        <?php } ?>

                          <li><a href="../paginaprincipal.php?id=<?php echo $id;?>">Página principal</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <p class="big-text">Crear tarea</p>
                </div>
            </div>
            <form method="post">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 banner-info">
                            <p>Tarea</p>
                            <select class="form-control" name="selecttarea">
                                <option value=1 selected> Reunión para documento </option>
                                <option value=2> Solicitud de actualización de proceso </option>
                                <option value=3> Solicitud de nuevo proceso </option>
                                <option value=4> Interpretación de normas y procesos </option>
                                <option value=5> Consulta </option>
                            </select>
                            <p>
                                <br>Fecha estimada de inicio</p>

                                <input type="date" name="fechauno" class="form-control" min="<?php echo date(" Y-m-d ") ?>" max="<?php $d=strtotime(" +12 Months "); echo date("Y-m-d ",$d) ?>" required>

                        </div>
                        <div class="col-sm-6 banner-image">
                            <p>Prioridad</p>
                            <select class="form-control" name="selectprioridad">
                                <option value=1>Alta</option>
                                <option value=2 selected>Baja</option>
                            </select>
                            <p>
                                <br>Fecha estimada fin</p>

                                <input type="date" name="fechados" class="form-control" min="<?php echo date(" Y-m-d ") ?>" max="<?php $d=strtotime(" +12 Months "); echo date("Y-m-d ",$d) ?>" required>

                        </div>

                        <div class="col-sm-6 banner-image">
                            <p>Nombre de la tarea</p>

                            <input type="text" class="form-control" name="nombretarea" required>

                            <br>
                        </div>

                        <div class="form-group">
                            <label for="inputlg">
                                <br>
                                <br>
                                <br>
                            </label>
                                <textarea class="form-control input-lg" name="descripciontarea" rows="10" cols="30" placeholder="Descripción" required></textarea>
                                <br>
                        </div>

                        <?php if($_SESSION['rol']=="1"||$_SESSION['rol']=="666"){ ?>

                          <a class="btn btn-first" href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">Cancelar</a>

                      <?php }else { ?>

                          <a class="btn btn-first" href="../paginaprincipal.php?id=<?php echo $id;?>">Cancelar</a>

                      <?php } ?>

                        <button type="submit" class="button"> Crear </button>

                    </div>
                </div>
            </form>
        </header>
        <?php
    } else {
        echo "You don't have permission to acces this page.";
    }
     ?>
</body>

</html>
