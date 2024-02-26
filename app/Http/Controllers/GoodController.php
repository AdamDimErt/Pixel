<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $goods = Good::query()->paginate();

        return view('good', compact('goods'));
    }

    public function goodList(string $goodTypeCode, Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $goodType = GoodType::query()->where('code', '=', $goodTypeCode)->first();
        $goods = Good::query()->where('good_type_id', '=', $goodType->id)
            ->hasAvailableItems()
            ->with(['attachment'])
            ->get();

        return view('good', compact('goods'));
    }
}
