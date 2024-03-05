<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function preOrder(Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('ordering.2nd_step');
    }
}
