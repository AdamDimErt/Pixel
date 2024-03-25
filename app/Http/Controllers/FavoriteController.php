<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function getFavorites(Request $request)
    {
        $clientId = Auth::guard('clients')->id();

        $favoriteGoodIds = Favorite::query()->where('client_id', '=', $clientId)->pluck('good_id')->toArray();

        $goods = Good::query()->whereIn('id', $favoriteGoodIds)->get();

        return view('good', compact('goods'));
    }

    public function add(Good $good)
    {
        $clientId = Auth::guard('clients')->id();
        Favorite::query()
            ->create([
                'good_id' => $good->id,
                'client_id' => $clientId,
            ]);

        return response()
            ->json(['success' => true]);
    }

    public function remove(Good $good)
    {
        $clientId = Auth::guard('clients')->id();
        Favorite::query()->where('client_id', '=', $clientId)
            ->where('good_id', '=', $good->id)->delete();

        return response()
            ->json(['success' => true]);
    }
}
