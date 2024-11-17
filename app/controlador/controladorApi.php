<?php
    require_once './app/vista/vistaAPI.php';
    
    abstract class ControladorApi {
        protected $vista;
        private $dato;
        
        function __construct() {
            $this->vista = new VistaApi();
            $this->dato = file_get_contents('php://input');
        }

        function obtenerDatos() {
            return json_decode($this->dato);
        }
    }
?>