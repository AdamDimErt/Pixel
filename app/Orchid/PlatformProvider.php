<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Get Started')
                ->icon('bs.book')
                ->title('Navigation')
                ->route(config('platform.index')),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make(__('Goods'))
                ->icon('bs.box')
                ->route('platform.goods.list')
                ->permission('platform.goods.list'),

            Menu::make(__('GoodTypes'))
                ->icon('bs.type')
                ->route('platform.goodTypes.list')
                ->permission('platform.goodTypes.list'),

            Menu::make(__('Items'))
                ->icon('bs.archive')
                ->route('platform.items.list')
                ->permission('platform.items.list'),

            Menu::make(__('Orders'))
                ->icon('bs.coin')
                ->route('platform.orders.list')
                ->permission('platform.orders.list'),

            Menu::make(__('Clients'))
                ->icon('bs.file-earmark-person')
                ->route('platform.clients.list')
                ->permission('platform.clients.list'),

            Menu::make(__('Additionals'))
                ->icon('bs.plus-circle-fill')
                ->route('platform.additionals.list')
                ->permission('platform.additionals.list'),

        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
