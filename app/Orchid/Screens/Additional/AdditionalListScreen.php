<?php

namespace App\Orchid\Screens\Additional;

use App\Models\Additional;
use App\Orchid\Layouts\Additional\AdditionalListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class AdditionalListScreen extends Screen
{
    /**
     * Query data.
     */
    public function query(): array
    {
        return [
            'additionals' => Additional::filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Additional';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'All additionals';
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.additionals.create'),
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
            AdditionalListLayout::class,
        ];
    }
}
