<?php

namespace App\Orchid\Screens\Client;

use App\Mail\ConfirmationMail;
use App\Models\Client;
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

class ClientEditScreen extends Screen
{
    /**
     * @var Client
     */
    public $client;

    /**
     * Query data.
     */
    public function query(Client $client): array
    {
        $client->load('attachment');

        return [
            'client' => $client,
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->client->exists ? 'Edit client' : 'Creating a new client';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Clients';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create client')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->client->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->client->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->client->exists),
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
                Input::make('client.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this client.')
                    ->required(),

                Input::make('client.email')
                    ->title('Email')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this client.')
                    ->required(),

                Input::make('client.phone')
                    ->title('Phone')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this client.')
                    ->required(),

                Select::make('client.email_confirmed')
                    ->options([
                        1 => 'Подтверждён',
                        0 => 'Не подтверждён',
                    ])
                    ->title('email_confirmed')
                    ->help('Specify a short descriptive title for this client.')
                    ->required(),

                Select::make('client.blocked')
                    ->options([
                        1 => 'Заблокирован',
                        0 => 'Не заблокирован',
                    ])
                    ->title('blocked')
                    ->help('Specify a short descriptive title for this client.')
                    ->required(),

                Input::make('client.instagram')
                    ->title('Instagram')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this client.')
                    ->required(),

                Input::make('client.password1')
                    ->title('Password')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this client.'),

                Upload::make('client.attachment')
                    ->title('All files')
                    ->acceptedFiles('image/*'),
            ]),
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function createOrUpdate(Client $client, Request $request)
    {
        $client->fill($request->except('client.attachment', 'client.password1')['client']);

        $client->confirmation_code = Str::random(10);
        if (($request->input('client')['password1'])){
            $client->password = Hash::make(($request->input('client')['password1']));
        }
        $client->save();

        Mail::to($client->email)->send(new ConfirmationMail($client->email, $client->confirmation_code));

        $client->attachment()->syncWithoutDetaching(
            $request->input('client.attachment', [])
        );

        Alert::info('You have successfully created a client.');

        return redirect()->route('platform.clients.list');
    }

    /**
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Client $client)
    {
        $client->delete();

        Alert::info('You have successfully deleted the client.');

        return redirect()->route('platform.clients.list');
    }
}
