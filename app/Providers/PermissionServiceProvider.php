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
            ->addPermission('platform.items.list', 'Items')
            ->addPermission('platform.items.create', 'Items create')
            ->addPermission('platform.items.edit', 'Items edit')
            ->addPermission('platform.orders.list', 'Orders')
            ->addPermission('platform.orders.create', 'Orders create')
            ->addPermission('platform.orders.edit', 'Orders edit')
        ;

        $dashboard->registerPermissions($permissions);
    }
}
