<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Attachment\File;

class AuthController extends Controller
{
    public function login(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('phone', 'password');

        if (Auth::guard('clients')->attempt($credentials)) {
            return redirect()->intended('');
        }

        return redirect()->back()->withErrors(['phone' => 'Неверно введены данные']);
    }

    public function register(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.register');
    }

    public function storeUser(Request $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:clients',
            'password' => 'required|string|min:8|confirmed',
            'files' => 'required|array|size:2',
        ]);

        $client = Client::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);

        $attachmentIds = [];

        foreach ($request->allFiles()['files'] as $fileData) {
            $file = new File($fileData);
            $attachment = $file->load();
            $attachmentIds[] = $attachment->id;
        }

        $client->attachment()->syncWithoutDetaching($attachmentIds);

        Auth::guard('clients')->login($client);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::guard('clients')->logout();
        $request->session()->invalidate();

        return redirect('/auth/login');
    }
}
