<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Good\GoodEditScreen;
use App\Orchid\Screens\Good\GoodListScreen;
use App\Orchid\Screens\GoodType\GoodTypeEditScreen;
use App\Orchid\Screens\GoodType\GoodTypeListScreen;
use App\Orchid\Screens\Item\ItemEditScreen;
use App\Orchid\Screens\Item\ItemListScreen;
use App\Orchid\Screens\Order\OrderEditScreen;
use App\Orchid\Screens\Order\OrderListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Platform > System > Goods > Good
Route::screen('goods/{good}/edit', GoodEditScreen::class)
    ->name('platform.goods.edit')
    ->breadcrumbs(fn (Trail $trail, $good) => $trail
        ->parent('platform.goods.list')
        ->push($good->name, route('platform.goods.edit', $good)));

// Platform > System > Goods > Create
Route::screen('goods/create', GoodEditScreen::class)
    ->name('platform.goods.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.goods.list')
        ->push(__('Create'), route('platform.goods.create')));

// Platform > System > Goods
Route::screen('goods', GoodListScreen::class)
    ->name('platform.goods.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Goods'), route('platform.goods.list')));

// Platform > System > GoodTypes > GoodType
Route::screen('good-types/{goodType}/edit', GoodTypeEditScreen::class)
    ->name('platform.goodTypes.edit')
    ->breadcrumbs(fn (Trail $trail, $goodType) => $trail
        ->parent('platform.goodTypes.list')
        ->push($goodType->name, route('platform.goodTypes.edit', $goodType)));

// Platform > System > GoodTypes > Create
Route::screen('good-types/create', GoodTypeEditScreen::class)
    ->name('platform.goodTypes.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.goodTypes.list')
        ->push(__('Create'), route('platform.goodTypes.create')));

// Platform > System > Goods
Route::screen('good-types', GoodTypeListScreen::class)
    ->name('platform.goodTypes.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('GoodTypes'), route('platform.goodTypes.list')));

// Platform > System > Items > Item
Route::screen('items/{item}/edit', ItemEditScreen::class)
    ->name('platform.items.edit')
    ->breadcrumbs(fn (Trail $trail, $item) => $trail
        ->parent('platform.items.list')
        ->push($item->good->name, route('platform.items.edit', $item)));

// Platform > System > Items > Item
Route::screen('items/create', ItemEditScreen::class)
    ->name('platform.items.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.items.list')
        ->push(__('Create'), route('platform.items.create')));

// Platform > System > Items
Route::screen('items', ItemListScreen::class)
    ->name('platform.items.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Items'), route('platform.items.list')));

// Platform > System > Orders > Item
Route::screen('orders/{order}/edit', OrderEditScreen::class)
    ->name('platform.orders.edit')
    ->breadcrumbs(fn (Trail $trail, $order) => $trail
        ->parent('platform.orders.list')
        ->push($order->item->good->name, route('platform.orders.edit', $order)));

// Platform > System > Orders > Item
Route::screen('orders/create', OrderEditScreen::class)
    ->name('platform.orders.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.orders.list')
        ->push(__('Create'), route('platform.orders.create')));

// Platform > System > Orders
Route::screen('orders', OrderListScreen::class)
    ->name('platform.orders.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Orders'), route('platform.orders.list')));
