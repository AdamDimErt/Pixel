<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(Dashboard $dashboard)
    {
        $goodsPermissions = ItemPermission::group('Goods')
            ->addPermission('platform.goods.list', 'Goods')
            ->addPermission('platform.goods.create', 'Goods create')
            ->addPermission('platform.goods.edit', 'Goods edit');
        $goodTypesPermissions = ItemPermission::group('GoodTypes')
            ->addPermission('platform.goodTypes.list', 'GoodTypes')
            ->addPermission('platform.goodTypes.create', 'GoodTypes create')
            ->addPermission('platform.goodTypes.edit', 'GoodTypes edit');
        $itemsPermissions = ItemPermission::group('Items')
            ->addPermission('platform.items.list', 'Items')
            ->addPermission('platform.items.create', 'Items create')
            ->addPermission('platform.items.edit', 'Items edit');
        $ordersPermissions = ItemPermission::group('Orders')
            ->addPermission('platform.orders.list', 'Orders')
            ->addPermission('platform.orders.create', 'Orders create')
            ->addPermission('platform.orders.edit', 'Orders edit');

        $dashboard->registerPermissions($goodsPermissions);
        $dashboard->registerPermissions($goodTypesPermissions);
        $dashboard->registerPermissions($itemsPermissions);
        $dashboard->registerPermissions($ordersPermissions);
    }
}
