<?php

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (! function_exists('sendTelegramMessage')) {
    function sendTelegramMessage($text): PromiseInterface|Response
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(sprintf(env('TELEGRAM_API_ENDPOINT'), env('TELEGRAM_BOT_TOKEN')), [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'parse_mode' => 'MarkdownV2',
            'text' => $text,
        ]);
        Log::info('TELEGRAM_API_RESPONSE: '.$response);

        return $response;
    }
}
