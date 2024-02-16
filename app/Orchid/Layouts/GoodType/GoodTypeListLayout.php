<?php

namespace App\Orchid\Layouts\GoodType;

use App\Models\GoodType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class GoodTypeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'goodTypes';

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
                ->render(function (GoodType $goodType) {
                    return Link::make($goodType->name)
                        ->route('platform.goodTypes.edit', $goodType);
                }),

            TD::make('description')
                ->sort()
                ->render(function (GoodType $goodType) {
                    return $goodType->description;
                }),

            TD::make('created_at', 'Created')
                ->sort(),

            TD::make('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}
