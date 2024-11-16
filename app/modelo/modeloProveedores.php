<?php
    require_once 'modelo.php';
    class ModeloProveedores extends Modelo{
        protected $db;

        //obtengo los proveedores
        public function obtenerProveedores(){
            $query=$this->db->prepare("SELECT * FROM proveedores");
            $query->execute();
            $proveedores=$query->fetchAll(PDO::FETCH_OBJ);
            return $proveedores;
        }

        //obtengo los proveedores por ID
        public function obtenerProveedoresId($id){
            $query=$this->db->prepare("SELECT * FROM proveedores WHERE id_proveedor=?");
            $query->execute([$id]);
            $proveedores=$query->fetchAll(PDO::FETCH_OBJ);
            return $proveedores;
        }

        //añade un proveedor
        public function agregarProveedor($nombre){
            $query=$this->db->prepare('INSERT INTO proveedores(nombre) VALUES (?)');
            $query->execute([$nombre]);
            return $this->db->lastInsertId();
        }

        //actualiza un proveedor
        public function actualizarProveedor($nombre,$id){
            $query=$this->db->prepare('UPDATE proveedores SET nombre=? WHERE proveedores.id_proveedor=?');
            $query->execute([$nombre,$id]);
        }

        //elimina proveedores
        public function eliminarProveedor($id){
            $query=$this->db->prepare('DELETE FROM proveedores WHERE id_proveedor=?');
            $query->execute([$id]);
        }
    }
?>