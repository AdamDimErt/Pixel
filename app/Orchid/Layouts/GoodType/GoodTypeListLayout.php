<?php

namespace App\Orchid\Layouts\GoodType;

use App\Models\GoodType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
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
                ->filter(Input::make())
                ->render(function (GoodType $goodType) {
                    return Link::make($goodType->name)
                        ->route('platform.goodTypes.edit', $goodType);
                }),

            TD::make('description')
                ->sort()
                ->filter(Input::make())
                ->render(function (GoodType $goodType) {
                    return $goodType->description;
                }),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Updated'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),
        ];
    }
}
