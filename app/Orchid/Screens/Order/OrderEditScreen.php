<?php

namespace App\Orchid\Screens\Order;

use App\Models\Client;
use App\Models\Good;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class OrderEditScreen extends Screen
{
    /**
     * @var Order
     */
    public $order;

    /**
     * Query data.
     *
     * @param Order $order
     *
     * @return array
     */
    public function query(Order $order): array
    {
        return [
            'order' => $order
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->order->exists ? 'Edit order' : 'Creating a new order';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Orders";
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create order')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->order->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->order->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->order->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([

                Relation::make('items.')
                    ->fromModel(Item::class, 'id')
                    ->displayAppend('name')
                    ->help('Begin to enter a name to find an order you need')
                    ->title('Choose a item for that order'),

                Relation::make('order.user_id')
                    ->fromModel(Client::class, 'email')
                    ->help('Begin to enter a name to find an order you need')
                    ->title('Choose a item for that order'),

            ]),
        ];
    }

    /**
     * @param Order $order
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Order $order, Request $request)
    {
        $order->fill($request->get('order'))->save();

        Alert::info('You have successfully created a post.');

        return redirect()->route('platform.orders.list');
    }

    /**
     * @param Order $order
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Order $order)
    {
        $order->delete();

        Alert::info('You have successfully deleted the order.');

        return redirect()->route('platform.orders.list');
    }
}
