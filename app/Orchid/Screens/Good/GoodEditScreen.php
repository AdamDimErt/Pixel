<?php

namespace App\Orchid\Screens\Good;

use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class GoodEditScreen extends Screen
{
    /**
     * @var Good
     */
    public $good;

    /**
     * Query data.
     *
     * @param Good $good
     *
     * @return array
     */
    public function query(Good $good): array
    {
        return [
            'good' => $good
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->good->exists ? 'Edit good' : 'Creating a new good';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Goods";
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create good')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->good->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->good->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->good->exists),
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
                Input::make('good.name')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.')
                    ->required(),

                Input::make('good.cost')
                    ->title('Cost')
                    ->placeholder('Define a cost for a good')
                    ->help('Specify a cost for a good')
                    ->type('number')
                    ->required(),

                Relation::make('good.good_type_id')
                    ->fromModel(GoodType::class, 'name')
                    ->title('Choose a category for that good'),

                TextArea::make('good.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview')
                    ->required(),
            ])
        ];
    }

    /**
     * @param Good $good
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Good $good, Request $request)
    {
        $good->fill($request->get('good'))->save();

        Alert::info('You have successfully created a post.');

        return redirect()->route('platform.goods.list');
    }

    /**
     * @param Good $good
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(Good $good)
    {
        $good->delete();

        Alert::info('You have successfully deleted the good.');

        return redirect()->route('platform.goods.list');
    }
}
