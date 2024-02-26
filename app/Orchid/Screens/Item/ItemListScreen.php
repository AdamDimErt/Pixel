<?php

namespace App\Orchid\Screens\Item;

use App\Models\Item;
use App\Orchid\Layouts\Item\ItemListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ItemListScreen extends Screen
{
    /**
     * Query data.
     */
    public function query(): array
    {
        return [
            'items' => Item::filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Item';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'All items';
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
                ->route('platform.items.create'),
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
            ItemListLayout::class,
        ];
    }
}
