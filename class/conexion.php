<?php
    class ApptivaDB{
        private $host = "localhost";
        private $usuario = "root";
        private $clave = "";
        private $db = "qr_bpersona";
        public $con;
        public function __construct(){
            $this->con = new mysqli($this->host, $this->usuario,$this->clave,$this->db)
            or die(mysqli_error("No se puede conectar"));
        }
        ////INSERTAR  ->cuando es autoincrement va asi: VALUES(null,$datos)
        public function insertar($tabla, $datos){
            $resultado=$this->con->query("INSERT INTO $tabla VALUES(null,$datos)") or die($this->con);
            if($resultado)
                return true;
            return false;
        }
        //BORRAR
        public function borrar($tabla,$condicion){
            $resultado=$this->con->query("DELETE FROM $tabla WHERE $condicion") or die($this->con->error);
            if($resultado)
                return true;
            return false;
        }
        ///ACTUALIZAR
        public function actualizar($tabla,$campos,$condicion){
            $resultado=$this->con->query("UPDATE $tabla SET $campos WHERE $condicion") or die($this->con->error);
            if($resultado)
                return true;
            return false;
        }
        ///BUSCAR
        public function buscar($tabla,$condicion){
            $resultado=$this->con->query("SELECT * FROM $tabla WHERE $condicion") or die($this->con->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }
        
        
    }
   


?>