<?php   
    require_once './app/modelo/modeloProductos.php';
    require_once './app/vista/vistaAPI.php';
    require_once './app/controlador/controladorApi.php';

    class ControladorProductosApi extends ControladorApi{
        private $modeloProductos;
        public function __construct() {
            parent::__construct();
            $this->modeloProductos = new ModeloProductos();
            
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
    }
