<?php
    require_once './app/modelo/modeloUsuario.php';
    require_once './app/helpers/api-helperaut.php';
    require_once './app/controlador/controladorApi.php';
    class ControladorUsuarioApi extends ControladorApi{
        private $modelo;
        private $authHelper;

        public function __construct(){
            parent::__construct();
            $this->modelo=new ModeloUsuario();
            $this->authHelper=new AuthHelper();
        }


        public function Token($params = []){
            $basic = $this->authHelper->obtenerEncabezadosAuth(); 
    
            if(empty($basic)){
                $this->vista->respuesta('No envió encabezados de autenticación', 401);
                return;
            }
    
            $basic = explode(" ", $basic); 
    
            if($basic[0]!="Basic"){
                $this->vista->respuesta('Los encabezados de autenticación son incorrectos', 401);
                return;
            }
    
            $userpass = base64_decode($basic[1]); 
            $userpass = explode(":", $userpass); 
    
            $user = $userpass[0];
            $pass = $userpass[1];
    
            $data = $this->modelo->obtenerNombre($user);
    
            if($data && $user == $data->nombre && password_verify($pass, $data->contrasenia)){
                $token = $this->authHelper->crearToken($data);
                $this->vista->respuesta($token, 200);
            } else {
                $this->vista->respuesta('El usuario o contraseña son incorrectos.', 401);
            }
        }
       
    }