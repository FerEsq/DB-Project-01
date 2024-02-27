<?php
namespace Database\Seeders;

use Csgt\Cancerbero\CsgtModule;

// new CsgtModule($aName, $aDescription, $aModule, $aMenuOrder, [$aIcon=null, $aParentModule=null, $aPermissions=CsgtModule::ALL, $aMenuPermission = 1])

class Sections
{
    public function get()
    {
        return collect([
            new CsgtModule('Home', 'Home', 'index', 1000, 'fa fa-home', null, CsgtModule::INDEX),
            new CsgtModule('Catalogs', '', 'catalogs', 2000, 'fa fa-book', null, []),
            new CsgtModule('Users', 'Catalogs - Users', 'catalogs.users', 100, 'fa fa-users', 'catalogs'),
            new CsgtModule('Roles', 'Catalogs - Roles', 'catalogs.roles', 200, 'fa fa-key', 'catalogs'),
            new CsgtModule('Horarios', '', 'horarios', 3000, 'fa fa-list', null, []),
            new CsgtModule('Todos los horarios', 'Horarios - Todos', 'horarios.todos', 100, 'fa fa-star', 'horarios'),
            new CsgtModule('Todos los salones', 'Horarios - Salones', 'horarios.salones', 100, 'fa fa-star', 'horarios'),
        ]);
    }
}
