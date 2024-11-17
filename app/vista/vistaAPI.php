<?php
    class VistaApi {
        public function respuesta ($datos, $estado = 200) {
            header('Content-type: application/json');
            header('HTTP/1.1 ' . $estado . " " . $this->_estadoSolicitud($estado));
            echo json_encode($datos);

        }

        private function _estadoSolicitud($codigo) {
            $estado = array(
                200 => "OK",
                201 => "Creado",
                400 => "Solicitud Incorrecta",
                404 => "No Encontrado",
                500 => "Error Interno del Servidor",
            );
            if(!isset($estado[$codigo])) {
                $codigo = 500;
            }
            return $estado[$codigo];

        }

    }