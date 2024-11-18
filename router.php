<?php
    require_once './database/config.php';
    require_once './libs/router.php';
    require_once './app/controlador/controladorProductosApi.php';


    $router = new Router();

    #                 endpoint        verbo     controller               método
    $router->addRoute('productos',     'POST',   'ControladorProductosApi', 'añadirProducto');
    $router->addRoute('productos/:ID', 'GET',    'ControladorProductosApi', 'obtenerProductoId');
    $router->addRoute('productos/marca/:MARCA', 'GET',    'ControladorProductosApi', 'filtradoPorMarca');
    //$router->addRoute('productos/categoria/:CATEGORIA', 'GET',    'ControladorProductosApi', 'filtradoPorCategoria');
    

    
 
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
    //preguntar a chat gpt
    //con el paso 1:como seria para ver el producto con id=8 con ese .htacces

    