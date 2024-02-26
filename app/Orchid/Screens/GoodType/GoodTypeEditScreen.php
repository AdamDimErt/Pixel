<?php

namespace App\Orchid\Screens\GoodType;

use App\Models\GoodType;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class GoodTypeEditScreen extends Screen
{
    /**
     * @var GoodType
     */
    public $goodType;

    /**
     * Query data.
     */
    public function query(GoodType $goodType): array
    {
        return [
            'goodType' => $goodType,
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->goodType->exists ? 'Edit goodType' : 'Creating a new goodType';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Good types';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create goodType')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->goodType->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->goodType->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->goodType->exists),
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
                Input::make('goodType.name')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->required()
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('goodType.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->required()
                    ->placeholder('Brief description for preview'),
            ]),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(GoodType $goodType, Request $request)
    {
        $goodType->fill($request->get('goodType'))->save();

        Alert::info('You have successfully created a good type.');

        return redirect()->route('platform.goodTypes.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(GoodType $goodType)
    {
        $goodType->delete();

        Alert::info('You have successfully deleted the goodType.');

        return redirect()->route('platform.goodTypes.list');
    }
}
