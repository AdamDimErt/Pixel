<?php

namespace App\Orchid\Screens\Additional;

use App\Mail\ConfirmationMail;
use App\Models\Additional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
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
        return $this->additional->exists ? 'Edit additional' : 'Creating a new additional';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Additionals';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create additional')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->additional->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->additional->exists),

            Button::make('Remove')
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
                Input::make('additional.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this additional.')
                    ->required(),

                Input::make('additional.cost')
                    ->title('Cost')
                    ->placeholder('Define a cost for a good')
                    ->help('Specify a cost for a good')
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
