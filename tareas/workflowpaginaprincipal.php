<html>

<head>
    <title>Gestor de documentos pagina principal</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
  session_start();
  $database = new Database();
  $db = $database->getConnection();
  $user = new User($db);
  $sql = 'select * from usuarios;';
  $result = $db->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $tareaCero = new Database($db);//Por Validar
  $sqlTareaCero = "select * from tareas where estado='0';";
  $resultTareaCero = $db->query($sqlTareaCero);
  $resultTareaCero->setFetchMode(PDO::FETCH_ASSOC);
  $tareaUno = new Database($db);//En Ejecucion
  $sqlTareaUno = "select * from tareas where estado='1';";
  $resultTareaUno = $db->query($sqlTareaUno);
  $resultTareaUno->setFetchMode(PDO::FETCH_ASSOC);
  $tareaDos = new Database($db);//Terminada
  $sqlTareaDos = "select * from tareas where estado='2';";
  $resultTareaDos = $db->query($sqlTareaDos);
  $resultTareaDos->setFetchMode(PDO::FETCH_ASSOC);
  $tareaTres = new Database($db);//Retrasada
  $sqlTareaTres = "select * from tareas where estado='3';";
  $resultTareaTres = $db->query($sqlTareaTres);
  $resultTareaTres->setFetchMode(PDO::FETCH_ASSOC);
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
                        <a href=""> <img class="logo" src="../images/logo.png"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="micon">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="">Login</a></li>
                            <li><a href="">WorkFlow</a></li>
                            <li><a href="">Añadir Documento</a></li>
                            <li><a href="">Modificar Documento</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <p class="big-text">WorkFlow</p>
                </div>
            </div>
            <div class="container">
                <a href="../tareas/WorkflowCreacionDeTarea.php">
                    <button type="submit" class="button">Crear Tarea</button>
                </a>
            </div>

            <div class="container" style="width:1450px;">
                <div class="row">
                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">Pendiente de Validación</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:powderblue;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70%">Nombre</th>
                                    <th style="width: 15%"></th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>

                            <tbody class="thead-dark">
                                <?php
                           while ($filaCero = $resultTareaCero->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php" value="<?php echo $filaCero['id_tareas']; ?>">
                                                <?php echo $filaCero['nombre_tarea']; ?>
                                            </a>
                                        </td>

                                        <td align="center">
                                            <a href="../tareas/WorkflowValidacionDeTarea.php">
                                      <button type="submit" value="<?php echo $filaCero['id_tareas']; ?>" > Validar </button>
                                      </a>
                                        </td>

                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php">
                                    <button type="submit" value="<?php echo $filaCero['id_tareas']; ?>" > Modificar </button>
                                  </a>
                                        </td>
                                    </tr>
                                    <?php
                             } ?>
                            </tbody>

                        </table>
                    </div>

                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">En Ejecución</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:#F7FE2E;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70%">Nombre</th>
                                    <th style="width: 15%"></th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>
                            <tbody class="thead-dark">
                                <?php
                           while ($filaUno = $resultTareaUno->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php" value="<?php echo $filaUno['id_tareas']; ?>">
                                                <?php echo $filaUno['nombre_tarea']; ?>
                                            </a>
                                        </td>

                                        <td align="center">
                                            <a href="../tareas/WorkflowVerTarea.php">
                                    <button type="submit" value="<?php echo $filaUno['id_tareas']; ?>" > Terminar </button>
                                  </a>
                                        </td>
                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php">
                                    <button type="submit" value="<?php echo $filaUno['id_tareas']; ?>" > Modificar </button>
                                  </a>
                                        </td>
                                    </tr>
                                    <?php
                             } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">Retrasados</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:#FF0000;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70%">Nombre</th>
                                    <th style="width: 15%"></th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>
                            <tbody class="thead-dark">
                                <?php
                           while ($filaTres = $resultTareaTres->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php" value="<?php echo $filaTres['id_tareas']; ?>">
                                                <?php echo $filaTres['nombre_tarea']; ?>
                                            </a>
                                        </td>

                                        <td align="center">
                                            <a href="../tareas/WorkflowVerTarea.php">
                                    <button type="submit" value="<?php echo $filaTres['id_tareas']; ?>" herf = ""> Validar </button>
                                  </a>
                                        </td>
                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php">
                                    <button type="submit" value="<?php echo $filaTres['id_tareas']; ?>" herf = ""> Modificar </button>
                                  </a>
                                        </td>
                                    </tr>
                                    <?php
                             } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">Resueltos</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:#01DF01;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 65%">Nombre</th>
                                    <th style="width: 20%">Finalizada</th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>
                            <tbody class="thead-dark">
                                <?php
                              while ($filaDos = $resultTareaDos->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php" value="<?php echo $filaDos['id_tareas']; ?>">
                                                <?php echo $filaDos['nombre_tarea']; ?>
                                            </a>
                                        </td>

                                        <td>
                                            <?php echo $filaDos['id_tareas']; ?>
                                        </td>
                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php">
                                       <button type="submit" value="<?php echo $filaDos['id_tareas']; ?>" herf = ""> Modificar </button>
                                     </a>
                                        </td>
                                    </tr>
                                    <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
            </div>
        </header>

</body>

</html>
