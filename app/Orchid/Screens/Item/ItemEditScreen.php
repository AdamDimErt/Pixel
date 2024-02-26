<?php

namespace App\Orchid\Screens\Item;

use App\Models\Good;
use App\Models\Item;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ItemEditScreen extends Screen
{
    /**
     * @var Item
     */
    public $item;

    /**
     * Query data.
     */
    public function query(Item $item): array
    {
        return [
            'item' => $item,
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->item->exists ? 'Edit item' : 'Creating a new item';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Items';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create item')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->item->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->item->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->item->exists),
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

                Relation::make('item.good_id')
                    ->fromModel(Good::class, 'name')
                    ->help('Begin to enter a name to find a good that you need ')
                    ->title('Choose a good for that item'),

                Select::make('item.status')
                    ->options([
                        'Available' => 'available',
                        'Rented' => 'rented',
                        'Pre ordered' => 'pre-ordered',
                    ])
                    ->title('status')
                    ->help('status itema'),
            ]),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Item $item, Request $request)
    {
        $item->fill($request->get('item'))->save();

        Alert::info('You have successfully created am item.');

        return redirect()->route('platform.items.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Item $item)
    {
        $item->delete();

        Alert::info('You have successfully deleted the item.');

        return redirect()->route('platform.items.list');
    }
}
