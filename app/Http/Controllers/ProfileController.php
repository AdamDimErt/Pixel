<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Orchid\Attachment\File;

class ProfileController extends Controller
{
    public function viewProfile(Request $request)
    {
        try {
            Client::query()->findOrFail(Auth::guard('clients')->id());
        } catch (\Throwable){
            return redirect()->route('logout');
        }

        $client = Client::query()->find(Auth::guard('clients')->id());

        $client->order_amount = Order::query()
            ->where('client_id', '=', $client->id)
            ->whereNotIn('status', ['cancelled', 'waiting'])
            ->count();
        $client->total_spent = Order::query()
            ->where('client_id', '=', $client->id)
            ->whereNotIn('status', ['cancelled', 'waiting'])
            ->sum('amount_paid');
        $client->order_item_amount = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('client_id', '=', $client->id)
            ->whereNotIn('order_items.status', ['cancelled', 'waiting'])
            ->count();

        return view('profile.main', compact('client'));
    }

    public function editProfile(Request $request)
    {
        $client = Client::query()->find(Auth::guard('clients')->id());

        return view('profile.edit', compact('client'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('clients')->ignore(Auth::guard('clients')->id()),
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('clients')->ignore(Auth::guard('clients')->id()),
            ],
            'instagram' => [
                'required',
                'string',
                Rule::unique('clients')->ignore(Auth::guard('clients')->id()),
            ],
            'files' => 'required|array|size:2',
            'signature' => 'required|extensions:pdf|file',
        ]);

        $client = Client::query()->find(Auth::guard('clients')->id());

        $client->update(
            [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'instagram' => $request->input('instagram'),
                'updated_at' => now()->tz('Asia/Almaty'),
            ]
        );

        $attachments = $client->attachment();
        $attachments->detach();

        $attachmentIds = [];

        foreach ($request->file('files') as $fileData) {
            $file = new File($fileData);
            $attachment = $file->path('idCards')->load();
            $attachment->group = 'idCards';
            $attachment->save();
            $attachmentIds[] = $attachment->id;
        }

        $signature = new File($request->file('signature'));
        $attachment = $signature->path('signatures')->load();
        $attachment->group = 'signatures';
        $attachment->save();

        $attachmentIds[] = $attachment->id;

        $client->attachment()->syncWithoutDetaching($attachmentIds);

        return redirect(route('viewProfile'));
    }
}
