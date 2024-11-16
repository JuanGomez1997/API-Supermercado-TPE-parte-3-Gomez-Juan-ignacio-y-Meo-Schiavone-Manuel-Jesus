<?php
    require_once 'modelo.php';
    class ModeloProductos extends Modelo{
        protected $db;


        public function obtenerProductos(){
            $query=$this->db->prepare("SELECT * FROM productos");
            $query->execute();
            $proveedores=$query->fetchAll(PDO::FETCH_OBJ);
            return $proveedores;
        }
        //obtengo los productos por ID
        public function obtenerProductosId($id){
            $query=$this->db->prepare("SELECT * FROM productos JOIN proveedores ON productos.proveedor_id=proveedores.id_proveedor WHERE productos.id_producto=?");
            $query->execute([$id]);
            $productos=$query->fetchALL(PDO::FETCH_OBJ);
            return $productos;
        }
        //obtengo producto por proveedor
        public function obtenerProductosPorProveedorId($proveedor_id) {
            $query = $this->db->prepare("SELECT * FROM productos WHERE proveedor_id = ?");
            $query->execute([$proveedor_id]);
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        // agregar productos
        public function agregarProducto($producto , $precio , $categoria , $fecha_vencimiento , $marca , $proveedor_id){
            $query=$this->db->prepare('INSERT INTO productos(producto , precio , categoria , fecha_vencimiento , marca , proveedor_id) VALUES (?,?,?,?,?,?)');
            $query->execute([$producto , $precio , $categoria , $fecha_vencimiento , $marca , $proveedor_id]);
            return $this->db->lastInsertId();
        }
        // actualizar productos
        public function actualizarProducto( $productos , $precio , $categoria , $fecha_vencimiento , $marca , $proveedor_id , $id_producto){
            $query=$this->db->prepare('UPDATE productos SET producto=?, precio=?, categoria=?, fecha_vencimiento=?, marca=?, proveedor_id=? WHERE productos.id_producto=?');
            $query->execute([ $productos , $precio , $categoria , $fecha_vencimiento , $marca , $proveedor_id , $id_producto]);
        }
        // eliminar productos
        public function eliminarProducto($id_producto){
            $query=$this->db->prepare('DELETE FROM productos WHERE id_producto=?');
            $query->execute([$id_producto]);
        }

    }
?>