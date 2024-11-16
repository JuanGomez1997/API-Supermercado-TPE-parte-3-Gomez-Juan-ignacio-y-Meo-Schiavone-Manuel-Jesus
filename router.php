<?php 
    require_once './app/controlador/controladorProveedores.php';
    require_once './app/controlador/controladorUsuario.php';
    require_once './app/controlador/controladorProductos.php';
    require_once './app/helpers/helperAut.php';
    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

    $accion = 'inicio'; 
    if (!empty($_GET['accion'])) {
        $accion = $_GET['accion'];
    }
    $params = explode('/', $accion);
    
    switch ($params[0]) {
        
        case 'inicio':
            $ControladorProducto=new ControladorProductos;
            $ControladorProducto->listarProductos();
        break;
        
        case 'iniciosesion':
            $ControladorUsuario=new ControladorUsuario;
            $ControladorUsuario->ingreso();
            break;
        case 'accesoSesion':
            $ControladorUsuario=new ControladorUsuario;
            $ControladorUsuario->accesoSesion();
            break;
        case 'cerrarsesion':
            $ControladorUsuario = new ControladorUsuario;
            $ControladorUsuario->cerrarSesion();
            break;
        case 'proveedores':
            $ControladorProveedor=new ControladorProveedores;
            $ControladorProveedor->listarProveedores();
            break;
        case 'proveedoresporid':
            $ControladorProveedor=new ControladorProveedores;
            $ControladorProveedor->listarProveedoresPorID($params[1]);
            break;
        case 'agregarproveedor':
            $ControladorProveedor=new ControladorProveedores;
            $ControladorProveedor->añadirProveedor();
            break;
        case 'editarproveedor':
            $ControladorProveedor=new ControladorProveedores;
            $ControladorProveedor->editarProveedor($params[1]);
            break;
        case 'eliminarproveedor':
            $ControladorProveedor=new ControladorProveedores;
            $ControladorProveedor->eliminarProveedor($params[1]);
            break;
        
        case 'agregarproducto': 
            $ControladorProducto=new ControladorProductos;
            $ControladorProducto->añadirProducto();
            break;
        case 'eliminarproducto':
             $ControladorProducto=new ControladorProductos;
             $ControladorProducto->borrarProducto($params[1]);
            break;
        case 'productosporid':
                $ControladorProducto=new ControladorProductos;
                $ControladorProducto->verProducto($params[1]);
            break;    
        case 'editarproducto':
                $ControladorProducto=new ControladorProductos;
                $ControladorProducto->editarProducto($params[1]);
            break;
        default:
         $ControladorUsuario=new ControladorUsuario;
            $ControladorUsuario->mostrar404();
            break;
    }