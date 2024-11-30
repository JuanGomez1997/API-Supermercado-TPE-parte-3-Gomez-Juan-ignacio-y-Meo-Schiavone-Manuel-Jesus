API Supermercado

Endpoint:

Lista de Productos Ordenados:
-/api/productos --> Metodo GET lista todos los productos ordenados Ascendentemente 

Mostrar Producto:
-/api/productos/:ID --> Metodo GET muestra el productor por ID

Filtro Por Marca:
-api/productos/marca/:MARCA --> Metodo GET filtra los productos por la Marca Ascendentemente

Autentificacion:
-api/usuario/token --> Metodo GET permite que el usuario se loguee a travez de Basic Auth, con el usuario "webadmin" y la contraseña "admin". Si no esta logueado no se puede editar ni agregar productos

Agregar Producto:
-api/productos --> Metodo POST para agregar producto, se tiene que estar logueado para poder ingresarlo, el ejemplo de como agregar es el siguente:
{
    "producto": "Shampoo Manzana Natural",
        "precio": "600.65",
        "categoria": "Higiene",
        "fecha_vencimiento": "2029-12-20",
        "marca": "Avonl",
        "proveedor_id": 2
}

Editar Producto:
-api/productos/:ID --> Metodo PUT para editar prodcutos existentes, se tiene que estar logueado para poder ingresarlo, el ejemplo de como editar es el siguente:

{
    "producto": "Shampoo Manzana Natural",
        "precio": "600.65",
        "categoria": "Higiene",
        "fecha_vencimiento": "2029-12-20",
        "marca": "Avonl",
        "proveedor_id": 4
}

