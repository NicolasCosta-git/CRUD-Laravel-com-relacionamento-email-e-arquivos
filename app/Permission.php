<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Spatie\Permission\Models\Permission as Permissions;

class Permission extends Permissions
{

    public static function defaultPermissions()
    {
        return [
        array('name' => 'ver_cliente'),
        array('name' => 'criar_cliente'),
        array('name' => 'editar_cliente'),
        array('name' => 'deletar_cliente'),
        array('name' => 'ver_pizza'),
        array('name' => 'criar_pizza'),
        array('name' => 'editar_pizza'),
        array('name' => 'deletar_pizza'),
        array('name' => 'ver_pedido'),
        array('name' => 'criar_pedido'),
        array('name' => 'editar_pedido'),
        array('name' => 'deletar_pedido'),
        ];
        
    }
}
