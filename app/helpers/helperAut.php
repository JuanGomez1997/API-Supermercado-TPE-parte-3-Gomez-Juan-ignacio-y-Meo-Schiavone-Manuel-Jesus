<?php

    class AutHelper {

        public static function init() {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
        }

        public static function login($usuario) {
            AutHelper::init();
            $_SESSION['id_usuario'] = $usuario->id_usuario;
            $_SESSION['nombre'] = $usuario->nombre; 
        }

        public static function verify() {
            AutHelper::init();
            if (!isset($_SESSION['id_usuario'])) {
                header('Location: ' . BASE_URL . 'iniciosesion');
                die();
            }    
        }

        public static function logout() {
            AutHelper::init();
            session_destroy();
        }   
        
    }
?>