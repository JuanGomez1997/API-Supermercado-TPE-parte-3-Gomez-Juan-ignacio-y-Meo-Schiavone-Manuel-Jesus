<?php

    require_once './database/config.php';

    function codificarBase64Url($datos){ // Para codificar en base64
        return rtrim(strtr(base64_encode($datos), '+/', '-_'), '=');
    }

    class AuthHelper {

        public function obtenerEncabezadosAuth() {
            $encabezado = "";

            if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
                $encabezado = $_SERVER['HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $encabezado = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            }
            
            return $encabezado;
        }

        public function crearToken($datos){

            $encabezado = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );

            $encabezado = codificarBase64Url(json_encode($encabezado)); 
            $datos = codificarBase64Url(json_encode($datos));

            $firma = hash_hmac('SHA256', "$encabezado.$datos", JWT_KEY, true);
            $firma = codificarBase64Url($firma);

            $token = "$encabezado.$datos.$firma";

            return $token; 
        }

        public function verificarToken($token){
           

            $partesToken = explode(".", $token);

            $encabezado = $partesToken[0];
            $datos = $partesToken[1];
            $firma = $partesToken[2];
        
            $nuevaFirma = hash_hmac('SHA256', "$encabezado.$datos", JWT_KEY, true);
            $nuevaFirma = codificarBase64Url($nuevaFirma);
        
            if ($firma != $nuevaFirma) {
                return false; 
            }
        
            $datos = json_decode(base64_decode($datos));
            return $datos; 
        }

        public function usuarioActual(){
            $auth = $this->obtenerEncabezadosAuth();
            $auth = explode(" ", $auth);
            

            if ($auth[0] != "Bearer") {
                return false; 
            }

            return $this->verificarToken($auth[1]); 
        }
    }