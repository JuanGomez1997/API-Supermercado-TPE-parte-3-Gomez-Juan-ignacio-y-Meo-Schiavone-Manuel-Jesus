<?php

    require_once './database/config.php';

    class Modelo {
        protected $db;
      
        public function __construct() {
          $this->db = new PDO ("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
          $this->deploy();
        }
      
        private function deploy() {
          $query = $this->db->query('SHOW TABLES');
          $tables = $query->fetchAll();
          if(count($tables) == 0) {
            $sql =<<<END
                        CREATE TABLE `productos` (
              `id_producto` int(11) NOT NULL,
              `producto` text NOT NULL,
              `precio` decimal(11,2) NOT NULL,
              `categoria` text NOT NULL,
              `fecha_vencimiento` date NOT NULL,
              `marca` text NOT NULL,
              `proveedor_id` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `productos`
            --

            INSERT INTO `productos` (`id_producto`, `producto`, `precio`, `categoria`, `fecha_vencimiento`, `marca`, `proveedor_id`) VALUES
            (1, 'Jabon Neutro', 51.00, 'higiene', '2028-10-12', 'Avon', 2),
            (2, 'Nalga', 501.00, 'Carne de vaca', '2024-10-31', 'Carnes Tandil', 1),
            (3, 'Shampoo Acme', 65.63, 'Higiene', '2032-10-07', 'Avon', 2);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `proveedores`
            --

            CREATE TABLE `proveedores` (
              `id_proveedor` int(11) NOT NULL,
              `nombre` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `proveedores`
            --

            INSERT INTO `proveedores` (`id_proveedor`, `nombre`) VALUES
            (1, 'Carnes Azul'),
            (2, 'Avon'),
            (9, 'Grido');

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `usuarios`
            --

            CREATE TABLE `usuarios` (
              `id_usuario` int(11) NOT NULL,
              `nombre` varchar(50) NOT NULL,
              `contrasenia` varchar(500) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `usuarios`
            --

            INSERT INTO `usuarios` (`id_usuario`, `nombre`, `contrasenia`) VALUES
            (1, 'webadmin', '$2b$12\$hJLzoFf1I1lT3OOPnaYfguWWYFui7lrKXYUdfbyjGJMMUuLkrRUQm'); 

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `productos`
            --
            ALTER TABLE `productos`
              ADD PRIMARY KEY (`id_producto`),
              ADD KEY `proveedor_id` (`proveedor_id`);

            --
            -- Indices de la tabla `proveedores`
            --
            ALTER TABLE `proveedores`
              ADD PRIMARY KEY (`id_proveedor`);

            --
            -- Indices de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
              ADD PRIMARY KEY (`id_usuario`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `productos`
            --
            ALTER TABLE `productos`
              MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

            --
            -- AUTO_INCREMENT de la tabla `proveedores`
            --
            ALTER TABLE `proveedores`
              MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

            --
            -- AUTO_INCREMENT de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
              MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `productos`
            --
            ALTER TABLE `productos`
              ADD CONSTRAINT `proveedor_fk` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id_proveedor`);
            COMMIT;
            END;
            $this->db->query($sql);
          }
        } // la contraseña hasheada es: $2b$12$hJLzoFf1I1lT3OOPnaYfguWWYFui7lrKXYUdfbyjGJMMUuLkrRUQm pero si no le poniaa el "\" me maracaba error
      }

 