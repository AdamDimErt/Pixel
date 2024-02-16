<?php

namespace App\Orchid\Layouts\Good;

use App\Models\Good;
use App\Models\GoodType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\NumberRange;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class GoodListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'goods';

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
                ->render(function (Good $good) {
                    return Link::make($good->name)
                        ->route('platform.goods.edit', $good);
                }),

            TD::make('description')
                ->sort()
                ->filter(
                    Input::make()
                )
                ->render(function (Good $good) {
                    return $good->description;
                }),

            TD::make('cost')
                ->sort()
                ->filter(
                    NumberRange::make()
                )
                ->render(function (Good $good) {
                    return $good->cost;
                }),

            TD::make('Category')
                ->filter(
                    Relation::make()
                        ->fromModel(GoodType::class, 'name')
                )
                ->render(function (Good $good) {
                    return Link::make($good->goodType->name)
                        ->route('platform.goodTypes.edit', $good->goodType);
                }),

            TD::make('created_at', 'Created')
                ->sort(),

            TD::make('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}