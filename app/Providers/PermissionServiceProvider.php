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
            ->addPermission('platform.goods.list', 'Goods view')
            ->addPermission('platform.goods.create', 'Goods create')
            ->addPermission('platform.goods.edit', 'Goods edit');
        $goodTypesPermissions = ItemPermission::group('GoodTypes')
            ->addPermission('platform.goodTypes.list', 'GoodTypes view')
            ->addPermission('platform.goodTypes.create', 'GoodTypes create')
            ->addPermission('platform.goodTypes.edit', 'GoodTypes edit');
        $itemsPermissions = ItemPermission::group('Items')
            ->addPermission('platform.items.list', 'Items view')
            ->addPermission('platform.items.create', 'Items create')
            ->addPermission('platform.items.edit', 'Items edit');
        $ordersPermissions = ItemPermission::group('Orders')
            ->addPermission('platform.orders.list', 'Orders view')
            ->addPermission('platform.orders.create', 'Orders create')
            ->addPermission('platform.orders.edit', 'Orders edit');
        $clientsPermissions = ItemPermission::group('Clients')
            ->addPermission('platform.clients.list', 'Clients view')
            ->addPermission('platform.clients.create', 'Clients create')
            ->addPermission('platform.clients.edit', 'Clients edit');
        $additionalsPermissions = ItemPermission::group('Additionals')
            ->addPermission('platform.additionals.list', 'Additionals view')
            ->addPermission('platform.additionals.create', 'Additionals create')
            ->addPermission('platform.additionals.edit', 'Additionals edit');
        $orderItemsPermissions = ItemPermission::group('OrderItems')
            ->addPermission('platform.orderItems.list', 'OrderItems view')
            ->addPermission('platform.orderItems.create', 'OrderItems create')
            ->addPermission('platform.orderItems.edit', 'OrderItems edit');

        $dashboard->registerPermissions($goodsPermissions);
        $dashboard->registerPermissions($goodTypesPermissions);
        $dashboard->registerPermissions($itemsPermissions);
        $dashboard->registerPermissions($ordersPermissions);
        $dashboard->registerPermissions($clientsPermissions);
        $dashboard->registerPermissions($additionalsPermissions);
        $dashboard->registerPermissions($orderItemsPermissions);
    }
}
