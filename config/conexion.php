<?php
    session_start();

    class Conectar {
        protected $dbh;

        protected function Conexion () {
            try {
                // LOCAL
                // Conexion
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=sg_omil","root","");
                
                // Host
                // Establecer la conexión a la base de datos
                // $servername = "localhost";
                // $db_username = "SG-OMIL";
                // $db_password = "Sg-omil-2024";
                // $database = "sg_omil";


                return $conectar;
            } catch (PDOException $e) {
                print "Error DB !: ".$e->getMessage()."<br/>";
                die();
            }
        }

        public function set_names () {
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        public function ruta () {
            // Local
            return "http://localhost/SG-OMIL/login.php";
            // host
            // return "";
        }
    }
?>