<?php
include_once 'database.php';
class Ticket{
    private $conn;
    private $database;
    private $table_name = "tareas";

    // object properties
    public $id;
    public $Prioridad;
    public $Fechaestimada;
    public $Fechaoficial;
    public $Descripción;
    public $Id_usuario;
    public $Tipo;
    public $Estado;
    public $Fechadecreacion=null;
    //////

    public $Demora=NULL;
    public $Creadopor=NULL;
    public $IP=NULL;
    public $Persona=NULL;
    public $NombreTarea;
    public function __construct($db)
    {
        $this->conn = $db;
        $this->database= new Database();
        $this->Fechadecreacion=date('Y-m-d H:i:s');
        $this->Demora=date('Y-m-d H:i:s');
    }
    public function crearTarea(){
        $sql = "INSERT into Tareas VALUES (null, '$this->Prioridad', '$this->Fechaestimada','$this->Fechaoficial','$this->Descripción','$this->Id_usuario',
          '$this->Tipo','$this->Demora','$this->Creadopor','$this->IP','$this->Fechadecreacion','$this->Estado','$this->Persona','$this->$NombreTarea');";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
    public function validarTarea($idtarea)
    {
        $sql = "UPDATE Tareas SET Estado='1' where id_tareas='$idtarea';";
        // echo $sql;
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
    public function comprobarDateTarea()
    {
        $sql= "SELECT * from Tareas;";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($fila=$result->fetch()) {
            $date1 = date('Y-m-d');
            $dumbdate=$fila['Fecha oficial'];
            echo "<br>".$dumbdate." ".$date1."<br>";
            echo $dumbdate<$date1;
            if ($dumbdate<$date1==1) {
                $dumbvar=$fila['id_tareas'];

                $sqlup = "UPDATE $this->table_name SET Estado='3' WHERE id_tareas='$dumbvar';";

                $resultup = $this->conn->query($sqlup);
                $resultup->setFetchMode(PDO::FETCH_ASSOC);
            }
        }
    }
    public function resolverTarea($idtarea)
    {
        $sql = "UPDATE Tareas SET Estado='2' where id_tareas='$idtarea';";
        // echo $sql;
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
}
