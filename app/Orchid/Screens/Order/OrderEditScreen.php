<?php

namespace App\Orchid\Screens\Order;

use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
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
     */
    public function query(Order $order): array
    {
        return [
            'order' => $order,
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
        return __('translations.Orders');
    }

    public function commandBar(): array
    {
        return [
            Button::make(__('translations.Create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->order->exists),

            Button::make(__('translations.Update'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->order->exists),

            Button::make(__('translations.Delete'))
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

                Select::make('order.status')
                    ->options([
                         'returned'=>'Returned',
                         'in_rent'=>'In rent',
                         'waiting'=>'Waiting',
                         'confirmed'=>'Confirmed',
                         'cancelled'=>'Cancelled'
                    ])
                    ->title('status')
                    ->help(__('translations.Name')),

                Input::make('order.agreement_id')
                    ->title(__('translations.Agreement id'))
                    ->help(__('translations.Order agreement id help'))
                    ->type('number')
                    ->required(),

                Upload::make('order.attachment')
                    ->help(__('translations.Order Agreement help'))
                    ->title(__('translations.Agreement'))
                    ->acceptedFiles('.doc, .docx, .pdf, .txt'),

            ]),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Order $order, Request $request)
    {
        $order->fill($request->except('order.attachment')['order']);

        $order->attachment()->syncWithoutDetaching(
            $request->input('order.attachment', [])
        );

        $order->save();

        Alert::info('You have successfully created an order.');

        return redirect()->route('platform.orders.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Order $order)
    {
        $order->delete();

        Alert::info('You have successfully deleted the order.');

        return redirect()->route('platform.orders.list');
    }
}
