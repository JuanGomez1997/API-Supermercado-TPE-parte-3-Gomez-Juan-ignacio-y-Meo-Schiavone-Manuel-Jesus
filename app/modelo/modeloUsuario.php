<?php

    require_once "modelo.php";

    class ModeloUsuario extends Modelo {
        protected $db;

        function obtenerNombre($nombre) {
            $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre = ?');
            $query->execute([$nombre]);

            return $query->fetch(PDO::FETCH_OBJ);
        }

    }
?>