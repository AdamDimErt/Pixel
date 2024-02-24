<?php

namespace App\Orchid\Layouts\Item;

use App\Models\Item;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ItemListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'items';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name')
                ->sort()
                ->filter(
                    Input::make()
                )
                ->render(function (Item $item) {
                    return Link::make($item->good->name)
                        ->route('platform.items.edit', $item);
                }),

            TD::make('status')
                ->sort()
                ->filter(
                    Select::make('status')
                        ->options([
                            'Available' => 'available',
                            'Rented' => 'rented',
                            'Pre ordered' => 'pre-ordered',
                        ])
                        ->title('status')
                        ->help('status itema')
                )
                ->render(function (Item $item) {
                    return $item->status;
                }),

            TD::make('created_at', 'Created')
                ->sort(),

            TD::make('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}