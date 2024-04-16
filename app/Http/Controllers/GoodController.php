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
        $goods = Good::query()->get();

        $goodTypeDesc = __('translations.All goods');

        return view('good', compact('goods', 'goodTypeDesc'));
    }

    public function view(Good $good)
    {
        $good->with('relatedGoods');

        return view('goodView', compact('good'));
    }

    public function goodList(string $goodTypeCode, Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $goodType = GoodType::query()->where('code', '=', $goodTypeCode)->first();
        $goods = Good::query()->where('good_type_id', '=', $goodType->id)
            ->with(['attachment'])
            ->get();

        return view('good', compact('goods', 'goodType'));
    }

    public function autofill(string $goodName)
    {
        $good = Good::query()->where('name_ru', '=', $goodName)->first();

        return redirect(route('viewGood', ['good' => $good]));
    }
}
