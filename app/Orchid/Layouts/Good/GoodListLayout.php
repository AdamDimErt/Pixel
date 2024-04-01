<?php

namespace App\Orchid\Layouts\Good;

use App\Models\Good;
use App\Models\GoodType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
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
            TD::make('name', __('translations.Name'))
                ->sort()
                ->filter(
                    Input::make()
                )
                ->render(function (Good $good) {
                    return Link::make($good->name)
                        ->route('platform.goods.edit', $good);
                }),

            TD::make('description', __('translations.Description'))
                ->sort()
                ->filter(
                    Input::make()
                )->width('100px')
                ->render(function (Good $good) {
                    return $good->description;
                }),

            TD::make('cost', __('translations.Cost'))
                ->sort()
                ->filter(
                    NumberRange::make()
                )
                ->render(function (Good $good) {
                    return $good->cost;
                }),

            TD::make('discount_cost', __('translations.Discount cost'))
                ->sort()
                ->filter(
                    NumberRange::make()
                )
                ->render(function (Good $good) {
                    return $good->cost;
                }),

            TD::make('damage_cost', __('translations.Damage cost'))
                ->sort()
                ->filter(
                    NumberRange::make()
                )
                ->render(function (Good $good) {
                    return $good->cost;
                }),

            TD::make('good_type_id', __('translations.GoodType'))
                ->filter(
                    Relation::make()
                        ->fromModel(GoodType::class, 'name')
                )
                ->render(function (Good $good) {
                    return Link::make($good->goodType->name)
                        ->route('platform.goodTypes.edit', $good->goodType);
                }),

            TD::make('created_at', __('translations.Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('translations.Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),
        ];
    }
}
