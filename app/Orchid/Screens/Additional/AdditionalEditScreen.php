<?php

namespace App\Orchid\Screens\Additional;

use App\Models\Additional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class AdditionalEditScreen extends Screen
{
    /**
     * @var Additional
     */
    public $additional;

    /**
     * Query data.
     */
    public function query(Additional $additional): array
    {
        $additional->load('attachment');

        return [
            'additional' => $additional,
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->additional->exists ? __('translations.Edit additional') : __('translations.Creating a new additional');

    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return __('translations.Additionals');
    }

    public function commandBar(): array
    {
        return [
            Button::make(__('translations.Create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->additional->exists),

            Button::make(__('translations.Update'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->additional->exists),

            Button::make(__('translations.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->additional->exists),
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
                Input::make('additional.name_ru')
                    ->title(__('translations.Name ru'))
                    ->help(__('translations.Additional name help'))
                    ->required(),

                Input::make('additional.name_en')
                    ->title(__('translations.Name en'))
                    ->help(__('translations.Additional name help'))
                    ->required(),

                Input::make('additional.cost')
                    ->title(__('translations.Cost'))
                    ->help(__('translations.Additional cost help'))
                    ->type('number')
                    ->required(),

            ]),
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function createOrUpdate(Additional $additional, Request $request)
    {
        $additional->fill($request->input('additional'));

        $additional->save();

        Alert::info('You have successfully created a additional.');

        return redirect()->route('platform.additionals.list');
    }

    /**
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Additional $additional)
    {
        $additional->delete();

        Alert::info('You have successfully deleted the additional.');

        return redirect()->route('platform.additionals.list');
    }
}
