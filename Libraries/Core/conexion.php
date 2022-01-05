<?php
    
    class Conexion{
        private $conect;

        public function __construct(){

            $connectionString = "sqlsrv:Server=".DB_HOST.";DATABASE=".DB_NAME;
            try{
                $this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
                $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                $this->conect = 'Error de conexión';
                echo "Error: ".$e->getMessage();
            }
        }

        public function conect(){
            return $this->conect;
        }
    }

?>