<?php
    require_once './database/config.php';
    require_once './libs/router.php';
    require_once './app/controlador/controladorProductosApi.php';


    $router = new Router();

    #                 endpoint        verbo     controller               método
    $router->addRoute('productos', 'GET',    'ControladorProductosApi', 'obtenerProductosOrdenados');
    $router->addRoute('productos/:ID', 'GET',    'ControladorProductosApi', 'obtenerProductoId');
    $router->addRoute('productos',     'POST',   'ControladorProductosApi', 'añadirProducto');
    $router->addRoute('productos/:ID', 'PUT',    'ControladorProductosApi', 'editarProducto');
    $router->addRoute('productos/marca/:MARCA', 'GET',    'ControladorProductosApi', 'filtradoPorMarca');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


    