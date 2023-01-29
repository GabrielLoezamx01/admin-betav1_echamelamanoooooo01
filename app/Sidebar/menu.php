<?php
namespace App\Sidebar;
class Menu {
    static public function menu(){
        return [
            [
                'name' => 'Categoría',
                'icon' => '',
                'list' => [
                    'Categoría'     => 'link',
                    'Sub Categoría' => 'link'
                ],
            ],
            [
                'name' => 'Usuarios',
                'icon' => '',
                'list' => [
                    'Lista'   => 'link',
                    'Ajustes' => 'link'
                ]
            ]
        ];
    }
}
