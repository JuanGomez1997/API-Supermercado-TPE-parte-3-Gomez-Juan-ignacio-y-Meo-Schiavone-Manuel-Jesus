<?php   
    require_once './app/modelo/modeloProductos.php';
    require_once './app/vista/vistaAPI.php';
    require_once './app/controlador/controladorApi.php';
    require_once './app/helpers/api-helperaut.php';

    class ControladorProductosApi extends ControladorApi{
        private $modeloProductos;
        private $authHelper;
        public function __construct() {
            parent::__construct();
            $this->modeloProductos = new ModeloProductos();
            $this->authHelper=new AuthHelper();
            
        }

        public function obtenerProductosOrdenados() {
            $productos = $this->modeloProductos->obtenerProductos();
            
            if (empty($productos)) {
                return $this->vista->respuesta("No se encontraron productos", 404);
            }
            
            return $this->vista->respuesta($productos, 200);
        }


        public function obtenerProductoId($id) {
            $producto = $this->modeloProductos->obtenerProductosId($id);
        
            if (!$producto) {
                return $this->vista->respuesta("El producto con el id=$id no existe", 404);
            }
            return $this->vista->respuesta($producto,200);
        }

        public function añadirProducto(){

            

            $cuerpo = $this->obtenerDatos();
            if (!isset($cuerpo->producto) || !isset($cuerpo->precio) || !isset($cuerpo->categoria) || 
                !isset($cuerpo->fecha_vencimiento) || !isset($cuerpo->marca) || !isset($cuerpo->proveedor_id)) {
                return $this->vista->respuesta("Completa los datos", 400);
            }

            $producto = $cuerpo->producto;
            $precio = $cuerpo->precio;
            $categoria = $cuerpo->categoria;
            $fecha_vencimiento = $cuerpo->fecha_vencimiento;
            $marca = $cuerpo->marca;
            $proveedor_id = $cuerpo->proveedor_id;

            $id = $this->modeloProductos->agregarProducto($producto, $precio, $categoria, $fecha_vencimiento, $marca, $proveedor_id);

            if (!$id) {
                return $this->vista->respuesta("Error al añadir el producto", 500);
            }

            $producto = $this->modeloProductos->obtenerProductosId($id);

            return $this->vista->respuesta($producto, 201);
        }
        public function filtradoPorMarca($marca) {
            if (is_array($marca)) {
                $marca = reset($marca);
            }

            $productos = $this->modeloProductos->filtradoMarca($marca);
        
            if (empty($productos)) {
                return $this->vista->respuesta("No se encontraron productos para la marca: $marca", 404);
            }
        
            return $this->vista->respuesta($productos, 200);
        }

        public function editarProducto($id) {
            if (is_array($id)) {
                $id = reset($id); 
            }
            $productoExistente = $this->modeloProductos->obtenerProductosId($id);
            if ($productoExistente) {
                $cuerpo = $this->obtenerDatos();
                if (isset($cuerpo->producto, $cuerpo->precio, $cuerpo->categoria,$cuerpo->fecha_vencimiento, $cuerpo->marca, $cuerpo->proveedor_id)) {
                    $producto = $cuerpo->producto;
                    $precio = $cuerpo->precio;
                    $categoria = $cuerpo->categoria;
                    $fecha_vencimiento = $cuerpo->fecha_vencimiento;
                    $marca = $cuerpo->marca;
                    $proveedor_id = $cuerpo->proveedor_id;
                    $this->modeloProductos->actualizarProducto($producto, $precio, $categoria, $fecha_vencimiento, $marca, $proveedor_id, $id);
                    $this->vista->respuesta("El producto con id=$id ha sido modificado.", 200);
                } else {
                    $this->vista->respuesta("Faltan datos para modificar el producto.", 400);
                }
            } else {
                $this->vista->respuesta("El producto con id=$id no existe.", 404);
            }
        }
    }
