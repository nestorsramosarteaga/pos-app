<?php

return [
    'brand' => 'Sistema Ventas',
    'welcome' => 'Bienvenido',
    'menus' => [
        'core' => 'Inicio',
        'dashboard' => 'Panel',
        'settings' => 'Configuraciones',
        'activity_log' => 'Registro de actividades',
        'logout' => 'Cerrar Sesión',
        'layouts' => 'Layouts',
        'pages' => 'Páginas',
        'modules' => 'Módulos',
        'categories' => 'Categorias',
        'table' => 'Tabla',
        'brands' => 'Marcas',
        'presentations' => 'Presentaciones',
        'products' => 'Productos',
        'customers' => 'Clientes',
    ],
    'categories' => [
        'table' => 'Tabla Categorias',
        'create' => 'Crear Categoría',
        'created_success' => 'Categoría creada exitosamente',
        'create_error' => 'La Categoria no pudo ser creada',
        'edit' => 'Editar Categoría',
        'updated_success' => 'Categoría actualizada exitosamente',
        'deleted_success' => 'Categoría eliminada exitosamente',
        'restored_success' => 'Categoría restaurada exitosamente',
    ],
    'brands' => [
        'table' => 'Tabla Marcas',
        'create' => 'Crear Marca',
        'created_success' => 'Marca creada exitosamente',
        'create_error' => 'La Marca no pudo ser creada',
        'edit' => 'Editar Marca',
        'updated_success' => 'Marca actualizada exitosamente',
        'deleted_success' => 'Marca eliminada exitosamente',
        'restored_success' => 'Marca restaurada exitosamente',
    ],
    'presentations' => [
        'table' => 'Tabla Presentaciones',
        'create' => 'Crear Presentación',
        'created_success' => 'Presentación creada exitosamente',
        'create_error' => 'La Presentación no pudo ser creada',
        'edit' => 'Editar Presentación',
        'updated_success' => 'Presentación actualizada exitosamente',
        'deleted_success' => 'Presentación eliminada exitosamente',
        'restored_success' => 'Presentación restaurada exitosamente',
    ],
    'products' => [
        'table' => 'Tabla Productos',
        'create' => 'Crear Producto',
        'created_success' => 'Producto creado exitosamente',
        'create_error' => 'El Producto no pudo ser creado',
        'edit' => 'Editar Producto',
        'updated_success' => 'Producto actualizado exitosamente',
        'updated_error' => 'El Producto no pudo ser actualizado',
        'deleted_success' => 'Producto eliminado exitosamente',
        'restored_success' => 'Producto restaurado exitosamente',
    ],
    'customers' => [
        'table' => 'Tabla Clientes',
        'create' => 'Crear Cliente',
        'created_success' => 'Cliente creado exitosamente',
        'create_error' => 'El Cliente no pudo ser creado',
        'edit' => 'Editar Cliente',
        'updated_success' => 'Cliente actualizado exitosamente',
        'deleted_success' => 'Cliente eliminado exitosamente',
        'restored_success' => 'Cliente restaurado exitosamente',
    ],
    'buttons' => [
        'search' => 'Buscar...',
        'add_new_record' => 'Agregar nuevo registro',
        'save' => 'Guardar',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'update' => 'Actualizar',
        'reset' => 'Reiniciar',
        'close' => 'Cerrar',
        'continue' => 'Continuar',
        'understood' => 'Entendido',
        'confirm' => 'Confirmar',
        'restore' => 'Restaurar',
        'view' => 'Ver',
    ],
    'forms' => [
        'fields' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'code' => 'Código',
            'expiry_date' => 'Fecha de vencimiento',
            'img_path' => 'Imagen',
            'brand' => 'Marca',
            'presentation' => 'Presentación',
            'option' => [
                'select_one' => 'Por favor seleccione una opción',
                'natural_person' => 'Persona natural',
                'legal_person' => 'Persona jurídica',
            ],
            'categories' => 'Categorias',
            'required' => [
                'code' => 'El código es necesario',
            ],
            'none' => 'No tiene',
            'stock' => 'Stock',
            'client_type' => 'Tipo de cliente',
            'full_name' => 'Nombres y Apellidos',
            'company_name' => 'Razón Social',
            'address' => 'Dirección',
            'document_type' => 'Tipo de documento',
            'number_id' => 'Número de documento',
            'document' => 'Documento',
        ],
        'results'   => [
            'success' => 'Operación exitosa',
        ],
    ],
    'columns' => [
        'actions' => 'Acciones',
        'status' => 'Estado'
    ],
    'modals' => [
        'confirmation_message_title' => 'Mensaje de Confirmación',
        'confirmation_message_delete_category' => '¿Seguro que quieres eliminar la categoría?',
        'confirmation_message_restore_category' => '¿Seguro que quieres restaurar la categoría?',
        'confirmation_message_delete_brand' => '¿Seguro que quieres eliminar la marca?',
        'confirmation_message_restore_brand' => '¿Seguro que quieres restaurar la marca?',
        'confirmation_message_delete_presentation' => '¿Seguro que quieres eliminar la presentación?',
        'confirmation_message_restore_presentation' => '¿Seguro que quieres restaurar la presentación?',
        'confirmation_message_delete_product' => '¿Seguro que quieres eliminar el producto?',
        'confirmation_message_restore_product' => '¿Seguro que quieres restaurar el producto?',
        'title_product_details' => 'Detalles del Producto',
        'confirmation_message_delete_customer' => '¿Seguro que quieres eliminar el cliente?',
        'confirmation_message_restore_customer' => '¿Seguro que quieres restaurar el cliente?',
    ],
    'status' => [
        'active' => 'Activo',
        'inactive' => 'Inactivo',
        'deleted' => 'Eliminado',
    ],
];