<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('System')
            ->addPermission('platform.goods.list', 'Goods')
            ->addPermission('platform.goods.create', 'Goods create')
            ->addPermission('platform.goods.edit', 'Goods edit')
            ->addPermission('platform.goodTypes.list', 'GoodTypes')
            ->addPermission('platform.goodTypes.create', 'GoodTypes create')
            ->addPermission('platform.goodTypes.edit', 'GoodTypes edit')
        ;

        $dashboard->registerPermissions($permissions);
    }
}
