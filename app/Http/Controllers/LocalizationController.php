<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function changeLang(Request $request): RedirectResponse
    {
        $locale = $request->input('locale');
        App::setlocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
