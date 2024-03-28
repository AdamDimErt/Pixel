<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Client;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\NumberRange;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ClientListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'clients';

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
                ->render(function (Client $client) {
                    return Link::make($client->name)
                        ->route('platform.clients.edit', $client);
                }),

            TD::make('phone')
                ->sort()
                ->filter(
                    Input::make()
                ),

            TD::make('instagram')
                ->sort()
                ->filter(
                    Input::make()
                ),

            TD::make('email_confirmed')
                ->sort()
                ->filter(
                    Select::make('email_confirmed')
                        ->options([
                            'Подтверждён' => 1,
                            'Не подтверждён' => 0,
                        ])
                        ->title('email_confirmed')
                )->render(function (Client $client) {
                    return [
                        0 => 'Не подтверждён',
                        1 => 'Подтверждён',
                    ][$client->email_confirmed];
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
